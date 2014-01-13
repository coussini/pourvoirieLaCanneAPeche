<?php


class Controleur
{
	public static function gererRequetes()
	{
	
		$_GET['requete']='req_extraireUtilisateur';
		switch ($_GET['requete']) 
		{
			case 'req_valideLogin':
				self::req_valideLogin();
				break;
				
			case 'req_extraireUtilisateur':
				self::req_extraireUtilisateur();
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
			//--------------------------------TESTS-------------------------------------------------
			//-------------------------------------------------------------------------------------
			$oUtilisateurs = new Utilisateurs();
			
			//$id_utilisateur = $oUtilisateurs->chercherIdUtilisateur($_GET["courriel"]);  a remetre
			
											//fonction chercherIdUtilisateur
			$id_utilisateur = $oUtilisateurs->chercherIdUtilisateur("toto@gmail.com");
			var_dump("test contr");
			if($id_utilisateur==0){
				$utilisateur_present="false";
			}else $utilisateur_present="true";
            VueUtilisateurs::formulaire_validLogin($utilisateur_present);
			
			//-------------------------------------------------------------------------------------
			//-------------------------------------------------------------------------------------
			
			$oUtilisateurs = new Utilisateurs();
			
			//$id_utilisateur = $oUtilisateurs->chercherIdUtilisateur($_GET["courriel"]);  a rementre
			$id_utilisateur = $oUtilisateurs->chercherIdUtilisateur("blabla");
			var_dump("test contr2");
			if($id_utilisateur==0){
				$utilisateur_present="false";
			}else $utilisateur_present="true";
            VueUtilisateurs::formulaire_validLogin($utilisateur_present);
			
			//-------------------------------------------------------------------------------------
			//-------------------------------------------------------------------------------------
			
			$oUtilisateurs = new Utilisateurs();
			var_dump("test contr3");
			//$id_utilisateur = $oUtilisateurs->chercherIdUtilisateur($_GET["courriel"]);  a rementre
			$id_utilisateur = $oUtilisateurs->chercherIdUtilisateur("");
			
			var_dump("test contr4");
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

		//-------------------------------------ETAPE 2 TEST------------------------------------------------
		//-------------------------------------------------------------------------------------------
			
	// extrare les information sur utilisateur
	 private static function req_extraireUtilisateur()
	{
		try
		{

			$oUtilisateurs = new Utilisateurs();

											//fonction extraireUtilisateur						
			$utilisateurs = $oUtilisateurs->extraireUtilisateur("toto@gmail.com");
            VueUtilisateurs::formulaire_extraireUtilisateur($utilisateurs);
			//VueUtilisateurs::formulaire_extraireUtilisateur($utilisateurs);
		}
			
			
		catch(Exception $e)
		{
			$_GET['erreur']  = $e->getMessage();
			VueUtilisateurs::formulaire_erreur();
			
		}	
	}
}

?>