<?php
class Utilisateurs
{

	private $connexionBD;

    public function __construct()
    {
        $oConnexionPDO = new ConnexionPDO("canneapeche","UTF8");
		$this->connexionBD = $oConnexionPDO->rConnexion;
    }
	
	//--------------------------------------------------------------------------------------
	// function SQL qui permet de vérifier si un utilisateur (son courriel) est présent
	// RETOURNE 0 si le courriel n'est pas trouvé
	public function chercherIdUtilisateur($courriel)
	{
		
		if ($courriel == "")
		{
			throw new Exception("Identifiant ou mot de passe erroné.");
		}
		var_dump("test model");
		// enlever ou convertir les caractères spéciaux
		$courriel = htmlentities($courriel, ENT_QUOTES, "UTF-8");

		$id = $this->connexionBD;
		
		$requete = $id->prepare("SELECT id_utilisateur 
										 FROM utilisateurs 
										 WHERE courriel = :courriel 
										 AND statut= 'actif'");
        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }

		$requete->bindParam(':courriel',$courriel,PDO::PARAM_STR);
		$requete->execute();
		$requete->bindColumn('id_utilisateur',$id_utilisateur);
		
		$idUtilisateur = 0; // on met par défaut à zéro

		while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
		{
			$idUtilisateur = $id_utilisateur;        
		}

		$requete->closeCursor();
		$id=null;

		return $idUtilisateur;
	}


	//--------------------------------------------------------------------------------------
	//--------------------------------------------------------------------------------------
	// requette sapplique aussi pour le formulaire login
	// function SQL qui permet de récupérer linformation d'un utilisateur
	public function extraireUtilisateur($courriel)
	{

		var_dump("def")	
       $utilisateurs = array();
	   
	   $courriel = htmlentities($courriel, ENT_QUOTES, "UTF-8");

        // cette requete est ce qu'on apelle un sub-select
        // permet de récupérer les données d'une commande et le total des détails 
        // pour permettre d'afficher sa valeur dans la liste des commandes passées 
		
        $id = $this->connexionBD;
		
        $requete = $id->prepare("SELECT  id_utilisateur,
                                         nom,
                                         prenom,
                                         courriel,
                                         mot_de_passe,
										 date_de_naissance
                                  FROM utilisateurs
                                  WHERE courriel = :courriel
                                 //AND    statut  = 'actif'");
        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }
        $requete->bindParam(':courriel',$courriel,PDO::PARAM_STR);

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'extraction sur la table utilisateurs " . $id->errorCode());
        }

        $requete->bindColumn('id_utilisateur',$id_utilisateur);
        $requete->bindColumn('nom',$nom);
        $requete->bindColumn('prenom',$prenom);
        $requete->bindColumn('courriel',$courriel);
        $requete->bindColumn('mot_de_passe',$mot_de_passe);
		$requete->bindColumn('date_de_naissance',$date_de_naissance);
     
        $i = 0;
        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $utilisateurs[$i]["id_utilisateur"] = $id_utilisateur;
            $utilisateurs[$i]["nom"] = $nom;
            $utilisateurs[$i]["prenom"] = $prenom;
            $utilisateurs[$i]["courriel"] = $courriel;
            $utilisateurs[$i]["mot_de_passe"] = $mot_de_passe;
			$utilisateurs[$i]["date_de_naissance"] = $date_de_naissance;
            $i++;
        }

        $requete->closeCursor();
        $id = null;

        return $utilisateurs;
	}
}	
	

?>