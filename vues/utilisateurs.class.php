<?php
// ICI on met tout ce qui va être insérer dans les squelettes
// Je vous reviens là dessus

// function qui retourne le formulaire "info utilisateur"
class VueUtilisateurs
{
    public static function formulaire_extraireUtilisateur($utilisateurs)
    {
			
 
        $form = '';
       // $form .= '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
        $form .= '<form id="formulaire_extraireUtilisateur">';
        $form .= '<h2>Info utilisateur</h2>';
		

      for ($i = 0; $i < count($utilisateurs); $i++) 
        {
            $form .= '<p> nom: ' . $utilisateurs[$i]["nom"] . '</p>';
            $form .= '<p> prenom: ' . $utilisateurs[$i]["prenom"] . '</p>';
            $form .= '<p> courriel: ' . $utilisateurs[$i]["courriel"] . '</p>';
            $form .= '<p> mot_de_passe: ' . $utilisateurs[$i]["mot_de_passe"] . '</p>';
            $form .= '<p> date_de_naissance: ' . $utilisateurs[$i]["date_de_naissance"] . '</p>';
        }

		
    
            $form .= '<p> nom: ' . $utilisateurs[0] . '</p>';

			
		
        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
       // $form .= '</body>';
       // $form .= '</html>';
        echo $form;
    }
	
	
	  // function qui retourne le formulaire "login"
    public static function formulaire_validLogin($resultat)
    {
       var_dump($resultat);
	    var_dump("ici");
	   $form = '';
        $form .= '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
        $form .= '<form id="formulaireCreerUneReservation">';
        $form .= '<h2>Form login</h2>';
        $form .= '<p> resultat: ' . $resultat . '</p>';    
        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        $form .= '</body>';
        $form .= '</html>';
        echo $form;
    }
	
	 public static function formulaire_erreur()
    {
        $form = '';
        $form .= '<form id="formulaire_erreur">';
        $form .= '<h2>formulaire_erreur</h2>';
        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        $form .= '</body>';
        $form .= '</html>';
        echo $form;
    }
 }	

?>