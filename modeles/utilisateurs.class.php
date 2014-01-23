<?php
class Utilisateurs
{

	private $connexionBD;

    public function __construct()
    {
        $oConnexionPDO = new ConnexionPDO("canneapeche","UTF8");
		$this->connexionBD = $oConnexionPDO->rConnexion;
    }
	
	// fonction SQL qui permet de retourner le mot de passe de l'utilisateur
	// sinon les données retournées sont à blanc
	public function chercherUtilisateur($courriel)
	{
        $utilisateurs = array();
		
		if ($courriel == "")
		{
			throw new Exception("Identifiant ou mot de passe erroné.");
		}
		
		// enlever ou convertir les caractères spéciaux
		$courriel = htmlentities($courriel, ENT_QUOTES, "UTF-8");

		$id = $this->connexionBD;
		
		$requete = $id->prepare("SELECT id_utilisateur,
										mot_de_passe 
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
		$requete->bindColumn('mot_de_passe',$mot_de_passe);
		
        $resultat = $requete->fetchColumn(PDO::FETCH_BOUND);

        if ($requete->rowCount() > 0)
        {
            $utilisateurs["id_utilisateur"] = $id_utilisateur;
            $utilisateurs["mot_de_passe"] = $mot_de_passe;
        }
        else
        {
            $utilisateurs["id_utilisateur"] = "";
            $utilisateurs["mot_de_passe"] = "";
        }

		$requete->closeCursor();
		$id=null;

		return $utilisateurs;
	}

    // fonction SQL qui permet d'inserer un nouvel utilisateur 
    public function ajoutUtilisateur($nom,$prenom,$courriel,$mot_de_passe,$mot_de_passe2,$date_de_naissance)
    {
        if (strlen($mot_de_passe) < 6) 
        {
            throw new Exception("Mot de passe doit contenir au moins 6 characters.");
        }
        else if ($mot_de_passe != $mot_de_passe2) // expression régulière  mot de passe 2
        {
            throw new Exception("Votre mot de passe et la confirmation de votre mot de passe ne correspondent pas.");
        }
        
        // enlever ou convertir les caractères spéciaux
        $nom = htmlentities($nom, ENT_QUOTES, "UTF-8");
        $prenom = htmlentities($prenom, ENT_QUOTES, "UTF-8");
        $courriel = htmlentities($courriel, ENT_QUOTES, "UTF-8");
        $mot_de_passe = htmlentities($mot_de_passe, ENT_QUOTES, "UTF-8");
        $date_de_naissance = htmlentities($date_de_naissance,ENT_QUOTES, "UTF-8");
        
        $id = $this->connexionBD;

        $requete = $id->prepare("INSERT INTO utilisateurs 
                                            (nom,
                                            prenom,
                                            courriel,
                                            mot_de_passe,
                                            date_de_naissance)
                                    VALUES  (:nom,
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
        $requete->bindParam(':date_de_naissance',$date_de_naissance,PDO::PARAM_STR);
        
        $result =$requete->execute();
        
        if (!$result) 
        {
            throw new Exception("Erreur d'insertion sur la table utilisateur " . $id->errorCode());
        }

        $requete->closeCursor();
        $id=null;

        return true;
    }
    
    // fonction SQL qui permet de retourner le profil d'un utilisateur
    // sinon les données retournées sont à blanc
    public function extraireUtilisateur($courriel)
    {
        $utilisateurs = array();

        if ($courriel == "")
        {
            throw new Exception("Identifiant utilisateur invalide");
        }
        
        $id = $this->connexionBD;
        
        $requete = $id->prepare("SELECT nom,
                                        prenom,
                                        courriel,
                                        mot_de_passe,
                                        date_de_naissance
                                  FROM  utilisateurs
                                  WHERE courriel = :courriel
                                  AND   statut  = 'actif'");
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
     
        $resultat = $requete->fetchColumn(PDO::FETCH_BOUND);

        if ($requete->rowCount() > 0)
        {
            $utilisateurs["nom"] = $nom;
            $utilisateurs["prenom"] = $prenom;
            $utilisateurs["courriel"] = $courriel;
            $utilisateurs["mot_de_passe"] = $mot_de_passe;
            $utilisateurs["date_de_naissance"] = $date_de_naissance;
        }
        else
        {
            $utilisateurs["nom"] = "";
            $utilisateurs["prenom"] = "";
            $utilisateurs["courriel"] = "";
            $utilisateurs["mot_de_passe"] = "";
            $utilisateurs["date_de_naissance"] = "";
        }

        $requete->closeCursor();
        $id = null;

        return $utilisateurs;
    }
    
    // function SQL qui permet de mettre a jour des détails d'un utilisateur
    public function majUtilisateur($nom,$prenom,$courriel,$mot_de_passe,$mot_de_passe2,$date_de_naissance)
    {
        if ($nom == "") // VALIDATION DU NOM
        {
            throw new Exception("SVP entrez votre nom.");
        }
        else if (!preg_match("/^([A-ZÉÈÏÔ][a-zéèïô]+)([ -][A-ZÉÈÏÔ][a-zéèïô]+)*$/",$nom)) // expression régulière  nom
        {
            throw new Exception("Caractères autorisés : a-z, é, è, ô, -");
        }
        else if ($prenom == "") // VALIDATION DU PRENOM
        {
            throw new Exception("SVP entrez votre prénom.");
        }
        else if (!preg_match("/^([A-ZÉÈÏÔ][a-zéèïô]+)([ -][A-ZÉÈÏÔ][a-zéèïô]+)*$/",$prenom)) // expression régulière  prenom
        {
            throw new Exception("Caractères autorisés : a-z, é, è, ô, -");
        }
        else if ($courriel == "") // VALIDATION DU COURRIEL
        {
            throw new Exception("SVP entrez votre courriel.");
        }
        else if ($mot_de_passe == "")   // VALIDATION DU MOT DE PASSE
        {
            throw new Exception("SVP entrez votre mot de passe.");
        }
        else if (strlen($mot_de_passe) < 6) 
        {
            throw new Exception("Mot de passe doit contenir au moins 6 characters.");
        }
        else if ($mot_de_passe2 == "")     // VALIDATION DU MOT DE PASSE 2
        {
            throw new Exception("SVP confirmer le mot de passe.");
        }
        else if ($mot_de_passe != $mot_de_passe2) // expression régulière  mot de passe 2
        {
            throw new Exception("Votre mot de passe et la confirmation de votre mot de passe ne correspondent pas.");
        }
        
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
                                   AND  statut  = 'actif'");
                           
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
    }
}

?>