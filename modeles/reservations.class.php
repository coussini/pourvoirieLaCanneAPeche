<?php
class Reservations
{
    private $connexionBD;

    public function __construct()
    {
        $oConnexionPDO = new ConnexionPDO("canneapeche","UTF8");
		$this->connexionBD = $oConnexionPDO->rConnexion;
    }
    
    // function SQL qui permet de récupérer toutes les réservation
    // faite sur ce produit
    // et la date de début doit être plus grande que la date du jour
    // car on ne prend pas les vieilles réservations en compte
    public function extraireLesReservationPourCeProduit($id_produit)
    {
        if (!is_numeric($id_produit))
        {
            throw new Exception("Identifiant produit invalide");
        }

        $reservations = array();

        $id = $this->connexionBD;
        $requete = $id->prepare("SELECT date_debut
                                  FROM  reservations 
                                  WHERE id_produit     = :id_produit
                                  AND   DATE(date_debut) >= CURRENT_DATE()");

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL (extraireLesReservationPourCeProduit CODE D'ERREUR : " . $id->errorCode() . ")");
        }

        $requete->bindParam(':id_produit',$id_produit,PDO::PARAM_INT);

        $resultat = $requete->execute();

        if (!$resultat) 
        {
            throw new Exception("Erreur d'extraction sur la table reservations (extraireLesReservationPourCeProduit CODE D'ERREUR : " . $id->errorCode() . ")");
        }

        $requete->bindColumn('date_debut',$date_debut);
     
        $i = 0;
        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $reservations[$i]["date_debut"] = $date_debut;
            $i++;
        }

        $requete->closeCursor();
        $id = null;

        return $reservations;
    }
    
