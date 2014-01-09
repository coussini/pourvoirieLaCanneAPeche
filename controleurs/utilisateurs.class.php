<?php

class Controleur
{
	public static function gererRequetes()
	{
		switch ($_GET['requete']) 
		{
			case 'valideInscription':
				self::valideInscription();
				break;               
			default:
				// erreur
				break;
		}
	}


	// traitement d'une commande provenant d'un panier
	 private static function valideInscription()
	{
		try
		{
			$oUtilisateurs = new Utilisateurs();
			// VALIDATION DU NOM
			if (!isset($_GET['nom']) || $_GET['nom'] == "") 
			{
				throw new Exception("SVP entrez votre nom.");
			}
			else
			{
				// expression régulière  nom
				if (!preg_match("/^([A-ZÉÈÏÔ][a-zéèïô]+)([ -][A-ZÉÈÏÔ][a-zéèïô]+)*$/"))
				{
					throw new Exception("Caractères autorisés : a-z, é, è, ô, -");
				} 
			}
			
			// VALIDATION DU PRENOM
			 if (!isset($_GET['prenom']) || $_GET['prenom'] == "") 
			{
				throw new Exception("SVP entrez votre prénom.");
			}
			else
			{
				// expression régulière  prenom
				if (!preg_match("/^([A-ZÉÈÏÔ][a-zéèïô]+)([ -][A-ZÉÈÏÔ][a-zéèïô]+)*$/"))
				{
					throw new Exception("Caractères autorisés : a-z, é, è, ô, -");
				} 
			}
			
			// VALIDATION DU COURRIEL
			 if (!isset($_GET['courriel']) || $_GET['courriel'] == "") 
			{
				throw new Exception("SVP remplissez la case.");
			}
			else
			{
				// expression régulière  courriel
				if (!preg_match("/^([a-z]+)([-_.][a-z]+)*@([a-z]+)([-_][a-z]+)*(\.[a-z]+)([-_.][a-z]+)*$/"))
				{
					throw new Exception("Adresse courriel invalide.");
				} 
			}
			
			// VALIDATION DU MOT DE PASSE
			 if (!isset($_GET['mot_de_passe']) || $_GET['mot_de_passe'] == "") 
			{
				throw new Exception("SVP remplissez la case.");
			}
			else
			{
				// expression régulière  mot de passe
				if (strlen($_GET['mot_de_passe']) < 6)
				{
					throw new Exception("Mot de passe doit contenir au moins 6 characters.");
				}
			}	
			
			
			// VALIDATION DU MOT DE PASSE 2
			 if (!isset($_GET['mot_de_passe']) || $_GET['mot_de_passe'] == "") 
			{
				throw new Exception("SVP confirmer le mot de passe.");
			}
			else
			{
				// expression régulière  mot de passe2
				if(mot_de_passe.value != mot_de_passe2.value))
				{
					throw new Exception("Votre mot de passe et la confirmation de votre mot de passe ne correspondent pas.");
				} 
			}
			
			
			// VALIDATION date de naissance
			 if (!isset($_GET['date_de_naissance']) || $_GET['date_de_naissance'] == "") 
			{
				throw new Exception("SVP indiquez votre date de naissance.");
			}
			else
			{
				// expression régulière date naissance
				if (!preg_match("/[^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$/"))
				{
					throw new Exception("SVP entrez une valeur numerique.");
				} 
			}
		}
		catch(Exception $e)
		{
			$_GET['erreur']  = $e->getMessage();
			formulairePasserUneCommande(); // TO CHANGE 
		}
	}
}



?>