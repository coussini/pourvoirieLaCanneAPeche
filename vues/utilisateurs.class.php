<?php
class VueUtilisateurs
{
	//----------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------
	
	// function qui retourne le formulaire "login"
    public static function formulaire_loginUtilisateur()
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
		$form .= '<label for="exampleInputEmail1">ADRESSE COURRIEL</label>';
		$form .= '<input type="email" class="form-control" name="courriel" id="courriel" placeholder="nom@domain.com" required>';
		$form .= '</div>';
		$form .= '<div class="form-group">';
		$form .= '<label for="exampleInputPassword1">MOT DE PASSE</label>';
		$form .= '<input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" placeholder="*******" required>';
		$form .='</div>';
		$form .= '<a href="./index.php?requete=req_oubliePass">MOT DE PASSE OUBLIÉ?</a>'; 
        $form .= '<input type="hidden" name="requete" value="req_valideLogin">';
		$form .='<button type="submit" class="btn btn-custom-vert btn-lg">CONNECTER</button>';                              
		$form .='<br>';
		$form .='</form>';

		$form .='</div><!--fin formulaire login -->';
		$form .='<div class="formlogin2 col-md-6">';
		$form .='<p>NOUVEL UTILISATEUR?</p>';        
		$form .= '<a class="btn btn-custom-gris btn-lg" href="./index.php?requete=req_ajoutUtilisateur">S\'INSCRIRE</a>'; 		           
		$form .= '<div class="telephone">';
		$form .= ' <p>869.458.1273</p>';
		$form .= '</div>';
		$form .= '</div><!--formlogin col-md-6-->';
		$form .='</div><!-- /.frm_general -->';              
		$form .= '</div><!-- /.row -->';
		$form .= '</div> <!-- /.container -->';