    // function SQL qui permet de récupérer les données du produit
    // nécessaire à une réservation
    public function extraireLeProduit($id_produit)
    {
        if (!is_numeric($id_produit))
        {
            throw new Exception("Identifiant produit invalide");
        }

        $produit = array();

        $id = $this->connexionBD;
        $requete = $id->prepare("SELECT nom,
                                        imageFacade,
                                        description,
                                        prix_par_semaine                                        
                                 FROM   produits
                                 WHERE  id_produit = :id_produit
                                 AND    statut     = 'actif'"); 
        
        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL (extraireLeProduit CODE D'ERREUR : " . $id->errorCode() . ")");
        }

        $requete->bindParam(':id_produit',$id_produit,PDO::PARAM_INT);

        $resultat = $requete->execute();

        if (!$resultat) 
        {
            throw new Exception("Erreur d'extraction sur la table produits (extraireLeProduit CODE D'ERREUR : " . $id->errorCode() . ")");
        }

        $requete->bindColumn('nom',$nom);
        $requete->bindColumn('imageFacade',$imageFacade);
        $requete->bindColumn('description',$description);
        $requete->bindColumn('prix_par_semaine',$prix_par_semaine);
     
        $resultat = $requete->fetchColumn(PDO::FETCH_BOUND);

        if ($requete->rowCount() > 0)
        {
            $produit["id_produit"] = $id_produit;
            $produit["nom"] = $nom;
            $produit["imageFacade"] = $imageFacade;
            $produit["description"] = $description;
            $produit["prix_par_semaine"] = $prix_par_semaine;
        }

        $requete->closeCursor();
        $id = null;

        return $produit;
    }
    
    // function SQL qui permet de récupérer les données de l'utilisateur
    // nécessaire pour valider les coordonnées lors d'une confirmation
    public function extraireUtilisateur($id_utilisateur)
    {
        if (!is_numeric($id_utilisateur))
        {
            throw new Exception("Identifiant utilisateur invalide");
        }

        $utilisateur = array();

        $id = $this->connexionBD;
        $requete = $id->prepare("SELECT nom,
                                        prenom,
                                        courriel,
                                        date_de_naissance
                                 FROM   utilisateurs
                                 WHERE  id_utilisateur = :id_utilisateur
                                 AND    statut = 'actif'"); 
        
        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL (extraireUtilisateur CODE D'ERREUR : " . $id->errorCode() . ")");
        }

        $requete->bindParam(':id_utilisateur',$id_utilisateur,PDO::PARAM_INT);

        $resultat = $requete->execute();

        if (!$resultat) 
        {
            throw new Exception("Erreur d'extraction sur la table utilisateurs (extraireUtilisateur CODE D'ERREUR : " . $id->errorCode() . ")");
        }

        $requete->bindColumn('nom',$nom);
        $requete->bindColumn('prenom',$prenom);
        $requete->bindColumn('courriel',$courriel);
        $requete->bindColumn('date_de_naissance',$date_de_naissance);
     
        $resultat = $requete->fetchColumn(PDO::FETCH_BOUND);

        if ($requete->rowCount() > 0)
        {
            $utilisateur["id_utilisateur"] = $id_utilisateur;
            $utilisateur["nom"] = $nom;
            $utilisateur["prenom"] = $prenom;
            $utilisateur["courriel"] = $courriel;
            $utilisateur["date_de_naissance"] = $date_de_naissance;
        }

        $requete->closeCursor();
        $id = null;

        return $utilisateur;
    }

    // function SQL qui permet de récupérer les réservations d'un utilisateur
    public function extraireLesReservationsUtilisateur($id_utilisateur)
    {
        if (!is_numeric($id_utilisateur))
        {
            throw new Exception("Identifiant utilisateur invalide");
        }

        $reservations = array();

        $id = $this->connexionBD;
        $requete = $id->prepare("SELECT RE.id_reservation,
                                        RE.id_produit,
                                        PR.nom,
                                        PR.description, 
                                        RE.date_debut,
                                        RE.date_fin,
                                        RE.numero_semaine,
                                        RE.nom_carte,
                                        RE.numero_carte,
                                        RE.id_carte,
                                        RE.prix_a_la_reservation
                                  FROM reservations RE, produits PR
                                  WHERE PR.id_produit = RE.id_produit
                                  AND   RE.id_utilisateur = :id_utilisateur");

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL (extraireLesReservationsUtilisateur CODE D'ERREUR : " . $id->errorCode() . ")");
        }

        $requete->bindParam(':id_utilisateur',$id_utilisateur,PDO::PARAM_INT);

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'extraction sur la table reservations (extraireLesReservationsUtilisateur CODE D'ERREUR : " . $id->errorCode());
        }
        
        $requete->bindColumn('id_reservation',$id_reservation);
        $requete->bindColumn('id_produit',$id_produit);
        $requete->bindColumn('nom',$nom);
        $requete->bindColumn('description',$description);
        $requete->bindColumn('date_debut',$date_debut);
        $requete->bindColumn('date_fin',$date_fin);
        $requete->bindColumn('numero_semaine',$numero_semaine);
        $requete->bindColumn('nom_carte',$nom_carte);
        $requete->bindColumn('numero_carte',$numero_carte);
        $requete->bindColumn('id_carte',$id_carte);
        $requete->bindColumn('prix_a_la_reservation',$prix_a_la_reservation);

        $i = 0;
        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $reservations[$i]["id_reservation"] = $id_reservation;
            $reservations[$i]["id_produit"] = $id_produit;
            $reservations[$i]["nom"] = $nom;
            $reservations[$i]["description"] = $description;
            $reservations[$i]["date_debut"] = $date_debut;
            $reservations[$i]["date_fin"] = $date_fin;
            $reservations[$i]["numero_semaine"] = $numero_semaine;
            $reservations[$i]["nom_carte"] = $nom_carte;
            $reservations[$i]["numero_carte"] = $numero_carte;
            $reservations[$i]["id_carte"] = $id_carte;
            $reservations[$i]["prix_a_la_reservation"] = $prix_a_la_reservation;
            $i++;
        }

        $requete->closeCursor();
        $id = null;

        return $reservations;
    }


    // function SQL qui permet de récupérer les réservations
    public function extraireLesReservations()
    {
        $reservations = array();

        $id = $this->connexionBD;
        $requete = $id->prepare("SELECT RE.id_reservation,
                                        RE.id_utilisateur,
                                        UT.courriel,
                                        PR.nom,
                                        RE.id_produit,
                                        PR.description, 
                                        RE.date_debut,
                                        RE.date_fin,
                                        RE.numero_semaine,
                                        RE.nom_carte,
                                        RE.numero_carte,
                                        RE.id_carte,
                                        RE.prix_a_la_reservation
                                  FROM reservations RE, produits PR, utilisateurs UT
                                  WHERE PR.id_produit = RE.id_produit
                                  AND   RE.id_utilisateur = UT.id_utilisateur");

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL (extraireLesReservations CODE D'ERREUR : " . $id->errorCode() . ")");
        }

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'extraction sur la table reservations (extraireLesReservations CODE D'ERREUR : " . $id->errorCode() . ")");
        }
        
        $requete->bindColumn('id_reservation',$id_reservation);
        $requete->bindColumn('id_utilisateur',$id_utilisateur);
        $requete->bindColumn('id_produit',$id_produit);
        $requete->bindColumn('courriel',$courriel);
        $requete->bindColumn('nom',$nom);
        $requete->bindColumn('description',$description);
        $requete->bindColumn('date_debut',$date_debut);
        $requete->bindColumn('date_fin',$date_fin);
        $requete->bindColumn('numero_semaine',$numero_semaine);
        $requete->bindColumn('nom_carte',$nom_carte);
        $requete->bindColumn('numero_carte',$numero_carte);
        $requete->bindColumn('id_carte',$id_carte);
        $requete->bindColumn('prix_a_la_reservation',$prix_a_la_reservation);

        $i = 0;
        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $reservations[$i]["id_reservation"] = $id_reservation;
            $reservations[$i]["id_utilisateur"] = $id_utilisateur;
            $reservations[$i]["id_produit"] = $id_produit;
            $reservations[$i]["courriel"] = $courriel;
            $reservations[$i]["nom"] = $nom;
            $reservations[$i]["description"] = $description;
            $reservations[$i]["date_debut"] = $date_debut;
            $reservations[$i]["date_fin"] = $date_fin;
            $reservations[$i]["numero_semaine"] = $numero_semaine;
            $reservations[$i]["nom_carte"] = $nom_carte;
            $reservations[$i]["numero_carte"] = $numero_carte;
            $reservations[$i]["id_carte"] = $id_carte;
            $reservations[$i]["prix_a_la_reservation"] = $prix_a_la_reservation;
            $i++;
        }

