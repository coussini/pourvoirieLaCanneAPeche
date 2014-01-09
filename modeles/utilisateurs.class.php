<?php
class Utilisateurs
{

	 private $connexionBD;

    public function __construct()
    {
        $oConnexionPDO = new ConnexionPDO("canneapeche","UTF8");
		$this->connexionBD = $oConnexionPDO->rConnexion;
    }
	
	// function SQL qui permet de vérifier si un utilisateur (son courriel) est présent
	// RETOURNE 0 si le courriel n'est pas trouvé
	public function chercherIdUtilisateur($courriel)
	{
		if ($courriel == "")
		{
			throw new Exception("Identifiant ou mot de passe erroné.");
		}

		// enlever ou convertir les caractères spéciaux
		$courriel = htmlentities($courriel, ENT_QUOTES, "UTF-8");

		$id = $this->connexionBD;
		
		$requete = $id->prepare("SELECT id_utilisateur 
										 FROM Utilisateurs 
										 WHERE courriel = :courriel");

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



	// function SQL qui permet de inserer nouveau donnés sur l'utilisateur

	 public function valideInscription()
	{
		if ($courriel == "")
		{
			throw new Exception("Identifiant ou mot de passe erroné.");
		}

		// enlever ou convertir les caractères spéciaux
		$courriel = htmlentities($courriel, ENT_QUOTES, "UTF-8");

		$id = $this->connexionBD;

		$requete = $id->prepare("INSERT INTO utilisateurs (nom, prenom, courriel, mot_de_passe, date_de_naissance)
										VALUES (:nom, :prenom, :courriel, :mot_de_passe, :date_de_naissance)");
								 
						
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
			throw new Exception("Erreur d'insertion sur la table reservations " . $id->errorCode());
		}
		else if ($result) 
		{
			throw new Exception("Felicitation vous êtes enregistrée.");
		}

		$requete->closeCursor();
		$id=null;

		return true;
	}




	// requette sapplique aussi pour le formulaire login
	// function SQL qui permet de récupérer linformation d'un utilisateur
	public function extraireUtilisateur($id_utilisateur)
	{
		if (!is_numeric($id_utilisateur))
		{
			throw new Exception("Identifiant ou mot de passe erroné.");
		}

		$details = array();

		$id = $this->connexionBD;

		// cette requete est ce qu'on apelle un sub-select
		// permet de récupérer les données sur utilisateur
		// pour permettre d'afficher les valuers dans un formulaire
		$requete = $id->prepare("SELECT id_utilisateur,
									   nom,
									   prenom,
									   courriel,
									   mot_de_passe,
									   date_de_naissance,
								FROM utilisateurs
								WHERE courriel = :courriel");

		$requete->bindParam(':courriel',$courriel,PDO::PARAM_STR);
		$requete->execute();
		$requete->bindColumn('nom',$nom);
		$requete->bindColumn('prenom',$prenom);
		$requete->bindColumn('courriel',$courriel);
		$requete->bindColumn('mot_de_passe',$mot_de_passe);
		$requete->bindColumn('mot_de_passe',$mot_de_passe2);
		$requete->bindColumn('date_de_naissance',$date_de_naissance);
	 
		$i = 0;
		while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
		{
			// remettre les caractères spéciaux
			$utilisateurs[$i]["nom"] = html_entity_decode($nom, ENT_QUOTES, "UTF-8");
			$utilisateurs[$i]["prenom"] = html_entity_decode($prenom, ENT_QUOTES, "UTF-8");
			$utilisateurs[$i]["courriel"] = html_entity_decode($courriel, ENT_QUOTES, "UTF-8");
			$utilisateurs[$i]["mot_de_passe"] = html_entity_decode($mot_de_passe, ENT_QUOTES, "UTF-8");
			$utilisateurs[$i]["mot_de_passe"] = html_entity_decode($mot_de_passe2, ENT_QUOTES, "UTF-8");
			$utilisateurs[$i]["date_de_naissance"] = $date_de_naissance;
			$i++;
		}

		$requete->closeCursor();
		$id=null;

		return $utilisateurs;
	}


	// function SQL qui permet de changer linformation d'un utilisateur
	public function misAjourUtilisateur($id_utilisateur)
	{
		if (!is_numeric($id_utilisateur))
		{
			throw new Exception("Identifiant ou mot de passe erroné.");
		}

		$details = array();

		$id = $this->connexionBD;

		// cette requete est ce qu'on apelle un sub-select
		// permet de récupérer les données des détails sur utilisateur
		// pour permettre d'afficher les valuers dans un formulaire
		$requete = $id->prepare("UPDATE utilisateurs
									SET nom ='$nom',
										prenom = '$prenom'
										courriel = '$courriel'
										mot_de_passe='$mot_de_passe'
										mot_de_passe='$mot_de_passe2'
										date_de_naissance='$date_de_naissance'
									WHERE id_utilisateur = '{$_POST['id_utilisateur']}')";

		$requete->bindParam(':courriel',$courriel,PDO::PARAM_STR);
		$requete->execute();
		$requete->bindColumn('nom',$nom);
		$requete->bindColumn('prenom',$prenom);
		$requete->bindColumn('courriel',$courriel);
		$requete->bindColumn('mot_de_passe',$mot_de_passe);
		$requete->bindColumn('mot_de_passe',$mot_de_passe2);
		$requete->bindColumn('date_de_naissance',$date_de_naissance);
	 
		$i = 0;
		while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
		{
			// remettre les caractères spéciaux
			$utilisateurs[$i]["nom"] = html_entity_decode($nom, ENT_QUOTES, "UTF-8");
			$utilisateurs[$i]["prenom"] = html_entity_decode($prenom, ENT_QUOTES, "UTF-8");
			$utilisateurs[$i]["courriel"] = html_entity_decode($courriel, ENT_QUOTES, "UTF-8");
			$utilisateurs[$i]["mot_de_passe"] = html_entity_decode($mot_de_passe, ENT_QUOTES, "UTF-8");
			$utilisateurs[$i]["mot_de_passe"] = html_entity_decode($mot_de_passe2, ENT_QUOTES, "UTF-8");
			$utilisateurs[$i]["date_de_naissance"] = $date_de_naissance;
			$i++;
		}

		$requete->closeCursor();
		$id=null;

		return $utilisateurs;
	}

}

?>