<?php

// ceci est une vue générale pour le contrôleuy
class VueMaitre
{
    // function qui retourne les erreurs seulement pour le contrôleur
    public static function formulaire_erreur()
    {
        $form = '';
        $form .= '<div class="container">';
        $form .= '<form id="formulaire_erreur">';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-12">';
        $form .= '<h1>Formulaire d\'erreur</h1>';
        $form .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">&nbsp</span>' . $_GET["erreur"] . '</div>';            
        $form .= '</div>';
        $form .= '</div> <!-- /.row -->';
        $form .= '</form>';
        $form .= '</div> <!-- /.container -->';
        echo $form;
    }

    // fonction qui retourne le menu principal
    // Gère les bouton actif et non actif
    public static function formulaire_menu_principal($accueil,$chalets,$informations,$contact)
    {
        $form = '';
        $form .= '<ul class="nav navbar-nav ">';
        $form .= '<li class="' . $accueil . '"><a href="./index.php"><img src="./images/accueil.png" alt="image accueil" class="img-responsive hidden-xs"><span class="titresMenu">ACCUEIL</span></a></li>';
        $form .= '<li class="' . $chalets . '"><a href="./index.php?requete=chalets_html"><img src="./images/chalets.png" alt="image chalets" class="img-responsive hidden-xs"><span class="titresMenu">NOS CHALETS</span></a></li>';
        $form .= '<li class="' . $informations . '"><a href="./index.php?requete=informations_html"><img src="./images/info.png" alt="image infos" class="img-responsive hidden-xs"><span class="titresMenu">INFORMATIONS</span></a></li>';
        $form .= '<li class="' . $contact . '"><a href="./index.php?requete=contact_html"><img src="./images/contact.png" alt="image contact" class="img-responsive hidden-xs"><span class="titresMenu">CONTACT</span></a></li>';
        $form .= '<li>';
        
        // l'utilisateur est connecté
        if(!empty($_SESSION["courriel"]))
        {
            $form .= '<a href="./index.php?requete=profil_html"><span class="titresLogin">PROFIL</span></a>';
            $form .= '<a href="./index.php?requete=deconnexion"><span class="titresLogin">DÉCONNEXION</span></a>';
        }
        else
        {
            $form .= '<a href="./index.php?requete=login_html"><span class="titresLogin">CONNEXION</span></a>';
            $form .= '<a href="./index.php?requete=inscription_html"><span class="titresLogin">S\'INSCRIRE</span></a>';
        }
        $form .= '</li>';
        $form .= '</ul>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</div>';

        echo $form;
    }
}	
?>