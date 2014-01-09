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

        $requete = $id->prepare("SELECT statut,nom,contenu
                             FROM statiques 
                             WHERE nom = :nom");

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'extraction sur la table statiques " . $id->errorCode());
        }

        $requete->bindParam(':nom',$nom,PDO::PARAM_STR);
        $requete->execute();
        $requete->bindColumn('statut',$statut);
        $requete->bindColumn('nom',$nom);
        $requete->bindColumn('contenu',$contenu);

        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $contenuStatique['statut'] = $statut; //htmlentities??
            $contenuStatique['nom'] = $nom;  
            $contenuStatique['contenu'] = $contenu;       
        }

        $requete->closeCursor();
        $id=null;

        return $contenuStatique;
    }

    // Récupérer un contenustatique par l'id

    public function getContenuStatiqueParID($idstatique)
    {
        if (!is_numeric($idstatique))
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

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'extraction sur la table statiques " . $id->errorCode());
        }

        $requete->bindParam(':id_statique',$idstatique,PDO::PARAM_STR);
        $requete->execute();
        $requete->bindColumn('statut',$statut);
        $requete->bindColumn('nom',$nom);
        $requete->bindColumn('contenu',$contenu);

        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $contenuStatique['statut'] = $statut; //htmlentities??
            $contenuStatique['nom'] = $nom;  
            $contenuStatique['contenu'] = $contenu;       
        }

        $requete->closeCursor();
        $id=null;

        return $contenuStatique;
    }

    // Récupérer l'id d'un contenu statique par le nom
    public function getidstatiqueByName($nom)
    {
        $id = $this->connexionBD;

        $requete = $id->prepare("SELECT id_statique
                             FROM statiques 
                             WHERE nom = :nom");

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }

        $requete->bindParam(':id_utilisateur',$id_utilisateur,PDO::PARAM_INT);

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'extraction sur la table statiques " . $id->errorCode());
        }
        
        $requete->bindParam(':nom',$nom,PDO::PARAM_STR);
        $requete->execute();
        $requete->bindColumn('id_statique',$idstatique);
        $result = $requete -> fetchColumn();
        $requete->closeCursor();
        $id=null;

        return $result;
    }

    // Créer un contenu statique
    public function setContenuStatique($statut,$nom,$contenu)
    {
        if (!((($statut == "actif") || ($statut == "inactif")) || ($statut == "detruit")) || ($statut == "")) {
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

        if ($rep) {
            return true;
        }
        else {
            return false;
        }
    }

    // Changer le statut d'un contenu statique ou détruire une rangée
    public function changeStatutStatique($idstatique,$statut)
    {
        if (!is_numeric($idstatique)) {
            throw new Exception("Identifiant invalide");
        }
        else if (!((($statut == "actif") || ($statut == "inactif")) || ($statut == "detruit")) || ($statut == "")) {
            throw new Exception("Statut invalide");    
        }

        $id = $this->connexionBD;
        $requete = $id->prepare("UPDATE statiques
                                SET statut = :statut 
                                WHERE id_statique = :idstatique");

        $requete->bindParam(':statut',$statut,PDO::PARAM_STR);
        $requete->bindParam(':idstatique',$idstatique,PDO::PARAM_STR);
        
        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur de mise à jour sur la table statiques " . $id->errorCode());
        }
        
        $requete->closeCursor();
        
        $id = null;

        if ($rep) {
            return true;
        }
        else {
            return false;
        }
    }
    // Changer le statut d'un contenu statique ou détruire une rangée
    public function updateContenuStatique($idstatique,$contenu)
    {
        if (!is_numeric($idstatique)) {
            throw new Exception("Identifiant invalide");
        }
        else if ($contenu == "") {
            throw new Exception("Contenu invalide");
        }
        $contenu = htmlentities($contenu, ENT_QUOTES, "UTF-8");

        $id = $this->connexionBD;
        $requete = $id->prepare("UPDATE statiques
                                SET contenu = :contenu 
                                WHERE id_statique = :idstatique");

        $requete->bindParam(':contenu',$contenu,PDO::PARAM_STR);
        $requete->bindParam(':idstatique',$idstatique,PDO::PARAM_STR);
        
        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur de mise à jour sur la table statiques " . $id->errorCode());
        }
        
        $requete->closeCursor();
        
        $id = null;

        if ($rep) {
            return true;
        }
        else {
            return false;
        }
    }
}
//TESTS:
//echo setContenuStatique('actif', 'test', 'ceci est un test') . "<br/>";
//echo setContenuStatique('actifg', 'test', 'ceci est un test') . "<br/>"; 
//echo setContenuStatique('actif', 'test', 'ceci est\'DROP TABLE statique\' un test') . "<br/>"; 
//$contenuStatique = getContenuStatique(1);
//echo $contenuStatique['contenu'] . "<br/>";
//echo getContenuStatique('test') . "<br/>";
//echo getContenuStatique('2') . "<br/>";
//echo getidstatiqueByName('test') . "<br/>";
//echo changeStatutStatique(1,'inactif') . "<br/>";
//echo changeStatutStatique(2,'detruit') . "<br/>";
//echo updateContenuStatique(3,'Encore un test') . "<br/>";
//echo setContenuStatique('actif', 'test1', 'ceci est le test1') . "<br/>";
//$test = getContenuStatique('test1');
//echo $test['contenu'];
?>