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
    public static function formulaire_menu_principal($indicateurAccueil,$indicateurChalets,$indicateurInformations,$indicateurContact)
    {
        $form = '';
        $form .= '<ul class="nav navbar-nav ">';
        $form .= '<li class="' . $indicateurAccueil . '"><a href="./index.php"><img src="./images/accueil.png" alt="image accueil" class="img-responsive hidden-xs"><span class="titresMenu">ACCUEIL</span></a></li>';
        $form .= '<li class="' . $indicateurChalets . '"><a href="./index.php?requete=chalets_html"><img src="./images/chalets.png" alt="image chalets" class="img-responsive hidden-xs"><span class="titresMenu">NOS CHALETS</span></a></li>';
        $form .= '<li class="' . $indicateurInformations . '"><a href="./index.php?requete=informations_html"><img src="./images/info.png" alt="image infos" class="img-responsive hidden-xs"><span class="titresMenu">INFORMATIONS</span></a></li>';
        $form .= '<li class="' . $indicateurContact . '"><a href="./index.php?requete=contact_html"><img src="./images/contact.png" alt="image contact" class="img-responsive hidden-xs"><span class="titresMenu">CONTACT</span></a></li>';
        $form .= '<li>';
        $form .= '<a href="./index.php?requete=req_extraireUtilisateur&courriel=coussini@gmail.com"><span class="titresLogin">PROFIL</span></a>';
        $form .= '<a href="./index.php?requete=req_loginUtilisateur"><span class="titresLogin">CONNEXION</span></a>';
        $form .= '<a href="./index.php"><span class="titresLogin">DÉCONNEXION</span></a>';
        $form .= '<a href="./index.php?requete=req_ajoutUtilisateur"><span class="titresLogin">S\'INSCRIRE</span></a>';
        $form .= '</li>';
        $form .= '</ul>';

        echo $form;
    }
}	
?>