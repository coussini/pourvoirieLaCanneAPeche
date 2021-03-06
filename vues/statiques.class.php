<?php

class VueStatiques
{
   // Afficher le contenu statique   
    public static function afficherContenuStatique($contenuStatique)
    {
        $form = '<div class="container">';
        $form .= '<div class="row">';
        $form .= '<div class="col-sm-5 col-lg-5 grostitres"><p>' . $contenuStatique['nom'] . '</p></div>';
        $form .= '<div class="col-sm-1 col-lg-1"></div>';
        $form .= '<div class="col-sm-6 col-lg-6 para"><p>' . $contenuStatique['contenu'] . '</p></div><br/>';
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';
        echo $form;
    }

   // Afficher la banniere accueil   
    public static function afficherBanniereAccueil()
    {
        $form = '<div class="container banniere">';
        $form .= '<div class="row">';
        $form .= '<object width="960" height="250"><param name="movie" value="./images/banniere.swf"><embed src="./images/banniere.swf" width="960" height="250"></embed></object>';
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';
        echo $form;
    }

   // Afficher une video   
    public static function afficherVideo()
    {
        $form = '<div class="container">';
        $form .= '<div class="row">';
        $form .= '<iframe src="//player.vimeo.com/video/84901046" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
        $form .= '</div></div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';
        echo $form;
    }

   // Afficher l'API Google Map   
    public static function afficherMap()
    {
        $form = '<div class="container">';
        $form .= '<div class="row">';
        $form .= '<div id="map-canvas"></div>';
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';
        echo $form;
    }

   // Afficher le formulaire de sélection du contenu statique   
    public static function formulaire_SelectionStatique($nomsStatique)
    {
        $form = '<div class="container main">';
        $form .= '<div class="row">';
        $form .= '<h3>Modification du contenu</h3>';
        $form .= '<fieldset>';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] .'?requete=elements_statique_html" method="post">';
        $form .= '<div class="form-group">'; 
        $form .= '<select id="selectNomContenu" name="nom">';
        $form .= '<option>-- Sélectionner un contenu à modifier --</option>';
        foreach ($nomsStatique as $value)
        {
            $form .= '<option value="' . $value . '">' . $value . '</option>';
        };
        //$form .= '<option value="nouveauContenu">-- Créer un nouveau contenu --</option>';
        $form .= '</select>';
        $form .= '</div>';
        $form .= '</form>';
        $form .= '</fieldset>';
    //    $form .= '</div><!-- /.row -->';
    //    $form .= '</div> <!-- /.container -->';
        echo $form;
    }

    // Afficher le formulaire de modification du contenu statique   
    public static function formulaire_ModifierStatique($nomsStatique,$contenuStatique)
    {
     //   $form = '<div class="container main">';
     //   $form .= '<div class="row">';
        $form = '<fieldset>';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] .'?requete=modifierContenuStatique" method="post">';
        $form .= '<div class="form-group">';
        $form .= '<label for="contenu" class="control-label">Modifications de: ' . $nomsStatique . '</label>';
        $form .= '<textarea id="contenu" class="form-control " name="contenu" rows="20" cols="100">';
        $form .= $contenuStatique['contenu'];
        $form .= '</textarea></div>';
        $form .= '<input type="hidden" name="nom" value="' . $nomsStatique . '">';
        $form .= '<button id="" class="btn btn-custom-gris btn-lg" type="submit">Enregister les modifications</button><br/><br/>';
        $form .= '</div>';
        $form .= '</form>';
        $form .= '</fieldset>';
        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';
        echo $form;
    }

    // Afficher le formulaire de modification du contenu statique   
    public static function formulaire_formulaireCreerStatique()
    {
     //   $form = '<div class="container main">';
     //   $form .= '<div class="row">';
        $form = '<fieldset>';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] .'?requete=creerContenuStatique" method="post">';
        $form .= '<div class="form-group">';
        $form .= '<label for="contenu" class="control-label">Nom du contenu: </label>';
        $form .= '<input type="text" class="form-control" name="nom">';
        $form .= '</div>';
        $form .= '<div class="form-group">';
        $form .= '<label for="contenu" class="control-label">Texte du contenu: </label>';
        $form .= '<textarea id="contenu" class="form-control" name="contenu" rows="20" cols="100">';
        $form .= '</textarea></div>';
        $form .= '<button id="" class="btn btn-custom-gris btn-lg" type="submit">Enregister le contenu</button><br/><br/>';
        $form .= '</div>';
        $form .= '</form>';
        $form .= '</fieldset>';
        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';
        echo $form;
    }
}
?>