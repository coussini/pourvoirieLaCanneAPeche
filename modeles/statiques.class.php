<?php
class Statiques
{
    private $connexionBD;

    public function __construct()
    {
        $oConnexionPDO = new ConnexionPDO("canneapeche","UTF8");
        $this->connexionBD = $oConnexionPDO->rConnexion;
    }
    
    // Récupérer un contenu statique par le nom    
    public function getContenuStatique($nom)
    {
        if ($nom=="")
        {
            throw new Exception("Nom invalide");
        }

        $contenuStatique = array();

        $id = $this->connexionBD;
        $requete = $id->prepare("SELECT statut,
                                        nom,
                                        contenu
                                 FROM   statiques 
                                 WHERE  nom = :nom");
        
        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }

        $requete->bindParam(':nom',$nom,PDO::PARAM_STR);
        
        $result = $requete->execute();

        $requete->bindColumn('statut',$statut);
        $requete->bindColumn('nom',$nom);
        $requete->bindColumn('contenu',$contenu);

        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $contenuStatique['statut'] = $statut; 
            $contenuStatique['nom'] = $nom;  
            $contenuStatique['contenu'] = $contenu;       
        }

        if ((!$statut) || (!$nom) || (!$contenu))
        {
            throw new Exception("Erreur d'extraction sur la table statiques " . $id->errorCode());
        }

        $requete->closeCursor();
        $id=null;

        return $contenuStatique;
    }

    // Récupérer un contenu statique par l'id

    public function getContenuStatiqueParID($idStatique)
    {
        if (!is_numeric($idStatique))
        {
            throw new Exception("Identifiant invalide");
        }
        $contenuStatique = array();

        $id = $this->connexionBD;

        $requete = $id->prepare("SELECT statut,nom,contenu
                                 FROM statiques 
                                 WHERE id_statique = :id_statique");

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }

        $requete->bindParam(':id_statique',$idStatique,PDO::PARAM_STR);

        $result = $requete->execute();

        $requete->bindColumn('statut',$statut);
        $requete->bindColumn('nom',$nom);
        $requete->bindColumn('contenu',$contenu);

        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $contenuStatique['statut'] = $statut; //htmlentities??
            $contenuStatique['nom'] = $nom;  
            $contenuStatique['contenu'] = $contenu;       
        }

        if ((!$statut) || (!$nom) || (!$contenu))
        {
            throw new Exception("Erreur d'extraction sur la table statiques " . $id->errorCode());
        }

        $requete->closeCursor();
        $id=null;

        return $contenuStatique;
    }

    // Récupérer l'id d'un contenu statique par le nom
    public function getidStatiqueByName($nom)
    {
        $id = $this->connexionBD;

        $requete = $id->prepare("SELECT id_statique
                             FROM statiques 
                             WHERE nom = :nom");

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }

        $requete->bindParam(':nom',$nom,PDO::PARAM_INT);

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'extraction sur la table statiques " . $id->errorCode());
        }
        
        $requete->bindColumn('id_statique',$idStatique);

        $result = $requete -> fetchColumn();
        $requete->closeCursor();
        $id=null;

        return $result;
    }

    // Récupérer les noms de tous les contenus statiques
    public function getNomsContenuStatique()
    {
        $nomsStatique = array();

        $id = $this->connexionBD;
        $requete = $id->prepare("SELECT nom
                                 FROM   statiques");
        
        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }
        
        $result = $requete->execute();

        $requete->bindColumn('nom',$nom);

        $i = 0;
        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $nomsStatique[$i] = $nom; 
            $i++;       
        }

        if (!$nom)
        {
            throw new Exception("Erreur d'extraction sur la table statiques " . $id->errorCode());
        }

        $requete->closeCursor();
        $id=null;

        return $nomsStatique;
    }


    // Créer un contenu statique
    public function setContenuStatique($statut,$nom,$contenu)
    {
       if (!((($statut == "actif") || ($statut == "inactif")) || ($statut == "detruit")) || ($statut == "")) 
        { 
            throw new Exception("Statut invalide");
        }
        else if ($nom == "") {
            throw new Exception("Nom invalide");
        }
        else if ($contenu == ""){
            throw new Exception("Contenu invalide");
        }

        // enlever ou convertir les caractères spéciaux
        $statut = htmlentities($statut, ENT_QUOTES, "UTF-8");
        $nom = htmlentities($nom, ENT_QUOTES, "UTF-8");
        $contenu = htmlentities($contenu, ENT_QUOTES, "UTF-8");

        $id = $this->connexionBD;
        $requete = $id->prepare("INSERT INTO statiques (statut,nom,contenu)
                                VALUES (:statut,:nom,:contenu)");

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }
        
        $requete->bindParam(':statut',$statut,PDO::PARAM_STR);
        $requete->bindParam(':nom',$nom,PDO::PARAM_STR);
        $requete->bindParam(':contenu',$contenu,PDO::PARAM_STR);

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'insertion sur la table statiques " . $id->errorCode());
        }
        
        $requete->closeCursor();
        
        $id = null;

        $messageConfirmation = "Création du contenu réussi";
        return $messageConfirmation; 
    }

    // Changer le statut d'un contenu statique
    public function changeStatutStatique($idStatique,$statut)
    {
        if (!is_numeric($idStatique)) {
            throw new Exception("Identifiant invalide");
        }
        else if (!((($statut == "actif") || ($statut == "inactif")) || ($statut == "detruit")) || ($statut == "")) {
            throw new Exception("Statut invalide");    
        }

        $id = $this->connexionBD;
        $requete = $id->prepare("UPDATE statiques
                                SET statut = :statut 
                                WHERE id_statique = :idStatique");

        $requete->bindParam(':statut',$statut,PDO::PARAM_STR);
        $requete->bindParam(':idStatique',$idStatique,PDO::PARAM_STR);
        
        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur de mise à jour sur la table statiques " . $id->errorCode());
        }
        
        $requete->closeCursor();
        
        $id = null;

        $messageConfirmation = "Changement du statut réussi";
        return $messageConfirmation;

    }
    // Changer le contenu
    public function updateContenuStatique($idStatique,$contenu)
    {
        if (!is_numeric($idStatique)) {
            throw new Exception("Identifiant invalide");
        }
        else if ($contenu == "") {
            throw new Exception("Contenu invalide");
        }
        $contenu = htmlentities($contenu, ENT_QUOTES, "UTF-8");

        $id = $this->connexionBD;
        $requete = $id->prepare("UPDATE statiques
                                SET contenu = :contenu 
                                WHERE id_statique = :idStatique");

        $requete->bindParam(':contenu',$contenu,PDO::PARAM_STR);
        $requete->bindParam(':idStatique',$idStatique,PDO::PARAM_STR);
        
        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur de mise à jour sur la table statiques " . $id->errorCode());
        }
        
        $requete->closeCursor();
        
        $id = null;

        $messageConfirmation = "Modification du contenu réussi";
        return $messageConfirmation;

    }
}

?>