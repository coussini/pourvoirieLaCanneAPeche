<?php
// ICI on met tout ce qui va être insérer dans les quelettes
// Je vous reviens là dessus

// function qui retourne le formulaire "passer une commande" à panier.html dans le cas d'une erreur
class VueReservations
{
    public static function formulaire_extraireDesReservations($reservations)
    {
        $form = '';
        $form .= '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
        $form .= '<form id="formulaireExtraireDesReservations">';
        $form .= '<h2>Liste des reservation(s)</h2>';

        for ($i = 0; $i < count($reservations); $i++) 
        {
            $form .= '<p> id_reservation: ' . $reservations[$i]["id_reservation"] . '</p>';
            $form .= '<p> id_utilisateur: ' . $reservations[$i]["id_utilisateur"] . '</p>';
            $form .= '<p> id_produit: ' . $reservations[$i]["id_produit"] . '</p>';
            $form .= '<p> date_debut: ' . $reservations[$i]["date_debut"] . '</p>';
            $form .= '<p> date_fin: ' . $reservations[$i]["date_fin"] . '</p>';
            $form .= '<p> nombre_de_semaine: ' . $reservations[$i]["nombre_de_semaine"] . '</p>';
            $form .= '<p> nombre_de_semaine: ' . $reservations[$i]["nom_carte"] . '</p>';
            $form .= '<p> nombre_de_semaine: ' . $reservations[$i]["numero_carte"] . '</p>';
            $form .= '<p> nombre_de_semaine: ' . $reservations[$i]["id_carte"] . '</p>';
        }

        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        $form .= '</body>';
        $form .= '</html>';
        echo $form;
    }

    // function qui retourne le formulaire "passer une commande" à panier.html dans le cas d'une réussite
    public static function formulaire_extraireUneReservation($reservations)
    {
        $form = '';
        echo $form;
    }

    // function qui retourne le formulaire "visualiser une Commande" à panier.html
    public static function formulaire_creerUneReservation($resultat)
    {
        $form = '';
        $form .= '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
        $form .= '<form id="formulaireCreerUneReservation">';
        $form .= '<h2>Créer une réservation</h2>';
        $form .= '<p> resultat: ' . $resultat . '</p>';    
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