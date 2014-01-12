<?php
class Reservations
{
    private $connexionBD;

    public function __construct()
    {
        $oConnexionPDO = new ConnexionPDO("canneapeche","UTF8");
		$this->connexionBD = $oConnexionPDO->rConnexion;
    }
    
    // function SQL qui permet de récupérer les données du produit
    // nécessaire à une réservation
    public function extraireLeProduit($id_produit)
    {
        $produit = array();

        $id = $this->connexionBD;
        $requete = $id->prepare("SELECT nom,
                                        imageFacade,
                                        description
                                 FROM   produits
                                 WHERE  id_produit = :id_produit
                                 AND    statut = 'actif'"); 
        
        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }

        $requete->bindParam(':id_produit',$id_produit,PDO::PARAM_INT);

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'extraction sur la table produits " . $id->errorCode());
        }

        $requete->bindColumn('nom',$nom);
        $requete->bindColumn('imageFacade',$imageFacade);
        $requete->bindColumn('description',$description);
     
        $i = 0;
        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $produit[$i]["id_produit"] = $id_produit;
            $produit[$i]["nom"] = $nom;
            $produit[$i]["imageFacade"] = $imageFacade;
            $produit[$i]["description"] = $description;
            $i++;
        }

        $requete->closeCursor();
        $id = null;

        return $produit;
    }
    
    // function SQL qui permet de récupérer toutes les réservation
    // faite sur ce produit et par cet utilisateur
    // et la date de début doit être plus grande que la date du jour
    public function extraireLesReservationPourCeProduit($id_utilisateur,$id_produit)
    {
        $reservations = array();

        $id = $this->connexionBD;
        $requete = $id->prepare("SELECT id_reservation,
                                        date_debut,
                                        date_fin,
                                        numero_semaine
                                  FROM  reservations 
                                  WHERE id_utilisateur = :id_utilisateur
                                  AND   id_produit     = :id_produit
                                  AND   DATE(date_debut) >= CURRENT_DATE()");

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }

        $requete->bindParam(':id_utilisateur',$id_utilisateur,PDO::PARAM_INT);
        $requete->bindParam(':id_produit',$id_produit,PDO::PARAM_INT);

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'extraction sur la table reservations " . $id->errorCode());
        }

        $requete->bindColumn('id_reservation',$id_reservation);
        $requete->bindColumn('date_debut',$date_debut);
        $requete->bindColumn('date_fin',$date_fin);
        $requete->bindColumn('numero_semaine',$numero_semaine);
     
        $i = 0;
        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $reservations[$i]["id_reservation"] = $id_reservation;
            $reservations[$i]["date_debut"] = $date_debut;
            $reservations[$i]["date_fin"] = $date_fin;
            $reservations[$i]["numero_semaine"] = $numero_semaine;
            $i++;
        }

        $requete->closeCursor();
        $id = null;

        return $reservations;
    }
    
    // function SQL qui permet de récupérer un commande d'un utilisateur
    public function extraireDesReservations()
    {
        $reservations = array();

        // cette requete est ce qu'on apelle un sub-select
        // permet de récupérer les données d'une commande et le total des détails 
        // pour permettre d'afficher sa valeur dans la liste des commandes passées 
        $id = $this->connexionBD;
        $requete = $id->prepare("SELECT id_reservation,
                                         id_utilisateur,
                                         id_produit,
                                         date_debut,
                                         date_fin,
                                         nombre_de_semaine,
                                         nom_carte,
                                         numero_carte,
                                         id_carte
                                  FROM reservations"); 

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'extraction sur la table reservations " . $id->errorCode());
        }

        $requete->bindColumn('id_reservation',$id_reservation);
        $requete->bindColumn('id_utilisateur',$id_utilisateur);
        $requete->bindColumn('id_produit',$id_produit);
        $requete->bindColumn('date_debut',$date_debut);
        $requete->bindColumn('date_fin',$date_fin);
        $requete->bindColumn('nombre_de_semaine',$nombre_de_semaine);
        $requete->bindColumn('nom_carte',$nom_carte);
        $requete->bindColumn('numero_carte',$numero_carte);
        $requete->bindColumn('id_carte',$id_carte);
     
        $i = 0;
        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $reservations[$i]["id_reservation"] = $id_reservation;
            $reservations[$i]["id_utilisateur"] = $id_utilisateur;
            $reservations[$i]["id_produit"] = $id_produit;
            $reservations[$i]["date_debut"] = $date_debut;
            $reservations[$i]["date_fin"] = $date_fin;
            $reservations[$i]["nombre_de_semaine"] = $nombre_de_semaine;
            $reservations[$i]["nom_carte"] = $nom_carte;
            $reservations[$i]["numero_carte"] = $numero_carte;
            $reservations[$i]["id_carte"] = $id_carte;
            $i++;
        }

        $requete->closeCursor();
        $id = null;

        return $reservations;
    }

    // function SQL qui permet de récupérer les détails d'une commande d'un utilisateur
    public function extraireUneReservation($id_utilisateur)
    {
        if (!is_numeric($id_utilisateur))
        {
            throw new Exception("Identifiant utilisateur invalide");
        }

        $reservations = array();

        // cette requete est ce qu'on apelle un sub-select
        // permet de récupérer les données des détails d'une commande et la date de la commande 
        // pour permettre d'afficher sa valeur en entete, dans les détails d'un commande 
        $id = $this->connexionBD;
        $requete = $id->prepare("SELECT id_reservation,
                                         id_utilisateur,
                                         id_produit,
                                         date_debut,
                                         date_fin,
                                         nombre_de_semaine
                                         nom_carte,
                                         numero_carte,
                                         id_carte
                                  FROM reservations
                                  WHERE id_utilisateur = :id_utilisateur");

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }

        $requete->bindParam(':id_utilisateur',$id_utilisateur,PDO::PARAM_INT);

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'extraction sur la table reservations " . $id->errorCode());
        }
        
        $requete->bindColumn('id_reservation',$id_reservation);
        $requete->bindColumn('id_utilisateur',$id_utilisateur);
        $requete->bindColumn('id_produit',$id_produit);
        $requete->bindColumn('date_debut',$date_debut);
        $requete->bindColumn('date_fin',$date_fin);
        $requete->bindColumn('nombre_de_semaine',$nombre_de_semaine);
        $requete->bindColumn('nom_carte',$nom_carte);
        $requete->bindColumn('numero_carte',$numero_carte);
        $requete->bindColumn('id_carte',$id_carte);

        $i = 0;
        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $reservations[$i]["id_reservation"] = $id_reservation;
            $reservations[$i]["id_utilisateur"] = $id_utilisateur;
            $reservations[$i]["id_produit"] = $id_produit;
            $reservations[$i]["date_debut"] = $date_debut;
            $reservations[$i]["date_fin"] = $date_fin;
            $reservations[$i]["nombre_de_semaine"] = $nombre_de_semaine;
            $reservations[$i]["nom_carte"] = $nom_carte;
            $reservations[$i]["numero_carte"] = $numero_carte;
            $reservations[$i]["id_carte"] = $id_carte;
            $i++;
        }

        $requete->closeCursor();
        $id = null;

        return $reservations;
    }

    // function SQL qui permet de traiter une commande provenant du panier
    public function creerUneReservation($id_utilisateur,$id_produit,$date_debut,$date_fin,$nombre_de_semaine)
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
            throw new Exception("date_debut invalide");
        }
        else if ($date_fin == "")
        {
            throw new Exception("date_fin invalide");
        }
        else if ($nombre_de_semaine == "")
        {
            throw new Exception("nombre_de_semaine invalide");
        }

        // enlever ou convertir les caractères spéciaux
        $id_utilisateur = htmlentities($id_utilisateur, ENT_QUOTES, "UTF-8");
        $id_produit = htmlentities($id_produit, ENT_QUOTES, "UTF-8");
        $date_debut = htmlentities($date_debut, ENT_QUOTES, "UTF-8");
        $date_fin = htmlentities($date_fin, ENT_QUOTES, "UTF-8");
        $nombre_de_semaine = htmlentities($nombre_de_semaine, ENT_QUOTES, "UTF-8");

        $id = $this->connexionBD;
        $requete = $id->prepare("INSERT INTO reservations 
                                 (id_utilisateur,
                                  id_produit,
                                  date_debut,
                                  date_fin,
                                  nombre_de_semaine)
                                  VALUES (:id_utilisateur, 
                                          :id_produit, 
                                          :date_debut, 
                                          :date_fin, 
                                          :nombre_de_semaine)");

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }
        
        $requete->bindParam(':id_utilisateur',$id_utilisateur,PDO::PARAM_INT);
        $requete->bindParam(':id_produit',$id_produit,PDO::PARAM_INT);
        $requete->bindParam(':date_debut',$date_debut,PDO::PARAM_INT);
        $requete->bindParam(':date_fin',$date_fin,PDO::PARAM_INT);
        $requete->bindParam(':nombre_de_semaine',$nombre_de_semaine,PDO::PARAM_INT);

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'insertion sur la table reservations " . $id->errorCode());
        }
        
        $requete->closeCursor();
        
        $id = null;

        // retourne true si tout s'est bien passé
        return true;
    }

    // function SQL qui permet de traiter une commande provenant du panier
    public function modifierUneReservation($id_reservation,$id_utilisateur,$id_produit,$date_debut,$date_fin,$nombre_de_semaine)
    {
        if (!is_numeric($id_reservation))
        {
            throw new Exception("Identifiant reservation invalide");
        }
        else if (!is_numeric($id_utilisateur))
        {
            throw new Exception("Identifiant utilisateur invalide");
        }
        else if (!is_numeric($id_produit))
        {
            throw new Exception("Identifiant produit invalide");
        }
        else if ($date_debut == "")
        {
            throw new Exception("date_debut invalide");
        }
        else if ($date_fin == "")
        {
            throw new Exception("date_fin invalide");
        }
        else if ($nombre_de_semaine == "")
        {
            throw new Exception("nombre_de_semaine invalide");
        }

        // enlever ou convertir les caractères spéciaux
        $id_reservation = htmlentities($id_reservation, ENT_QUOTES, "UTF-8");
        $id_utilisateur = htmlentities($id_utilisateur, ENT_QUOTES, "UTF-8");
        $id_produit = htmlentities($id_produit, ENT_QUOTES, "UTF-8");
        $date_debut = htmlentities($date_debut, ENT_QUOTES, "UTF-8");
        $date_fin = htmlentities($date_fin, ENT_QUOTES, "UTF-8");
        $nombre_de_semaine = htmlentities($nombre_de_semaine, ENT_QUOTES, "UTF-8");

        $id = $this->connexionBD;
        $requete = $id->prepare("UPDATE reservations 
                                  SET id_Utilisateur     = :id_utilisateur,
                                      id_produit         = :id_produit,
                                      date_debut         = :date_debut,
                                      date_fin           = :date_fin,
                                      nombre_de_semaine  = :nombre_de_semaine
                                  WHERE id_reservation   = :id_reservation");

        $requete->bindParam(':id_reservation',$id_reservation,PDO::PARAM_INT);
        $requete->bindParam(':id_utilisateur',$id_utilisateur,PDO::PARAM_INT);
        $requete->bindParam(':id_produit',$id_produit,PDO::PARAM_STR);
        $requete->bindParam(':date_fin',$date_fin,PDO::PARAM_STR);
        $requete->bindParam(':nombre_de_semaine',$nombre_de_semaine,PDO::PARAM_INT);
        
        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur de mise à jour sur la table reservations " . $id->errorCode());
        }
        
        $requete->closeCursor();
        
        $id = null;

        // retourne true si tout s'est bien passé
        return true;
    }
}
?>