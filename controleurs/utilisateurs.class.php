<?php

class Controleur
{

	public static function gererRequetes()
	{
	
		$_GET["courriel"] ='anne@yahoo.com';

		$_GET['requete']='req_valideLogin';

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
				
			default:
				// erreur
				break;
		}
	}

	// traitement formulaire login
	 private static function req_valideLogin()
	{
		try
		{
			//--------------------------------TESTS  LOGIN-----------------------------------------
			//-------------------------------------------------------------------------------------
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
			//$id_utilisateur = $oUtilisateurs->chercherIdUtilisateur($_GET["courriel"]);  a rementre

											//fonction extraireUtilisateur						
			//$utilisateurs = $oUtilisateurs->extraireUtilisateur('anne@yahoo.com');

			$utilisateurs = $oUtilisateurs->extraireUtilisateur($_GET["courriel"]);			
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
	// extraire les information sur utilisateur
	 private static function req_majUtilisateur()
	{
		try
		{
			//$oUtilisateurs = new Utilisateurs();
			//$id_utilisateur = $oUtilisateurs->chercherIdUtilisateur($_GET["courriel"]);  a rementre
											//fonction majUtilisateur						
			//$utilisateurs = $oUtilisateurs->majUtilisateur('toto@gmail.com');
			
			//$utilisateurs = $oUtilisateurs->majUtilisateur('toto@gmail.com');
			
            VueUtilisateurs::formulaire_majUtilisateur();
		}
				
		catch(Exception $e)
		{
			$_GET['erreur']  = $e->getMessage();
			VueUtilisateurs::formulaire_erreur();
			
		}	
	} 

	//-------------------------------------ETAPE 4 TEST CREER NOUVEAU UTILISATEUR--------------------------------
	//-------------------------------------------------------------------------------------------------
	// extraire les information sur utilisateur
	 private static function req_ajoutUtilisateur()
	{
		try
		{
			//$oUtilisateurs = new Utilisateurs();
			//$id_utilisateur = $oUtilisateurs->chercherIdUtilisateur($_GET["courriel"]);  a rementre
											//fonction majUtilisateur						
			//$utilisateurs = $oUtilisateurs->majUtilisateur('toto@gmail.com');
			
			//$utilisateursnew = $oUtilisateurs->ajoutUtilisateur($_GET["nom"],$_GET["prenom"],$_GET["courriel"],$_GET["mot_de_passe"],$_GET["date_de_naissance"]);
			
            VueUtilisateurs::formulaire_ajoutUtilisateur();
		}
				
		catch(Exception $e)
		{
			$_GET['erreur']  = $e->getMessage();
			VueUtilisateurs::formulaire_erreur();
			
		}	
	} 
	
	
	
}

?>