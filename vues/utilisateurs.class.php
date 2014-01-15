<?php
// ICI on met tout ce qui va être insérer dans les squelettes
// Je vous reviens là dessus


class VueUtilisateurs
{
	//----------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------
	
	// function qui retourne le formulaire "login"
    public static function formulaire_validLogin()
    {
	   $form = '';

        $form .= '<div class="container">';
        $form .= '<div class="row">';
        $form .= '<div class="col-md-8 frm_general">';       
        $form .= '<div class="col-md-8 grostitres">';
        $form .= '<p>Lorem ipsum dolor sit amet, has ea liber euismod, eu feugiat consectetuer.</p>';
        $form .= '</div>';
        $form .= '<div class="formlogin col-md-5"><!--formulaire login -->';
        $form .= '<form role="form">';
        $form .= '<div class="form-group">';
        $form .= '<label for="exampleInputEmail1">ADRESSE COURRIEL</label>';
        $form .= '<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">';
        $form .= '</div>';
        $form .= '<div class="form-group">';
        $form .= '<label for="exampleInputPassword1">MOT DE PASSE</label>';
        $form .= '<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">';
        $form .='</div>';
        $form .= '<a href="nouveaupass.html">MOT DE PASSE OUBLIÉ?</a>';                            
        $form .='<button type="button" class="btn btn-custom-vert btn-lg" onclick="traiteSiAdmin("connectionok.html")">CONNECTER</button>';                              
        $form .='<br>';
        $form .='</form>';
        $form .='</div><!--fin formulaire login -->';
        $form .='<div class="formlogin2 col-md-6">';
        $form .='<p>NOUVEL UTILISATEUR?</p>';                   
        $form .= '<button type="button" class="btn btn-custom-gris btn-lg" onclick="traiteConnexion("inscription.html")">SINSCRIRE</button>';
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
        $form .= '<form role="form">';
        $form .= '<div class="form-group">';
        $form .= '<label for="exampleInputEmail1">ADRESSE COURRIEL</label>';
        $form .= '<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">';
        $form .= '</div>';                
        $form .= '<button type="button" class="btn btn-custom-gris btn-lg" onclick="traiteConnexion("../index.html")">ENVOYER</button>';
        $form .= '<br>';
        $form .= '</form>';
        $form .= '</div><!--formlogin col-md-6 pwoublie-->';
        $form .='</div><!-- /.frm_general -->';              
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';

        echo $form;

      } 
	//----------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------
	
	// function qui retourne le formulaires "info utilisateur"
    public static function formulaire_extraireUtilisateur($utilisateurs)
    {
         $form = '';
     
            $form .= '<div class="container">';
            $form .= '<div class="row">';
            $form .= '<div class="col-md-8 frm_general">';
            $form .= '<div class="col-md-8 grostitres">';
            $form .= '<p>BIENVENU UTILISATEUR</p>';
            $form .= '</div>';
            $form .= '<div class="formlogin col-md-10"><!--formulaire login -->';
            $form .= '<form role="form">';
            $form .= '<div class="form-group">';
            $form .= '<label for="nom">NOM</label>';
            $form .= '<input type="text" class="form-control" id="nom" '. $utilisateurs["nom"] .'>';
            $form .= '</div>';
            $form .= '<div class="form-group">' ;
            $form .= '<label for="prenom">PRÉNOM</label>';
            $form .= '<input type="text" class="form-control" id="prenom" '. $utilisateurs["prenom"] .'>';
            $form .= '</div>';
            $form .= '<div class="form-group">';
            $form .= '<label for="courriel">ADRESSE COURRIEL</label>';
            $form .= '<input type="email" class="form-control" id="courriel" '. $utilisateurs["courriel"] .'>';
            $form .= '</div>';
            $form .= '<div class="form-group">';
            $form .= '<label for="mot_de_passe">MOT DE PASSE (6 caractères minimum)</label>';
            $form .= '<input type="password" class="form-control" id="mot_de_passe" '.$utilisateurs["mot_de_passe"] .'>';
            $form .= '</div>';
            $form .= '<div class="form-group">';
            $form .= '<label for="mot_de_passse2">CONFIRMER MOT DE PASSE</label>';
            $form .= '<input type="password" class="form-control" id="mot_de_passe2" '.$utilisateurs["mot_de_passe"] .'>';
            $form .= '</div>';
            $form .= '<div class="form-group">';
            $form .= '<label for="date_de_naissance">DATE DE NAISSANCE (aaaa-mm-jj)</label>';
            $form .= '<input type="text" class="form-control" id="date_de_naissance" '.$utilisateurs["date_de_naissance"] .'>';
            $form .= '</div>';
            $form .= '<button type="button" class="btn btn-custom-vert btn-lg" onclick="traiteConnexion("confirmation.html")">MODIFIER</button>';
            $form .= '<button type="button" class="btn btn-custom-vert btn-lg" onclick="traiteConnexion("confirmation.html")">RÉSERVER</button>';   
            $form .= '<br>';
            $form .= '</form>';
            $form .= '</div><!--fin formulaire login -->';
            $form .= '</div><!-- /.frm_general -->';        
            $form .= '</div><!-- /.row -->';
            $form .= '</div> <!-- /.container -->';

            echo $form;
    }
	
