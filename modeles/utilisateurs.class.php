<?php
class Utilisateurs
{

	private $connexionBD;

    public function __construct()
    {
        $oConnexionPDO = new ConnexionPDO("canneapeche","UTF8");
		$this->connexionBD = $oConnexionPDO->rConnexion;
    }
	
	//----------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------
	
	// function SQL qui permet de vérifier si un utilisateur (son courriel) est présent
	// RETOURNE 0 si le courriel n'est pas trouvé
	public function chercherUtilisateur($courriel)
	{
		
		if ($courriel == "")
		{
			throw new Exception("Identifiant ou mot de passe erroné.");
		}
		
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


	//----------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------
	
	// requette sapplique aussi pour le formulaire login
	// function SQL qui permet de récupérer les  données d'un utilisateur
	public function extraireUtilisateur($courriel)
	{
	
		 if ((!$courriel) || $courriel == "")
        {
            throw new Exception("Identifiant utilisateur invalide");
        }

       $utilisateurs = array();
		
        $id = $this->connexionBD;
		
        $requete = $id->prepare("SELECT  nom,
                                         prenom,
                                         courriel,
                                         mot_de_passe,
										 date_de_naissance
                                  FROM utilisateurs
                                  WHERE courriel = :courriel
								  AND    statut  = 'actif'");
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

        $requete->bindColumn('nom',$nom);
        $requete->bindColumn('prenom',$prenom);
        $requete->bindColumn('courriel',$courriel);
        $requete->bindColumn('mot_de_passe',$mot_de_passe);
		$requete->bindColumn('date_de_naissance',$date_de_naissance);
     
       $i = 0;
        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $utilisateurs["nom"] = $nom;
            $utilisateurs["prenom"] = $prenom;
            $utilisateurs["courriel"] = $courriel;
            $utilisateurs["mot_de_passe"] = $mot_de_passe;
			$utilisateurs["date_de_naissance"] = $date_de_naissance;
            $i++;
        }

        $requete->closeCursor();
        $id = null;

        return $utilisateurs;
       // return $requete;
	}
	
	//----------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------
	// function SQL qui permet de mettre a jour des détails d'un utilisateur
	public function majUtilisateur($nom,$prenom,$courriel,$mot_de_passe,$mot_de_passe2,$date_de_naissance)
	{
		// CONDITIONS -----------------------------------------
		// ---------------------------------------------------
		if ((!$nom) || $nom == "") // VALIDATION DU NOM
        {
            throw new Exception("SVP entrez votre nom.");
        }
        else if (!preg_match("/^([A-ZÉÈÏÔ][a-zéèïô]+)([ -][A-ZÉÈÏÔ][a-zéèïô]+)*$/",$nom)) // expression régulière  nom
        {
            throw new Exception("Caractères autorisés : a-z, é, è, ô, -");
        }
        else if ((!$prenom) || $prenom == "") // VALIDATION DU PRENOM
        {
            throw new Exception("SVP entrez votre prénom.");
        }
        else if (!preg_match("/^([A-ZÉÈÏÔ][a-zéèïô]+)([ -][A-ZÉÈÏÔ][a-zéèïô]+)*$/",$prenom)) // expression régulière  prenom
        {
            throw new Exception("Caractères autorisés : a-z, é, è, ô, -");
        }
        else if ((!$courriel) || $courriel == "") // VALIDATION DU COURRIEL
        {
            throw new Exception("SVP entrez votre courriel.");
        }
        else if (!preg_match("/^([a-z]+)([-_.][a-z]+)*@([a-z]+)([-_][a-z]+)*(\.[a-z]+)([-_.][a-z]+)*$/",$courriel)) // expression régulière  courriel
        {
            throw new Exception("Adresse courriel invalide.");
        }
		else if ((!$mot_de_passe) || $mot_de_passe == "") 	// VALIDATION DU MOT DE PASSE
        {
            throw new Exception("SVP entrez votre mot de passe.");
        }
        else if ($mot_de_passe < 6) // expression régulière  mot de passe
        {
            throw new Exception("Mot de passe doit contenir au moins 6 characters.");
        }
		else if ((!$mot_de_passe2) || $mot_de_passe2 == "") 	// VALIDATION DU MOT DE PASSE 2
        {
            throw new Exception("SVP confirmer le mot de passe.");
        }
        else if ($mot_de_passe != $mot_de_passe2) // expression régulière  mot de passe 2
        {
            throw new Exception("Votre mot de passe et la confirmation de votre mot de passe ne correspondent pas.");
        }
		
		else if ((!$date_de_naissance) || $date_de_naissance == "") // VALIDATION date de naissance
        {
            throw new Exception("SVP indiquez votre date de naissance année-mois-jour.");
        }
        else if (!preg_match("/[^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/",$date_de_naissance)) // expression régulière date naissance
        {
            throw new Exception("SVP entrez une valeur numerique.");
        }
		
		// FIN CONDITIONS--------------------------------------
		// ---------------------------------------------------
		
		
		 // enlever ou convertir les caractères spéciaux
		$nom = htmlentities($nom, ENT_QUOTES, "UTF-8");
		$prenom = htmlentities($prenom, ENT_QUOTES, "UTF-8");
		$courriel = htmlentities($courriel, ENT_QUOTES, "UTF-8");
		$mot_de_passe = htmlentities($mot_de_passe, ENT_QUOTES, "UTF-8");
		$date_de_naissance = htmlentities($date_de_naissance,ENT_QUOTES, "UTF-8");
		
		
		 $id = $this->connexionBD;
		 
		// pour permettre d'afficher les valuers dans un formulaire
		$requete = $id->prepare("UPDATE utilisateurs
									SET nom = :nom,
										prenom = :prenom,
										courriel = :courriel,
										mot_de_passe= :mot_de_passe,
										date_de_naissance= :date_de_naissance,
								 WHERE courriel = :courriel
								   AND    statut  = 'actif'");
						   
		$requete->bindParam(':nom',$nom,PDO::PARAM_STR);
		$requete->bindParam(':prenom',$prenom,PDO::PARAM_STR);
		$requete->bindParam(':courriel',$courriel,PDO::PARAM_STR);
		$requete->bindParam(':mot_de_passe',$mot_de_passe,PDO::PARAM_STR);
		$requete->bindParam(':date_de_naissance',$date_de_naissance,PDO::PARAM_INT);
		
		$requete->execute();
		
		if (!$result) 
        {
            throw new Exception("Erreur de mise à jour sur la table utilisateur " . $id->errorCode());
        }
		
		$requete->closeCursor();
		$id=null;

		// retourne true si tout s'est bien passé
        return true;
		//return $utilisateurs;
	}

	//----------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------
	// function SQL qui permet de inserer nouveaux donnés sur l'utilisateur
	 public function ajoutUtilisateur($nom,$prenom,$courriel,$mot_de_passe,$date_de_naissance)
	{
		// CONDITIONS -----------------------------------------
		// ---------------------------------------------------
		if ((!$nom) || $nom == "") // VALIDATION DU NOM
        {
            throw new Exception("SVP entrez votre nom.");
        }
        else if (!preg_match("/^([A-ZÉÈÏÔ][a-zéèïô]+)([ -][A-ZÉÈÏÔ][a-zéèïô]+)*$/",$nom)) // expression régulière  nom
        {
            throw new Exception("Caractères autorisés : a-z, é, è, ô, -");
        }
        else if ((!$prenom) || $prenom == "") // VALIDATION DU PRENOM
        {
            throw new Exception("SVP entrez votre prénom.");
        }
        else if (!preg_match("/^([A-ZÉÈÏÔ][a-zéèïô]+)([ -][A-ZÉÈÏÔ][a-zéèïô]+)*$/",$prenom)) // expression régulière  prenom
        {
            throw new Exception("Caractères autorisés : a-z, é, è, ô, -");
        }
        else if ((!$courriel) || $courriel == "") // VALIDATION DU COURRIEL
        {
            throw new Exception("SVP entrez votre courriel.");
        }
        else if (!preg_match("/^([a-z]+)([-_.][a-z]+)*@([a-z]+)([-_][a-z]+)*(\.[a-z]+)([-_.][a-z]+)*$/",$courriel)) // expression régulière  courriel
        {
            throw new Exception("Adresse courriel invalide.");
        }
		else if ((!$mot_de_passe) || $mot_de_passe == "") 	// VALIDATION DU MOT DE PASSE
        {
            throw new Exception("SVP entrez votre mot de passe.");
        }
        else if ($mot_de_passe < 6) // expression régulière  mot de passe
        {
            throw new Exception("Mot de passe doit contenir au moins 6 characters.");
        }
		else if ((!$mot_de_passe2) || $mot_de_passe2 == "") 	// VALIDATION DU MOT DE PASSE 2
        {
            throw new Exception("SVP confirmer le mot de passe.");
        }
        else if ($mot_de_passe != $mot_de_passe2) // expression régulière  mot de passe 2
        {
            throw new Exception("Votre mot de passe et la confirmation de votre mot de passe ne correspondent pas.");
        }
		
		else if ((!$date_de_naissance) || $date_de_naissance == "") // VALIDATION date de naissance
        {
            throw new Exception("SVP indiquez votre date de naissance année-mois-jour.");
        }
        else if (!preg_match("/[^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/",$date_de_naissance)) // expression régulière date naissance
        {
            throw new Exception("SVP entrez une valeur numerique.");
        }
		
		// FIN CONDITIONS--------------------------------------
		// ---------------------------------------------------
		
		// enlever ou convertir les caractères spéciaux
		$nom = htmlentities($nom, ENT_QUOTES, "UTF-8");
		$prenom = htmlentities($prenom, ENT_QUOTES, "UTF-8");
		$courriel = htmlentities($courriel, ENT_QUOTES, "UTF-8");
		$mot_de_passe = htmlentities($mot_de_passe, ENT_QUOTES, "UTF-8");
		$mot_de_passe2 = htmlentities($mot_de_passe2, ENT_QUOTES, "UTF-8");
		$date_de_naissance = htmlentities($date_de_naissance,ENT_QUOTES, "UTF-8");
		
        $id = $this->connexionBD;

		$requete = $id->prepare("INSERT INTO utilisateurs 
											(nom,
											 prenom,
											 courriel,
											 mot_de_passe,
											 date_de_naissance)
									VALUES 	(:nom,
											 :prenom,
											 :courriel,
											 :mot_de_passe,
											 :date_de_naissance)");
								 				
		 if (!$requete) 
		{
			throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
		}
				
		$requete->bindParam(':nom',$nom,PDO::PARAM_STR);
		$requete->bindParam(':prenom',$prenom,PDO::PARAM_STR);
		$requete->bindParam(':courriel',$courriel,PDO::PARAM_STR);
		$requete->bindParam(':mot_de_passe',$mot_de_passe,PDO::PARAM_STR);
		$requete->bindParam(':date_de_naissance',$date_de_naissance,PDO::PARAM_INT);
		
		$result =$requete->execute();
		
		if (!$result) 
		{
			throw new Exception("Erreur d'insertion sur la table utilisateur " . $id->errorCode());
		}
		else if ($result) 
		{
			throw new Exception("Felicitation vous êtes enregistré.");
		}

		$requete->closeCursor();
		$id=null;

		return true;
	}

	
	/* MOT DE PASSE TEMPORRAIRE
	
	http://ziemecki.net/content/php-temporary-random-password-generator
	function genPassword ($length = 8)
	 {
	   // given a string length, returns a random password of that length
	   $password = "";
	   // define possible characters
	   $possible = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	   $i = 0;
	   // add random characters to $password until $length is reached
	   while ($i < $length) {
		 // pick a random character from the possible ones
		 $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
		 // we don't want this character if it's already in the password
		 if (!strstr($password, $char)) {
		   $password .= $char;
		   $i++;
		 }
	   }
	   return $password;
	   
	   $newpass = generatePassword(5);
		print "Your new password is " . $newpass . "!";
	}
	
	
	http://stackoverflow.com/questions/6101956/generating-a-random-password-in-php
	function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
	}
	*/

}

?>