        $requete->closeCursor();
        $id = null;

        return $reservations;
    }
    
    // function SQL qui permet de traiter une commande provenant du panier
    public function creerUneReservation($id_utilisateur,$id_produit,$date_debut,$date_fin,$numero_semaine,$nom_carte,$numero_carte,$id_carte,$prix_a_la_reservation)
    {
        if (!is_numeric($id_utilisateur))
        {
            throw new Exception("Identifiant utilisateur invalide");
        }
        else if (!is_numeric($id_produit))
        {
            throw new Exception("Identifiant produit invalide");
        }
        else if ($date_debut == "")
        {
            throw new Exception("date de début invalide");
        }
        else if ($date_fin == "")
        {
            throw new Exception("date de fin invalide");
        }
        else if (!is_numeric($numero_semaine))
        {
            throw new Exception("numero de semaine invalide");
        }
        else if ($nom_carte == "" || ($nom_carte != "Mastercard" && $nom_carte != "Visa" && $nom_carte != "American Express"))
        {
            throw new Exception("nom de la carte invalide " . $nom_carte);
        }
        else if (!is_numeric($numero_carte) || strlen($numero_carte) != 16)
        {
            throw new Exception("numero de la carte invalide");
        }
        else if (!is_numeric($id_carte) || strlen($id_carte) != 3)
        {
            throw new Exception("id de la carte invalide");
        }
        else if (!is_numeric($prix_a_la_reservation))
        {
            throw new Exception("prix à la réservation invalide");
        }

        // enlever ou convertir les caractères spéciaux
        $id_utilisateur = htmlentities($id_utilisateur, ENT_QUOTES, "UTF-8");
        $id_produit = htmlentities($id_produit, ENT_QUOTES, "UTF-8");
        $date_debut = htmlentities($date_debut, ENT_QUOTES, "UTF-8");
        $date_fin = htmlentities($date_fin, ENT_QUOTES, "UTF-8");
        $numero_semaine = htmlentities($numero_semaine, ENT_QUOTES, "UTF-8");
        $nom_carte = htmlentities($nom_carte, ENT_QUOTES, "UTF-8");
        $numero_carte = htmlentities($numero_carte, ENT_QUOTES, "UTF-8");
        $id_carte = htmlentities($id_carte, ENT_QUOTES, "UTF-8");
        $prix_a_la_reservation = htmlentities($prix_a_la_reservation, ENT_QUOTES, "UTF-8");

        $id = $this->connexionBD;
        $requete = $id->prepare("INSERT INTO reservations 
                                 (id_utilisateur,
                                  id_produit,
                                  date_debut,
                                  date_fin,
                                  numero_semaine,
                                  nom_carte,
                                  numero_carte,
                                  id_carte,
                                  prix_a_la_reservation)
                                  VALUES (:id_utilisateur, 
                                          :id_produit, 
                                          :date_debut, 
                                          :date_fin, 
                                          :numero_semaine,
                                          :nom_carte,
                                          :numero_carte,
                                          :id_carte,
                                          :prix_a_la_reservation)");

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL (creerUneReservation CODE D'ERREUR : " . $id->errorCode() . ")");
        }

        $requete->bindParam(':id_utilisateur',$id_utilisateur,PDO::PARAM_INT);
        $requete->bindParam(':id_produit',$id_produit,PDO::PARAM_INT);
        $requete->bindParam(':date_debut',$date_debut,PDO::PARAM_STR);
        $requete->bindParam(':date_fin',$date_fin,PDO::PARAM_STR);
        $requete->bindParam(':numero_semaine',$numero_semaine,PDO::PARAM_INT);
        $requete->bindParam(':nom_carte',$nom_carte,PDO::PARAM_STR);
        $requete->bindParam(':numero_carte',$numero_carte,PDO::PARAM_INT);
        $requete->bindParam(':id_carte',$id_carte,PDO::PARAM_INT);
        $requete->bindParam(':prix_a_la_reservation',$prix_a_la_reservation,PDO::PARAM_INT);

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'insertion sur la table reservations (creerUneReservation CODE D'ERREUR : " . $id->errorCode() . ")");
        }
        
        $requete->closeCursor();
        
        $id = null;

        // retourne true si tout s'est bien passé
        return true;
    }
}
?>