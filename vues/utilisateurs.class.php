<?php
class VueUtilisateurs
{
    

    // fonction qui oermet d'aller sur admin.php
    public static function formulaire_se_diriger_vers_admin()
    {
        $form = '';

        $form .= '<div class="container">';
        $form .= '<div class="row">';
        $form .= '<div class="col-md-8 frm_general">';       
        $form .= '<div class="col-md-8 grostitres">';
        $form .= '<p>CONFIRMATION</p>';
        $form .= '</div>';
        $form .= '<div class="formlogin col-md-5"><!--formulaire login -->';
        $form .= '<form role="form" action="./admin.php?requete=elements_statique_html" method="POST">';
        $form .='<button type="submit" class="btn btn-custom-vert btn-lg">CONFIRMER</button>';                              
        $form .='<br>';
        $form .='</form>';
        $form .='</div><!--fin formulaire login -->';
        $form .='</div><!-- /.frm_general -->';              
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';

        echo $form;
    } 

	// fonction qui retourne le formulaire "login.html"
    public static function formulaire_login_html($prochaineRequete,$message_erreur_login)
    {
		$form = '';

		$form .= '<div class="container">';
		$form .= '<div class="row">';
		$form .= '<div class="col-md-8 frm_general">';       
		$form .= '<div class="col-md-8 grostitres">';
		$form .= '<p>ÊTES VOUS DEJA INSCRIT? NON? INCRIVEZ-VOUS!</p>';
		$form .= '</div>';
		$form .= '<div class="formlogin col-md-5"><!--formulaire login -->';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
		$form .= '<div class="form-group">';
		$form .= '<label for="courriel">ADRESSE COURRIEL</label>';
		$form .= '<input type="email" class="form-control" name="courriel" id="courriel" placeholder="nom@domain.com" required>';
		$form .= '</div>';
		$form .= '<div class="form-group">';
		$form .= '<label for="mot_de_passe">MOT DE PASSE</label>';
		$form .= '<input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" placeholder="*******" required>';
		$form .='</div>';
		$form .= '<a href="./index.php?requete=nouveaupass_html">MOT DE PASSE OUBLIÉ?</a>'; 
        $form .= '<input type="hidden" name="requete" value="' . $prochaineRequete . '">';
		$form .='<button type="submit" class="btn btn-custom-vert btn-lg">CONNECTER</button>';                              
		$form .='<br>';

        if ($message_erreur_login != "")
        {
            $form .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">&nbsp</span>' . $message_erreur_login .'</div>';            
        }

		$form .='</form>';
		$form .='</div><!--fin formulaire login -->';
		$form .='<div class="formlogin2 col-md-6">';
		$form .='<p>NOUVEL UTILISATEUR?</p>';        
		$form .= '<a class="btn btn-custom-gris btn-lg" href="./index.php?requete=inscription_html">S\'INSCRIRE</a>'; 		           
		$form .= '<div class="telephone">';
        $form .= ' <p>869.458.1273</p>';
		$form .= '</div>';
		$form .= '</div><!--formlogin col-md-6-->';
		$form .='</div><!-- /.frm_general -->';              
		$form .= '</div><!-- /.row -->';
		$form .= '</div> <!-- /.container -->';

		echo $form;
    } 
    
    // fonction qui retourne le formulaires "inscription.html"
    public static function formulaire_inscription_html($prochaineRequete,$message_erreur_login)
     {
        $form = '';
  
        $form .= '<div class="container">';
        $form .= '<div class="row">';
        $form .= '<div class="col-md-8 frm_general">';
        $form .= '<div class="col-md-8 grostitres">';
        $form .= '<p>INSCRIVEZ VOUS POUR RESERVER NOS CHALETS !</p>';
        $form .= '</div>';
        $form .= '<div class="formlogin col-md-10"><!--formulaire -->';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
        $form .= '<div class="form-group">';
        $form .= '<label for="nom">NOM</label>';
        $form .= '<input type="text" class="form-control" name="nom" id="nom" placeholder="votre nom" required>';
        $form .= '</div>';
        $form .= '<div class="form-group">' ;
        $form .= '<label for="prenom">PRÉNOM</label>';
        $form .= '<input type="text" class="form-control" name="prenom" id="prenom" placeholder="votre prénom" required>';
        $form .= '</div>';
        $form .= '<div class="form-group">';
        $form .= '<label for="courriel">ADRESSE COURRIEL</label>';
        $form .= '<input type="email" class="form-control" name="courriel" id="courriel" placeholder="nom@domain.com" required>';
        $form .= '</div>';
        $form .= '<div class="form-group">';
        $form .= '<label for="mot_de_passe">MOT DE PASSE (6 caractères minimum)</label>';
        $form .= '<input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" placeholder="mot de passe". required>';
        $form .= '</div>';
        $form .= '<div class="form-group">';
        $form .= '<label for="mot_de_passe2">CONFIRMER MOT DE PASSE</label>';
        $form .= '<input type="password" class="form-control" name="mot_de_passe2" id="mot_de_passe2" placeholder="mot de passe". required>';
        $form .= '</div>';
        $form .= '<div class="form-group">';
        $form .= '<label for="date_de_naissance">DATE DE NAISSANCE(aaaa-mm-jj)</label>';
        $form .= '<input type="text" class="form-control" name="date_de_naissance" id="date_de_naissance" placeholder="1956-07-30". required>';
        $form .= '</div>';
        $form .= '<input type="hidden" name="requete" value="' . $prochaineRequete . '">';
        $form .= '<button type="submit" class="btn btn-custom-vert btn-lg">S\'INSCRIRE</button>';   
        $form .= '<br>';
        $form .= '</form>';
        $form .= '</div><!--fin formulaire-->';
        $form .= '</div><!-- /.frm_general -->';        
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';

        echo $form;
    }
    
