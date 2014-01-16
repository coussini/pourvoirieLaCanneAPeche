<?php

class VueStatiques
{
   // Afficher le formulaire de sélection du contenu statique   
    public static function formulaire_SelectionStatique($nomsStatique,$nomSelectionne)
    {
        $form = '<div class="container main">';
        $form .= '<div class="row">';
        $form .= '<h3>Modification du contenu</h3>';
        $form .= '<fieldset>';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] .'?formulaireModifierStatique" method="post">';
        $form .= '<div class="form-group">'; 
        $form .= '<select id="selectNomContenu" name="nom">';
        $form .= '<option>-- Sélectionner un contenu à modifier --</option>';
        foreach ($nomsStatique as $value)
        {
            $form .= '<option value="' . $value . '">' . $value . '</option>';
        }
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
        $form .= '<textarea id="contenu" class="form-control" name="contenuStatique" rows="15">';
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

    // function qui retourne les erreurs seulement
    public static function formulaire_erreur()
    {
        $form = '';
        $form .= '<form id="formulaire_erreur">';
        $form .= '<h2>formulaire_erreur</h2>';
        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        echo $form;
    }

}

?>