	//----------------------------------------------------------------------------------------------------------------------
	//----------------------------------------------------------------------------------------------------------------------
	// function qui retourne le formulaires "info MIS A JOUR utilisateur" inscription.html
	public static function formulaire_ajoutUtilisateur()
	 {
		$form = '';
     
			$form .= '<div class="container">';
			$form .= '<div class="row">';
			$form .= '<div class="col-md-8 frm_general">';
            $form .= '<div class="col-md-8 grostitres">';
            $form .= '<p>BONJOUR, INSCRIVEZ VOUS POUR RESERVER !</p>';
            $form .= '</div>';
			$form .= '<div class="formlogin col-md-10"><!--formulaire login -->';
			$form .= '<form role="form">';
			$form .= '<div class="form-group">';
			$form .= '<label for="nom">NOM</label>';
			$form .= '<input type="text" class="form-control" id="nom" placeholder="votre nom" " . $_GET["nom"] .">';
			$form .= '</div>';
			$form .= '<div class="form-group">' ;
			$form .= '<label for="prenom">PRÉNOM</label>';
			$form .= '<input type="text" class="form-control" id="prenom" placeholder="votre prénom" $_GET["prenom"]>';
			$form .= '</div>';
			$form .= '<div class="form-group">';
			$form .= '<label for="courriel">ADRESSE COURRIEL</label>';
			$form .= '<input type="email" class="form-control" id="courriel" placeholder="nom@domain.com" $_GET["courriel"]>';
			$form .= '</div>';
			$form .= '<div class="form-group">';
			$form .= '<label for="mot_de_passe">MOT DE PASSE (6 caractères minimum)</label>';
			$form .= '<input type="password" class="form-control" id="mot_de_passe" placeholder="mot de passe" $_GET["mot_de_passe"]>';
			$form .= '</div>';
			$form .= '<div class="form-group">';
			$form .= '<label for="mot_de_passse2">CONFIRMER MOT DE PASSE</label>';
			$form .= '<input type="password" class="form-control" id="mot_de_passe2" placeholder="mot de passe" $_GET["mot_de_passe"]>';
			$form .= '</div>';
			$form .= '<div class="form-group">';
			$form .= '<label for="date_de_naissance">DATE DE NAISSANCE (aaaa-mm-jj)</label>';
			$form .= '<input type="text" class="form-control" id="date_de_naissance" placeholder="1956-10-30" $_GET["date_de_naissance"]>';
			$form .= '</div>';
			$form .= '<button type="button" class="btn btn-custom-vert btn-lg" onclick="traiteConnexion("inscriptionconfirmation.html")"> SINSCRIRE</button>';	
			$form .= '<br>';
			$form .= '</form>';
			$form .= '</div><!--fin formulaire login -->';
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
        $form = '';
     
            $form .= '<div class="container">';
            $form .= '<div class="row">';
            $form .= '<div class="col-md-8 frm_general">';
            $form .= '<div class="col-md-8 grostitres">';
            $form .= '<p>BIENVENU</p>';
            $form .= '</div>';
            $form .= '<div class="formlogin col-md-10"><!--formulaire login -->';
            $form .= '<form role="form">';
            $form .= '<div class="form-group">';
            $form .= '<label for="nom">NOM</label>';
            $form .= '<input type="text" class="form-control" id="nom" placeholder="votre nom">';
            $form .= '</div>';
            $form .= '<div class="form-group">' ;
            $form .= '<label for="prenom">PRÉNOM</label>';
            $form .= '<input type="text" class="form-control" id="prenom" placeholder="votre prénom">';
            $form .= '</div>';
            $form .= '<div class="form-group">';
            $form .= '<label for="courriel">ADRESSE COURRIEL</label>';
            $form .= '<input type="email" class="form-control" id="courriel" placeholder="nom@domain.com">';
            $form .= '</div>';
            $form .= '<div class="form-group">';
            $form .= '<label for="mot_de_passe">MOT DE PASSE (6 caractères minimum)</label>';
            $form .= '<input type="password" class="form-control" id="mot_de_passe" placeholder="mot de passe">';
            $form .= '</div>';
            $form .= '<div class="form-group">';
            $form .= '<label for="mot_de_passse2">CONFIRMER MOT DE PASSE</label>';
            $form .= '<input type="password" class="form-control" id="mot_de_passe2" placeholder="mot de passe">';
            $form .= '</div>';
            $form .= '<div class="form-group">';
            $form .= '<label for="date_de_naissance">DATE DE NAISSANCE (aaaa-mm-jj)</label>';
            $form .= '<input type="text" class="form-control" id="date_de_naissance" placeholder="1956-10-30">';
            $form .= '</div>';
            $form .= '<button type="button" class="btn btn-custom-vert btn-lg" onclick="traiteConnexion("confirmation.html")">MODIFIER</button>';
            $form .= '<button type="button" class="btn btn-custom-vert btn-lg" onclick="traiteConnexion("confirmation.html")">RÉSERVER</button>';   
            $form .= '<br>';
            $form .= '</form>';
            $form .= '</div><!--fin formulaire login -->';
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