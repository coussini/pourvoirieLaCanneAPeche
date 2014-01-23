<?php
// ICI on met tout ce qui va être insérer dans les quelettes

class VueReservations
{
    // function qui retourne les plages de dates réservées pour un produit
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
        }
        echo json_encode($form);
    }

    // function qui retourne le formulaire reserver.html
    public static function formulaire_reserver($produit)
    {
        $form = '';
        $form .= '<div class="container">';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="GET">';
        $form .= '<div class="row">';

        if ($_GET["erreur"] == "")
        {
            $form .= '<div class="col-lg-4">';
            $form .= '<h2>Réservation</h2>';
            $form .= '<h2>' . $produit["nom"] . '</h2>';
            $form .= '<img class="img-responsive" src="' . $produit["imageFacade"] . '" alt="image de façade">';
            $form .= '<h5>' . $produit["description"] .'</h5>';
            $form .= '<h4> Prix par semaine : ' . $produit["prix_par_semaine"] .'$</h4>';
            $form .= '</div> <!-- /.col-lg-4 -->';
            $form .= '<div class="col-lg-8">';
            $form .= '<h2>Semaine de réservation pour votre chalet</h2>';
            $form .= '<h4>Veuillez choisir la semaine de votre séjour</h4>';
            $form .= '<div class="semaineChoisi"></div>';
            $form .= '<h4 class="msg_choix">Vous avez choisi la semaine :</h4>';
            $form .= '<input type="hidden" name="requetePage" value="' . $_GET["requetePage"] . '">';
            $form .= '<input type="hidden" name="id_utilisateur" value="' . $_GET["id_utilisateur"] . '">';
            $form .= '<input type="hidden" name="id_produit" value="' . $_GET["id_produit"] . '">';
            // les champs numero_semaine, date_debut et date_fin ont été manipulé dans calendrierReservation.js(preparerLeCalendrier)
            // elle proviennent des champs id="semaine", id="startDate" et id="endDate"
            $form .= '<input type="hidden" id="numero_semaine" name="numero_semaine" value="">';
            $form .= '<input type="hidden" id="date_debut" name="date_debut" value="">';
            $form .= '<input type="hidden" id="date_fin" name="date_fin" value="">';
            $form .= '<input type="hidden" name="prix_par_semaine" value="' . $produit["prix_par_semaine"] . '">';
            $form .= '<h4><span id="semaine"></span> <span id="startDate"></span><span id="endDate"></strong></span></h4>';
            $form .= '<br/><br/>';
            $form .= '<button type="submit" class="btn btn-custom-vert btn-lg btn_reserver">RÉSERVER</button>';
            $form .= '</div> <!-- /.col-lg-8 -->';
        }
        else
        {
            $form .= '<div class="col-lg-12">';
            $form .= '<h1>Erreur sur le formulaire réserver</h1>';
            $form .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">&nbsp</span>' . $_GET["erreur"] . '</div>';            
            $form .= '</div> <!-- /.col-lg-12 -->';
        }

        $form .= '<input type="hidden" name="requete" value="' . $_GET["requete"] . '">';
        $form .= '</div> <!-- /.row -->';
        $form .= '</form>';
        $form .= '</div> <!-- /.container -->';

        echo $form;
    }


    // function qui retourne le formulaire confirmation.html
    public static function formulaire_confirmation($produit,$utilisateur,$dateDebut,$dateFin,$numero_semaine)
    {
        $form = '';
        $form .= '<div class="container">';

        if ($_GET["erreur"] == "")
        {
            $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
            $form .= '<div class="row">';
            $form .= '<div class="col-lg-4">';
            $form .= '<h2>Vos choix</h2>';
            $form .= '<h2>' . $produit["nom"] . '</h2>';
            $form .= '<img class="img-responsive" src="' . $produit["imageFacade"] . '" alt="image de façade">';
            $form .= '<h5>' . $produit["description"] .'</h5>';
            $form .= '<h4> Prix par semaine:' . $produit["prix_par_semaine"] .'$</h4>';
            $form .= '<h4>Vos choix de dates:</h4>';
            $form .= '<h4>DU ' . $dateDebut . ' AU ' . $dateFin . '</h4>';
            $form .= '</div> <!-- /.col-lg-4 -->';
            $form .= '<div class="col-lg-4">';
            $form .= '<h2>Vos coordonnées</h2>';
            $form .= '<p class="help-block">Veuillez vérifier vos coordonnées afin que nous puissions vous envoyez une confirmation de paiement</p>';
            $form .= '<label>NOM</label><br/>';
            $form .= '<p>' . $utilisateur["nom"] . '</p><br/>';
            $form .= '<label>PRENOM</label><br/>';
            $form .= '<p>' . $utilisateur["prenom"] . '</p><br/>';
            $form .= '<label>ADRESSE COURRIEL</label><br/>';
            $form .= '<p>' . $utilisateur["courriel"] . '</p><br/>';
            $form .= '<label>DATE DE NAISSANCE</label><br/>';
            $form .= '<p>' . $utilisateur["date_de_naissance"] . '</p><br/>';
            $form .= '</div> <!-- /.col-lg-4 -->';
            $form .= '<div class="col-lg-4">';
            $form .= '<h2>Carte de crédit</h2>';
            $form .= '<label>Carte de crédit</label><br/>';
            $form .= '<select name="nom_carte" size="1" >';
            $form .= '<option value="Mastercard">Mastercard</option>';
            $form .= '<option value="Visa">Visa</option>';
            $form .= '<option value="American Express">American Express</option>';
            $form .= '</select><br/><br/><!-- fin de la sélection de province -->';
            $form .= '<label>Numéro de votre carte</label>';
            $form .= '<input type="text" name="numero_carte" placeholder="numéro de carte" required/><br/>';
            $form .= '<label>Id au verso de votre carte</label>';
            $form .= '<input type="text" name="id_carte" placeholder="ID" required/><br/>';
            $form .= '<input type="hidden" name="requetePage" value="' . $_GET["requetePage"] . '">';
            $form .= '<input type="hidden" name="id_utilisateur" value="' . $_GET["id_utilisateur"] . '">';
            $form .= '<input type="hidden" name="id_produit" value="' . $_GET["id_produit"] . '">';
            $form .= '<input type="hidden" name="numero_semaine" value="' . $numero_semaine . '">';
            $form .= '<input type="hidden" name="date_debut" value="' . $dateDebut .'">';
            $form .= '<input type="hidden" name="date_fin" value="' . $dateFin .'">';
            $form .= '<input type="hidden" name="prix_a_la_reservation" value="' . $produit["prix_par_semaine"] . '">';
            $form .= '<br/><br/>';
            $form .= '<button type="submit" class="btn btn-custom-vert btn-lg">CONFIRMER</button><br/><br/>';
            $form .= '<a class="btn btn-custom-gris btn-lg" href="./index.php?requete=reserver_html&id_produit=' . $_GET["id_produit"] . '&id_utilisateur=' . $_GET["id_utilisateur"] . '">&laquo; ÉTAPE PRÉCÉDENTE</a>';                  
            $form .= '</div> <!-- /.col-lg-4 -->';
        }
        else
        {
            $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="GET">';
            $form .= '<div class="row">';
            $form .= '<div class="col-lg-12">';
            $form .= '<h1>Erreur sur le formulaire confirmation</h1>';
            $form .= '<div class="alert alert-da nger"><span class="glyphicon glyphicon-warning-sign">&nbsp</span>' . $_GET["erreur"] . '</div>';            
            $form .= '</div>';
        }

        $form .= '<input type="hidden" name="requete" value="' . $_GET["requete"] . '">';
        $form .= '</div> <!-- /.row -->';
        $form .= '</form>';
        $form .= '</div> <!-- /.container -->';

        echo $form;
    }

    // function qui retourne le formulaire lors d'une création d'une réservation
    public static function formulaire_creerUneReservation($produit,$utilisateur,$dateDebut,$dateFin,$numero_semaine,$nom_carte,$numero_carte,$id_carte,$prix_a_la_reservation)
    {
        $form = '';
        $form .= '<div class="container">';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="POST">';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-4">';
        $form .= '<h2>Vos choix</h2>';
        $form .= '<h2>' . $produit["nom"] . '</h2>';
        $form .= '<img class="img-responsive" src="' . $produit["imageFacade"] . '" alt="image de façade">';
        $form .= '<h5>' . $produit["description"] .'</h5>';
        $form .= '<h4> Prix par semaine:' . $produit["prix_par_semaine"] .'$</h4>';
        $form .= '<h4>Vos choix de dates:</h4>';
        $form .= '<h4>DU ' . $dateDebut . ' AU ' . $dateFin . '</h4>';
        $form .= '</div> <!-- /.col-lg-4 -->';
        $form .= '<div class="col-lg-4">';
        $form .= '<h2>Vos coordonnées</h2>';
        $form .= '<p class="help-block">Veuillez vérifier vos coordonnées afin que nous puissions vous envoyez une confirmation de paiement</p>';
        $form .= '<label>NOM</label><br/>';
        $form .= '<p>' . $utilisateur["nom"] . '</p><br/>';
        $form .= '<label>PRENOM</label><br/>';
        $form .= '<p>' . $utilisateur["prenom"] . '</p><br/>';
        $form .= '<label>ADRESSE COURRIEL</label><br/>';
        $form .= '<p>' . $utilisateur["courriel"] . '</p><br/>';
        $form .= '<label>DATE DE NAISSANCE</label><br/>';
        $form .= '<p>' . $utilisateur["date_de_naissance"] . '</p><br/>';
        $form .= '</div> <!-- /.col-lg-4 -->';
        $form .= '<div class="col-lg-4">';
        $form .= '<h2>Carte de crédit</h2>';
        $form .= '<label>Carte de crédit</label><br/>';
        $form .= '<select name="nom_carte" size="1">';
        if ($nom_carte == "Mastercard")
        {
            $form .= '<option value="Mastercard" selected>Mastercard</option>';
            $form .= '<option value="Visa">Visa</option>';
            $form .= '<option value="American Express">American Express</option>';
        }
        else if ($nom_carte == "Visa")
        {
            $form .= '<option value="Mastercard">Mastercard</option>';
            $form .= '<option value="Visa" selected>Visa</option>';
            $form .= '<option value="American Express">American Express</option>';
        }
        else
        {
            $form .= '<option value="Mastercard">Mastercard</option>';
            $form .= '<option value="Visa">Visa</option>';
            $form .= '<option value="American Express" selected>American Express</option>';
        }
        $form .= '</select><br/><br/>';
        $form .= '<label>Numéro de votre carte</label>';
        $form .= '<input type="text" name="numero_carte" placeholder="numéro de carte" value="' . $numero_carte . '" required/><br/>';
        $form .= '<label>Id au verso de votre carte</label>';
        $form .= '<input type="text" name="id_carte" placeholder="ID" value="' . $_GET["id_carte"] . '" required/><br/>';
        $form .= '<input type="hidden" name="requetePage" value="' . $_GET["requetePage"] . '">';
        $form .= '<input type="hidden" name="id_utilisateur" value="' . $_GET["id_utilisateur"] . '">';
        $form .= '<input type="hidden" name="id_produit" value="' . $_GET["id_produit"] . '">';
        $form .= '<input type="hidden" id="numero_semaine" name="numero_semaine" value="' . $numero_semaine . '">';
        $form .= '<input type="hidden" id="date_debut" name="date_debut" value="' . $dateDebut .'">';
        $form .= '<input type="hidden" id="date_fin" name="date_fin" value="' . $dateFin .'">';
        $form .= '<input type="hidden" id="prix_par_semaine" name="prix_a_la_reservation" value="' . $produit["prix_par_semaine"] . '">';
        $form .= '<br/>';

        if (empty($_GET["message_confirmation"]))
        {
            $form .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">&nbsp</span>' . $_GET["erreur"] . '</div>';            
            $form .= '<button type="submit" class="btn btn-custom-vert btn-lg">CONFIRMER</button><br/><br/>';
            $form .= '<button type="button" class="btn btn-custom-gris btn-lg">&laquo; ÉTAPE PRÉCÉDENTE</button>';
        }
        else
        {
            $form .= '<button type="button" class="btn btn-custom-gris btn-lg">&laquo; QUITTER</button>';
        }
        
        $form .= '<br/><br/>';
        $form .= '</div> <!-- /.col-lg-4 -->';
        $form .= '<input type="hidden" name="requete" value="' . $_GET["requete"] . '">';
        $form .= '</div> <!-- /.row -->';
        $form .= '</form>';
        
        if (!empty($_GET["message_confirmation"]))
        {
            $form .= '<div class="alert alert-info"><span class="glyphicon glyphicon-ok">&nbsp</span>' . $_GET["message_confirmation"] . '</div>';     
        }
        
        $form .= '</div> <!-- /.container -->';

        echo $form;
    }

    // function qui retourne le formulaire historique.html
    public static function formulaire_historique($reservations)
    {
        $form = '';
        $form .= '<div class="container">';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="GET">';
        $form .= '<h2>HISTORIQUE DE VOS RÉSERVATION</h2>';
        $form .= '<div class="row">';

        if ($_GET["erreur"] == "")
        {
            $form .= '<div class="col-lg-12">';
            $form .= '<h2>Détails sur vos réservations</h2>';

            for ($i = 0; $i < count($reservations); $i++) 
            {       
                $form .= '<div class="col-lg-12 grostitres"><p>' . $reservations[$i]["nom"] . ' du ' . $reservations[$i]["date_debut"] . ' au ' . $reservations[$i]["date_fin"] . '</p></div>';
                $form .= '<h4>Coût total de la réservation ' . $reservations[$i]["prix_a_la_reservation"] . '$</h4>';
                $form .= '<p>' . $reservations[$i]["description"] . '</p>';
                $form .= '<br/><br/>';
            }

            $form .= '</div><!--  fin  col-lg-12 -->';
        }
        else
        {
            $form .= '<div class="col-lg-12">';
            $form .= '<h1>Détails sur vos réservations</h1>';
            $form .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">&nbsp</span>' . $_GET["erreur"] . '</div>';            
            $form .= '</div>';
        }

        $form .= '<input type="hidden" name="requete" value="' . $_GET["requete"] . '">';
        $form .= '</div> <!-- /.row -->';
        $form .= '</form>';
        $form .= '</div> <!-- /.container -->';

        echo $form;
    }

    // function qui retourne le formulaire reservations.html
    public static function formulaire_reservations($reservations)
    {

        $form = '';
        $form .= '<div class="container">';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="GET">';
        $form .= '<div class="row">';

        if ($_GET["erreur"] == "")
        {
            $form .= '<div class="col-lg-12">';
            $form .= '<h2>Détail sur toutes les réservations</h2>';

            for ($i = 0; $i < count($reservations); $i++) 
            {       
                $form .= '<div class="col-lg-12 grostitres"><p>' . $reservations[$i]["nom"] . ' du ' . $reservations[$i]["date_debut"] . ' au ' . $reservations[$i]["date_fin"] . '</p></div>';
                $form .= '<h4>Courriel du client : ' . $reservations[$i]["courriel"] . '</h4>';
                $form .= '<h4>Coût total de la réservation ' . $reservations[$i]["prix_a_la_reservation"] . '$</h4>';
                $form .= '<p>' . $reservations[$i]["description"] . '</p>';
                $form .= '<br/><br/>';
            }

            $form .= '</div><!--  fin  col-lg-12 -->';
        }
        else
        {
            $form .= '<div class="col-lg-12">';
            $form .= '<h1>Détail sur toutes les réservations</h1>';
            $form .= '<div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign">&nbsp</span>' . $_GET["erreur"] . '</div>';            
            $form .= '</div>';
        }

        $form .= '<input type="hidden" name="requete" value="' . $_GET["requete"] . '">';
        $form .= '</div> <!-- /.row -->';
        $form .= '</form>';
        $form .= '</div> <!-- /.container -->';

        echo $form;
    }
}

?>