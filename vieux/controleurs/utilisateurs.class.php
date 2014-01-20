<?php
class Controleur
{
	public static function gererRequetes()
	{
		//$_GET["courriel"] ='amay@gmail.com';
		
		//$_GET["nom"] ='Almass';
		//$_GET["prenom"] ='Mayss';
		//$_GET["courriel"] ='amayss@gmail.com';
		//$_GET["mot_de_passe"] ='alma56mayss';
		//$_GET["date_de_naissance"] = "1978-10-30";

		//$_GET['requete']='req_ajoutUtilisateur';

		switch ($_GET['requete']) 
		{
			case 'req_valideLogin':
				self::req_valideLogin();
				break;
				
			case 'req_extraireUtilisateur':
				self::req_extraireUtilisateur();
				break;	
				
			case 'req_majUtilisateur':
				self::req_majUtilisateur();
				break;

			case 'req_ajoutUtilisateur':
				self::req_ajoutUtilisateur();
				break;	
				
			case 'req_oubliePass':
				self::req_oubliePass();
				break;	
				
			default:
				// erreur
				break;
		}
	}

	//--------------------------------TESTS  LOGIN-----------------------------------------
	//-------------------------------------------------------------------------------------
	// traitement formulaire login
	 private static function req_valideLogin()
	{
		try
		{
			
			$oUtilisateurs = new Utilisateurs();
			
			//$id_utilisateur = $oUtilisateurs->chercherIdUtilisateur($_GET["courriel"]);  a remetre
			
											//fonction chercherIdUtilisateur
			$id_utilisateur = $oUtilisateurs->chercherUtilisateur("toto@gmail.com");
			if($id_utilisateur==0){
				$utilisateur_present="false";
			}else $utilisateur_present="true";
            VueUtilisateurs::formulaire_validLogin($utilisateur_present);
				
		}
		catch(Exception $e)
		{
			$_GET['erreur']  = $e->getMessage();
			VueUtilisateurs::formulaire_erreur();
		}
	} 

	//-------------------------------------ETAPE 2 TEST EXTRAIRE UTILISATEUR----------------------------
	//--------------------------------------------------------------------------------------------------
			
	// extraire les information sur utilisateur
	 private static function req_extraireUtilisateur()
	{
		try
		{
			$oUtilisateurs = new Utilisateurs();
			$utilisateurs = $oUtilisateurs->extraireUtilisateur($_GET["courriel"]);//fonction extraireUtilisateur		
            VueUtilisateurs::formulaire_extraireUtilisateur($utilisateurs);
		}
			
		catch(Exception $e)
		{
			$_GET['erreur']  = $e->getMessage();
			VueUtilisateurs::formulaire_erreur();
			
		}	
	}
	
	//-------------------------------------ETAPE 3 TEST MAJ UTILISATEUR--------------------------------
	//-------------------------------------------------------------------------------------------------
	
	// MAJ les information sur utilisateur
	 private static function req_majUtilisateur()
	{
		try
		{
			$oUtilisateurs = new Utilisateurs();								
			$utilisateurs = $oUtilisateurs->majUtilisateur($_GET["courriel"]); //fonction majUtilisateur
            VueUtilisateurs::formulaire_majUtilisateur();
		}
				
		catch(Exception $e)
		{
			$_GET['erreur']  = $e->getMessage();
			VueUtilisateurs::formulaire_erreur();
			
		}	
	} 

	//-------------------------------------ETAPE 4 TEST CREER NOUVEAU UTILISATEUR--------------------------------
	//----------------------------------------------------------------------------------------------------------
	// ajouter les information sur utilisateur
	 private static function req_ajoutUtilisateur()
	{
		try
		{
			 if($_GET['action'] == 'inscrire')
			 {
				$oUtilisateurs = new Utilisateurs();
				var_dump($_POST);
				$utilisateursnew = $oUtilisateurs->ajoutUtilisateur($_POST["nom"],$_POST["prenom"],$_POST["courriel"], $_POST["mot_de_passe"],$_POST["date_de_naissance"]);
				//TODO : Qu'est-ce que fais apres...
			 }
			 else
			 {
				VueUtilisateurs::formulaire_ajoutUtilisateur();
			 }
		}
				
		catch(Exception $e)
		{
			$_GET['erreur']  = $e->getMessage();
			VueUtilisateurs::formulaire_erreur();
			
		}	
	} 
	
	//-------------------------------------ETAPE 5 TEST MOT DE PASS OUBLIÉ-------------------------------------
	//----------------------------------------------------------------------------------------------------------
	// extraire les information sur utilisateur
	
	 private static function req_oubliePass()
	{
		try
		{
			$oUtilisateurs = new Utilisateurs();						
			$utilisateurs = $oUtilisateurs->chercherUtilisateur($_GET["courriel"]);
            VueUtilisateurs::formulaire_oubliePass($utilisateurs);
		}
				
		catch(Exception $e)
		{
			$_GET['erreur']  = $e->getMessage();
			VueUtilisateurs::formulaire_erreur();
			
		}	
	} 
	
}

?>