		echo $form;

      } 
	//----------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------
	
	// function qui retourne le formulaire "login"
    public static function formulaire_validLogin($utilisateurs)
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
		$form .= '<a href="./index.php?requete=req_oubliePass">MOT DE PASSE OUBLIÉ?</a>'; 
        if ($utilisateurs["mot_de_passe"] != $_POST['mot_de_passe'])
        {
        	$form .= '<input type="hidden" name="requete" value="req_valideLogin">';
    	}
    	else
    	{
        	$form .= '<input type="hidden" name="requete" value="">';
    	}
		$form .='<button type="submit" class="btn btn-custom-vert btn-lg">CONNECTER</button>';                              
        $form .= '<br/><br/>';
        
        if ($utilisateurs["mot_de_passe"] != $_POST['mot_de_passe'])
        {
	        $form .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">&nbsp</span>Erreur de mot de passe</div>';            
        }

		$form .='</form>';

		$form .='</div><!--fin formulaire login -->';
		$form .='<div class="formlogin2 col-md-6">';
		$form .='<p>NOUVEL UTILISATEUR?</p>';     

		$form .= '<a href="./index.php?requete=req_ajoutUtilisateur">S\'INSCRIRE</a>'; 
		//$form .= '<button type="button" class="btn btn-custom-gris btn-lg" onclick="traiteConnexion("inscription.html")">SINSCRIRE</button>';

		$form .= '<div class="telephone">';
		$form .= ' <p>869.458.1273</p>';
		$form .= '</div>';
		$form .= '</div><!--formlogin col-md-6-->';
		$form .='</div><!-- /.frm_general -->';              
		$form .= '</div><!-- /.row -->';
		$form .= '</div> <!-- /.container -->';

		echo $form;

      } 

     //---------------------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------------------
    
     // function qui retourne le formulaire "de mot de passe oublié"
    public static function formulaire_oubliePass()
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
        $form .= '<div class="form-group">';
        $form .= '<label for="courriel">ADRESSE COURRIEL</label>';
        $form .= '<input type="email" class="form-control" id="courriel" name="courriel" placeholder="Votre courriel" required>';
        $form .= '</div>';  
        $form .= '<input type="hidden" name="requete" value="req_messageOubliePass">';
        $form .= '<button type="submit" class="btn btn-custom-gris btn-lg">ENVOYER</button>';
        $form .= '<br>';
        $form .= '</form>';
        
        $form .= '</div><!--formlogin col-md-6 pwoublie-->';
        $form .='</div><!-- /.frm_general -->';              
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';

        echo $form;

      } 
    
     // function qui retourne le formulaire "de mot de passe oublié"
    public static function formulaire_messageOubliePass()
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
        $form .= '<div class="form-group">';
        $form .= '<label for="courriel">ADRESSE COURRIEL</label>';
        $form .= '<input type="email" class="form-control" id="courriel" name="courriel" value="'. $_GET['courriel'] .'" placeholder="Votre courriel">';
        $form .= '</div>';  
        $form .= '<input type="hidden" name="requete" value="req_messageOubliePass">';
        $form .= '<button type="button" class="btn btn-custom-gris btn-lg" onclick="traiteConnexion("../index.html")">ENVOYER</button>';
        $form .= '<br/><br/>';
        $form .= '<div class="alert alert-info"><span class="glyphicon glyphicon-ok">&nbsp</span>Votre nouveau mot de passe à été envoyé à votre courriel</div>';     
        $form .= '</form>';
        
        $form .= '</div><!--formlogin col-md-6 pwoublie-->';
        $form .='</div><!-- /.frm_general -->';              
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';

        echo $form;

      } 
	//----------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------
	
	// function qui retourne le formulaires "profil utilisateur"
    public static function formulaire_extraireUtilisateur($utilisateurs)
    {
        $form = '';
    
		$form .= '<div class="container">';
		$form .= '<div class="row">';
		$form .= '<div class="col-md-8 frm_general">';
		$form .= '<div class="col-md-8 grostitres">';
		$form .= '<p>BIENVENU '. $utilisateurs["prenom"] .'</p>';
		$form .= '</div>';
		$form .= '<div class="formlogin col-md-10"><!--formulaire-->';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="GET">';
		$form .= '<div class="form-group">';
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
	
	//----------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------
	
	// function qui retourne le formulaires "nouvelle inscription" inscription.html
	public static function formulaire_ajoutUtilisateur()
	 {
		$form = '';
  
		$form .= '<div class="container">';
		$form .= '<div class="row">';
		$form .= '<div class="col-md-8 frm_general">';
		$form .= '<div class="col-md-8 grostitres">';
		$form .= '<p>BONJOUR, INSCRIVEZ VOUS POUR RESERVER NOS CHALETS !</p>';
		$form .= '</div>';
		$form .= '<div class="formlogin col-md-10"><!--formulaire -->';

        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="GET">';
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
		$form .= '<button type="submit" class="btn btn-custom-vert btn-lg">S\'INSCRIRE</button>';	
		$form .= '<br>';
		$form .= '</form>';

		$form .= '</div><!--fin formulaire-->';
		$form .= '</div><!-- /.frm_general -->';		
		$form .= '</div><!-- /.row -->';
		$form .= '</div> <!-- /.container -->';

		echo $form;

	}


    //----------------------------------------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------------------------------------
	
    // function qui retourne le formulaires "info MIS A JOUR utilisateur" inscription.html
    public static function formulaire_majUtilisateur()
     {
     	var_dump("ici");
        $form = '';
     
		$form .= '<div class="container">';
		$form .= '<div class="row">';
		$form .= '<div class="col-md-8 frm_general">';
		$form .= '<div class="col-md-8 grostitres">';
		$form .= '<p>BIENVENU</p>';
		$form .= '</div>';
		$form .= '<div class="formlogin col-md-10"><!--formulaire-->';
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
		$form .= '<input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" placeholder="mot de passe" required>';
		$form .= '</div>';
		$form .= '<div class="form-group">';
		$form .= '<label for="mot_de_passse2">CONFIRMER MOT DE PASSE</label>';
		$form .= '<input type="password" class="form-control" name="mot_de_passe2" id="mot_de_passe2" placeholder="mot de passe" required>';
		$form .= '</div>';
		$form .= '<div class="form-group">';
		$form .= '<label for="date_de_naissance">DATE DE NAISSANCE (aaaa-mm-jj)</label>';
		$form .= '<input type="text" class="form-control" name="date_de_naissance" id="date_de_naissance" placeholder="1956-10-30" required>';
		$form .= '</div>';
		$form .= '<button type="submit" class="btn btn-custom-vert btn-lg">MODIFIER</button>';	
		$form .= '<br>';
		$form .= '</form>';
		$form .= '</div><!--fin formulaire-->';
		$form .= '</div><!-- /.frm_general -->';        
		$form .= '</div><!-- /.row -->';
		$form .= '</div> <!-- /.container -->';

		echo $form;

    }
	//----------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------
	
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