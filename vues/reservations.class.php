<?php
// ICI on met tout ce qui va être insérer dans les quelettes

class VueReservations
{
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
        $form .= '</body>';
        $form .= '</html>';
        echo $form;
    }

    // function qui retourne le formulaire reserver.html
    public static function formulaire_chercher_dates_reservees($reservations)
    {
        $form = '';
        for ($i = 0; $i < count($reservations); $i++) 
        {
            if ($i > 0)
            {
                $form .= ',';
            }
            $date = explode(' ', $reservations[$i]["date_debut"]);
            $form .= $date[0];
            $form .= ',';
            $form .= $date[0];
        }
        /*
        $form .= '<form id="formulaire_chercher_dates_reservees">';
        $form .= '<h2>formulaire_chercher_dates_reservees</h2>';

        for ($i = 0; $i < count($reservations); $i++) 
        {
            $form .= '<h2>les plages de date réservées</h2>';
            $form .= '<p> date_debut: ' . $reservations[$i]["date_debut"] . '</p>';
        }

        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        */
        echo json_encode($form);
    }

    // function qui retourne le formulaire reserver.html
    public static function formulaire_reserver($produit)
    {
        $form = '';
        for ($i = 0; $i < count($produit); $i++) 
        {
            $form .= '<div class="container main">';
            $form .= '<div class="row">';
            $form .= '<h1>Réservation de chalet</h1>';
            $form .= '<p>Veuillez choisir vos dates.</p>';
            $form .= '<div class="col-lg-4">';
            $form .= '<h2>' . $produit[$i]["nom"] . '</h2>';
            $form .= '<img class="img-responsive" src="' . $produit[$i]["imageFacade"] . '" alt="image de façade">';
            $form .= '<p>' . $produit[$i]["description"] .'</p>';
            $form .= '</div>';
            $form .= '<div class="col-lg-8">';
            $form .= '<h2>Semaine de réservation pour votre chalet</h2>';
            $form .= '<h4>Veuillez choisir la semaine de votre séjour</h4>';
            $form .= '<div class="semaineChoisi"></div>';
            $form .= '<h4>Vous avez choisi la semaine :</h4>';
            $form .= '<h4><span id="semaine"></span> <span id="startDate"></span><span id="endDate"></strong></span></h4>';
            $form .= '<br/><br/>';
            $form .= '<button type="button" class="btn btn-custom-vert btn-lg" onclick="traiteConnexion("confirmation.html")">RÉSERVER</button>';
            $form .= '</div><!--  fin  col-lg-12 -->';
            $form .= '</div><!-- /.row -->';
            $form .= '</div> <!-- /.container -->';
        }
        echo $form;

        /*
        $form = '';
        $form .= '<form id="formulaire_reserver">';
        $form .= '<h2>formulaire_reserver</h2>';

        for ($i = 0; $i < count($produit); $i++) 
        {
            $form .= '<p> id_produit: ' . $produit[$i]["id_produit"] . '</p>';
            $form .= '<p> nom: ' . $produit[$i]["nom"] . '</p>';
            $form .= '<p> imageFacade: ' . $produit[$i]["imageFacade"] . '</p>';
            $form .= '<p> description: ' . $produit[$i]["description"] . '</p>';
        }

        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        */
    }
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
            $form .= '<p> numero_semaine: ' . $reservations[$i]["numero_semaine"] . '</p>';
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