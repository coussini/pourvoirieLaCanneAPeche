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
            $form .= ',';
            $form .= $date[0];
        }
        echo json_encode($form);
        
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
        echo $form;
        */
    }

    // function qui retourne le formulaire reserver.html
    public static function formulaire_reserver($produit)
    {


        $form = '';
        $form .= '<div class="container main">';
        $form .= '<div class="row">';
        $form .= '<h1>formulaire_reserver</h1>';
        $form .= '<h1>Réservation de chalet</h1>';
        $form .= '<p>Veuillez choisir vos dates.</p>';
        $form .= '<div class="col-lg-4">';
        $form .= '<h2>La Bohème</h2>';
        $form .= '<img class="img-responsive" src="./images/chaletLaBoheme.jpg" alt="Chalet la bohème">';
        $form .= '<p>Le chalet la bohème est dans un cadre enchanteur. On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. Lavantage du Lorem Ipsum sur un texte générique comme Du texte. Du texte. Du texte. est quil possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard.</p>';
        $form .= '</div>';
        $form .= '<div class="col-lg-8">';
        $form .= '<h2>Semaine de réservation pour votre chalet</h2>';
        $form .= '<h4>Veuillez choisir la semaine de votre séjour</h4>';
        $form .= '<div class="semaineChoisi"></div>';
        $form .= '<h4>Vous avez choisi la semaine :</h4>';
        $form .= '<h4><span id="semaine"></span> <span id="startDate"></span><span id="endDate"></strong></span></h4>';
        $form .= '<br/><br/>';
        $form .= '<button type="button" class="btn btn-custom-vert btn-lg" onclick="traiteConnexion("confirmation.html")">RÉSERVER</button>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</div>';
        echo $form;

        /*

        $form = '';
        $form .= '<div class="container main">';
        $form .= '<div class="row">';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '?requete=confirmation.html">';
        $form .= '<div class="col-lg-4">';
        $form .= '<h1>Réservation de chalet</h1>';
        $form .= '<p>Veuillez choisir vos dates.</p>';
        $form .= '<h2>' . $produit[0]["nom"] . '</h2>';
        $form .= '<img class="img-responsive" src="' . $produit[0]["imageFacade"] . '" alt="image de façade">';
        $form .= '<p>' . $produit[0]["description"] .'</p>';
        $form .= '</div>';
        $form .= '<div class="col-lg-8">';
        $form .= '<h2>Semaine de réservation pour votre chalet</h2>';
        $form .= '<h4>Veuillez choisir la semaine de votre séjour</h4>';
        $form .= '<div class="semaineChoisi"></div>';
        $form .= '<h4>Vous avez choisi la semaine :</h4>';
        $form .= '<h4><span id="semaine"></span> <span id="startDate"></span><span id="endDate"></strong></span></h4>';

        /*************************************************/
        /* champs que l'on passe en paramètres et hidden */
        /*************************************************/
        /*
        $form .= '<input type="hidden" name="id_produit" value="' . $_GET["id_produit"] . '>';
        $form .= '<input type="hidden" name="id_utilisateur" value="' . $_GET["id_utilisateur"] . '>';

        $form .= '<br/><br/>';
        $form .= '<input class="btn btn-custom-vert btn-lg" type="submit" value="RÉSERVER">';
        $form .= '</div><!--  fin  col-lg-12 -->';
        $form .= '</form>';
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';
        echo $form;
        */

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
        echo $form;
        */
    }


    // function qui retourne le formulaire confirmation.html
    public static function formulaire_confirmation($produit,$utilisateur,$dateDebut,$dateFin)
    {

        $form = '';
	
		$form .= '<div class="container main">';
		$form .= '<div class="row">';
		$form .= '<div class="col-lg-4">';
		$form .= '<h2>Détail de vos choix</h2>';
        $form .= '<h4>' . $produit[0]["nom"] . '</h4>';
        $form .= '<img class="img-responsive" src="' . $produit[0]["imageFacade"] . '" alt="image de façade">';
        $form .= '<p>' . $produit[0]["description"] .'</p>';
		$form .= '<h4>VOS CHOIX DE DATES</h2>';
		$form .= '<form role="form">';
		$form .= '<div class="form-group">';
		$form .= '<label for="dateDebut">DATE DE DÉBUT</label><br/>';
		$form .= '<p>' . $dateDebut . '</p>';
		$form .= '</div>';
		$form .= '<div class="form-group">';
		$form .= '<label for="dateFin">DATE DE FIN</label><br/>';
		$form .= '<p>' . $dateFin . '</p>';
		$form .= '</div>';
		$form .= '</form>';
		$form .= '</div><!--  fin -->';
		$form .= '<div class="col-lg-4">';
		$form .= '<h2>Vos coordonnées</h2>';
		$form .= '<p class="help-block">Veuillez vérifier vos coordonnées afin que nous puissions vous envoyez une confirmation de paiement</p>';
		$form .= '<form role="form">';
		$form .= '<div class="form-group">';
		$form .= '<label for="exampleInputEmail1">NOM</label>';
		$form .= '<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Lepage">';
		$form .= '</div>';
		$form .= '<div class="form-group">';
		$form .= '<label for="exampleInputPassword1">PRÉNOM</label>';
		$form .= '<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Marie">';
		$form .= '</div>';
		$form .= '<div class="form-group">';
		$form .= '<label for="exampleInputPassword1">ADRESSE COURRIEL</label>';
		$form .= '<input type="password" class="form-control" id="exampleInputPassword1" placeholder="mariel@gmail.com">';
		$form .= '</div>';
		$form .= '<div class="form-group">';
		$form .= '<label for="exampleInputPassword1">DATE DE NAISSANCE (jj-mm-aaaa)</label>';
		$form .= '<input type="password" class="form-control" id="exampleInputPassword1" placeholder="10-30-56">';
		$form .= '</div>';
		$form .= '</form>';
		$form .= '</div>';
		$form .= '<div class="col-lg-4">';
		$form .= '<h2>Carte de crédit</h2>';
		$form .= '<form role="form">';
		$form .= '<div class="libelle">';
		$form .= '<label for="selCarte">Carte de crédit</label>';
		$form .= '</div>';
		$form .= '<select name="selCarte" size="1" >';
		$form .= '<option value="MC">Mastercard</option>';
		$form .= '<option value="VS">Visa</option>';
		$form .= '<option value="AX">American Express</option>';
		$form .= '</select><br/><br/><!-- fin de la sélection de province -->';
		$form .= '<div class="libelle">';
		$form .= '<label for="selCarte">Numéro de votre carte</label>';
		$form .= '</div>';
		$form .= '<input type="text" name="txtNumCarte" pattern="^[a-zA-Z\-\,\s\u00C0-\u00FF]{1,}$" placeholder="numéro de carte" required/><br/>';
		$form .= '<div class="libelle">';
		$form .= '<label for="selIdCarte">Id au verso de votre carte</label>';
		$form .= '</div>';
		$form .= '<input type="text" name="txtIdCarte" pattern="^[a-zA-Z\-\,\s\u00C0-\u00FF]{1,}$" placeholder="ID" required/><br/>';
		$form .= '</form>';
		$form .= '<br/><br/>';
		$form .= '<button type="button" class="btn btn-custom-vert btn-lg" onclick="traiteConnexion("chalets.html")">CONFIRMER</button><br/><br/>';
		$form .= '<button type="button" class="btn btn-custom-gris btn-lg" onclick="traiteConnexion("reserver.html")">&laquo; ÉTAPE PRÉCÉDENTE</button>';
		$form .= '</div> <!--  fin -->';
		$form .= '</div> <!-- /.row -->';
		$form .= '</div> <!-- /.container -->';
        echo $form;

        /*
        $form = '';
        $form .= '<form id="formulaire_confirmation">';
        $form .= '<h2>formulaire_confirmation</h2>';

        for ($i = 0; $i < count($produit); $i++) 
        {
            $form .= '<p> id_produit: ' . $produit[$i]["id_produit"] . '</p>';
            $form .= '<p> nom: ' . $produit[$i]["nom"] . '</p>';
            $form .= '<p> imageFacade: ' . $produit[$i]["imageFacade"] . '</p>';
            $form .= '<p> description: ' . $produit[$i]["description"] . '</p>';
        }

        for ($i = 0; $i < count($utilisateur); $i++) 
        {
            $form .= '<p> id_utilisateur: ' . $utilisateur[$i]["id_utilisateur"] . '</p>';
            $form .= '<p> nom: ' . $utilisateur[$i]["nom"] . '</p>';
            $form .= '<p> prenom: ' . $utilisateur[$i]["prenom"] . '</p>';
            $form .= '<p> courriel: ' . $utilisateur[$i]["courriel"] . '</p>';
            $form .= '<p> date_de_naissance: ' . $utilisateur[$i]["date_de_naissance"] . '</p>';
        }

        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        echo $form;
        */
    }

    public static function formulaire_historique($reservations)
    {

        $form = '';
        $form .= '<div class="container main">';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-12">';
        $form .= '<h1>Historique de vos réservation</h1>';
        $form .= '<h2>Détail sur vos réservation</h2>';

        for ($i = 0; $i < count($reservations); $i++) 
        {        
            $form .= '<h4>' . $reservations[$i]["nom"] . ' du ' . $reservations[$i]["date_debut"] . ' au ' . $reservations[$i]["date_fin"] . '</h4>';
            $form .= '<h4>Coût total de la réservation ' . $reservations[$i]["prix_a_la_reservation"] . '$</h4>';
            $form .= '<p>' . $reservations[$i]["description"] . '</p>';
            $form .= '<br/><br/>';
        }

        $form .= '<button type="button" class="btn btn-custom-vert btn-lg" onclick="traiteConnexion("profil.html")">REVENIR AU PROFIL</button>';
        $form .= '</div><!--  fin  col-lg-12 -->';
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';
        echo $form;

        /*
        $form = '';
        $form .= '<form id="formulaire_historique">';
        $form .= '<h2>formulaire_historique</h2>';

        for ($i = 0; $i < count($reservations); $i++) 
        {
            $form .= '<p> id_reservation: ' . $reservations[$i]["id_reservation"] . '</p>';
            $form .= '<p> id_produit: ' . $reservations[$i]["id_produit"] . '</p>';
            $form .= '<p> date_debut: ' . $reservations[$i]["date_debut"] . '</p>';
            $form .= '<p> date_fin: ' . $reservations[$i]["date_fin"] . '</p>';
            $form .= '<p> numero_semaine: ' . $reservations[$i]["numero_semaine"] . '</p>';
            $form .= '<p> nom_carte: ' . $reservations[$i]["nom_carte"] . '</p>';
            $form .= '<p> numero_carte: ' . $reservations[$i]["numero_carte"] . '</p>';
            $form .= '<p> id_carte: ' . $reservations[$i]["id_carte"] . '</p>';
            $form .= '<p> prix_a_la_reservation: ' . $reservations[$i]["prix_a_la_reservation"] . '</p>';

        }

        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        echo $form;
        */
    }

    public static function formulaire_reservations($reservations)
    {

        $form = '';
        $form .= '<div class="container main">';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-12">';
        $form .= '<h1>Détail sur toutes les réservation</h1>';

        for ($i = 0; $i < count($reservations); $i++) 
        {        
            $form .= '<h2>Client: ' . $reservations[$i]["id_utilisateur"] . '</h2>';
            $form .= '<h4>' . $reservations[$i]["nom"] . ' du ' . $reservations[$i]["date_debut"] . ' au ' . $reservations[$i]["date_fin"] . '</h4>';
            $form .= '<h4>Coût total de la réservation ' . $reservations[$i]["prix_a_la_reservation"] . '$</h4>';
            $form .= '<p>' . $reservations[$i]["description"] . '</p>';
            $form .= '<br/><br/>';
        }

        $form .= '<button type="button" class="btn btn-custom-vert btn-lg" onclick="traiteConnexion("profil.html")">REVENIR AU PROFIL</button>';
        $form .= '</div><!--  fin  col-lg-12 -->';
        $form .= '</div><!-- /.row -->';
        $form .= '</div> <!-- /.container -->';
        echo $form;

        /*
        $form = '';
        $form .= '<form id="formulaire_reservations">';
        $form .= '<h2>formulaire_reservations</h2>';

        for ($i = 0; $i < count($reservations); $i++) 
        {
            $form .= '<p> id_reservation: ' . $reservations[$i]["id_reservation"] . '</p>';
            $form .= '<p> id_produit: ' . $reservations[$i]["id_produit"] . '</p>';
            $form .= '<p> date_debut: ' . $reservations[$i]["date_debut"] . '</p>';
            $form .= '<p> date_fin: ' . $reservations[$i]["date_fin"] . '</p>';
            $form .= '<p> numero_semaine: ' . $reservations[$i]["numero_semaine"] . '</p>';
            $form .= '<p> nom_carte: ' . $reservations[$i]["nom_carte"] . '</p>';
            $form .= '<p> numero_carte: ' . $reservations[$i]["numero_carte"] . '</p>';
            $form .= '<p> id_carte: ' . $reservations[$i]["id_carte"] . '</p>';
            $form .= '<p> prix_a_la_reservation: ' . $reservations[$i]["prix_a_la_reservation"] . '</p>';

        }

        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        echo $form;
        */
    }

    // function qui retourne le formulaire "visualiser une Commande" à panier.html
    public static function formulaire_creerUneReservation($resultat)
    {
        $form = '';
        $form .= '<form id="formulaireCreerUneReservation">';
        $form .= '<h2>Créer une réservation</h2>';
        $form .= '<p> resultat: ' . $resultat . '</p>';    
        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        $form .= '</html>';
        echo $form;
    }
}

?>