    // fonction qui retourne le formulaires "profil.html"
    public static function formulaire_profil_html($utilisateurs,$prochaineRequete,$message)
    {
        $form = '';
    
        $form .= '<div class="container">';
        $form .= '<div class="row">';
        $form .= '<div class="col-md-8 frm_general">';
        $form .= '<div class="col-md-8 grostitres">';
        $form .= '<p>BIENVENUE '. $utilisateurs["prenom"] .'</p>';
        $form .= '</div>';
        $form .= '<div class="formlogin col-md-10"><!--formulaire-->';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
        $form .= '<div class="form-group">';
        $form .= '<input type="hidden" name="id_utilisateur" value="'. $utilisateurs["id_utilisateur"] .'"';
        $form .= '<label for="nom">NOM</label>';
        $form .= '<input type="text" class="form-control" name="nom" id="nom" value="'. $utilisateurs["nom"] .'" required>';
        $form .= '</div>';
        $form .= '<div class="form-group">' ;
        $form .= '<label for="prenom">PRÉNOM</label>';
        $form .= '<input type="text" class="form-control" name="prenom" id="prenom" value="'. $utilisateurs["prenom"] .'" required>';
        $form .= '</div>';
        $form .= '<div class="form-group">';
        $form .= '<label for="courriel">ADRESSE COURRIEL</label>';
        $form .= '<input type="email" class="form-control" name="courriel" id="courriel" value="'. $utilisateurs["courriel"] .'" required>';
        $form .= '</div>';
        $form .= '<div class="form-group">';
        $form .= '<label for="mot_de_passe">MOT DE PASSE (6 caractères minimum)</label>';
        $form .= '<input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" value="'.$utilisateurs["mot_de_passe"] .'" required>';
        $form .= '</div>';
        $form .= '<div class="form-group">';
        $form .= '<label for="mot_de_passe2">CONFIRMER MOT DE PASSE</label>';
        $form .= '<input type="password" class="form-control" name="mot_de_passe2" id="mot_de_passe2" value="'.$utilisateurs["mot_de_passe"] .'" required>';
        $form .= '</div>';
        $form .= '<div class="form-group">';
        $form .= '<label for="date_de_naissance">DATE DE NAISSANCE (aaaa-mm-jj)</label>';
        $form .= '<input type="text" class="form-control" name="date_de_naissance" id="date_de_naissance" value="'.$utilisateurs["date_de_naissance"] .'" required>';
        $form .= '</div>';
        $form .= '<input type="hidden" name="requete" value="' . $prochaineRequete . '">';
        if ($message != "")
        {
            $form .= '<div class="alert alert-info"><span class="glyphicon glyphicon-ok">&nbsp</span>'. $message . '</div>';     
        }
        $form .= '<button type="submit" class="btn btn-custom-vert btn-lg">MODIFIER</button>'; 
        $form .= '<br/><br/>';
        $form .= '<a class="btn btn-custom-gris btn-lg" href="./index.php?requete=historique_html&id_utilisateur=1">VOIR VOS RÉSERVATIONS</a>';                  
        $form .= '<br>';
        $form .= '</form>';
        $form .= '</div><!--fin formulaire-->';
        $form .= '</div><!-- /.frm_general -->';        
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';

        echo $form;
    }

    // fonction qui retourne le formulaires "profil.html"
    public static function formulaire_nouveaupass_html($prochaineRequete,$message)
    {
       $form = '';

        $form .= '<div class="container">';
        $form .= '<div class="row">';
        $form .= '<div class="col-md-8 frm_general">';       
        $form .= '<div class="col-md-8 grostitres">';
        $form .= '<p>NOUVEAU MOT DE PASSE VOUS SERA ENVOYÉ PAR COURRIEL</p>';
        $form .= '</div>';
        $form .= '<div class="col-md-6 pwoublie"><!--formulaire login -->';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="GET">';

        if ($message == "")
        {
            $form .= '<div class="form-group">';
            $form .= '<label for="courriel">ADRESSE COURRIEL</label>';
            $form .= '<input type="email" class="form-control" id="courriel" name="courriel" placeholder="Votre courriel" required>';
            $form .= '</div>';  
        }

        $form .= '<input type="hidden" name="requete" value="req_messageOubliePass">';
        $form .= '<input type="hidden" name="requete" value="' . $prochaineRequete . '">';

        if ($message == "")
        {
            $form .= '<button type="submit" class="btn btn-custom-gris btn-lg">ENVOYER</button>';
            $form .= '<br>';
        }
        else
        {
            $form .= '<button type="submit" class="btn btn-custom-gris btn-lg">QUITTER</button>';
            $form .= '<br>';
            $form .= '<div class="alert alert-info"><span class="glyphicon glyphicon-ok">&nbsp</span>Votre nouveau mot de passe à été envoyé à votre courriel</div>';     
        }

        $form .= '</form>';
        $form .= '</div><!--formlogin col-md-6 pwoublie-->';
        $form .='</div><!-- /.frm_general -->';              
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';

        echo $form;

    } 
 }	
?>