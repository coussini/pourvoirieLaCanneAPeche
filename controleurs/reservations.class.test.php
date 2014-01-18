<?php

class Controleur
{
    public static function gererRequetes($sss)
    {
        //self::req_chercher_dates_reservees();
        //self::req_reserver();
        //self::req_confirmation();
        //self::req_historique();
        //self::req_reservations();
        self::req_creerUneReservation();
    }

    // extraire les données pour générer le calendrier de réservation
    private static function req_chercher_dates_reservees()
    {
        try
        {
            //$_GET["id_produit"] = "";
            //$_GET["id_produit"] = "abc";
            //$_GET["id_produit"] = 999;
            //if (empty($reservations))
            //{
            //    throw new Exception("Il n'y a pas de réservation pour cet id produit");
            //}
            $_GET["id_produit"] = 2;
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireLesReservationPourCeProduit($_GET["id_produit"]);
            VueReservations::formulaire_chercher_dates_reservees($reservations);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            VueReservations::formulaire_erreur();
        }
    }
    
    // extraire les données pour générer la page reserver.html
    private static function req_reserver()
    {
        try
        {
            //$_GET["id_produit"] = "";
            //$_GET["id_produit"] = "abc";
            //$_GET["id_produit"] = 999;
            //if (empty($produit))
            //{
            //    throw new Exception("Il n'y a pas de produits pour cet id produit");
            //}
            $_GET["id_produit"] = 2;
            $oReservations = new Reservations();
            $produit = $oReservations->extraireLeProduit($_GET["id_produit"]);
            $_GET["requete"] = 'confirmation_html';
            VueReservations::formulaire_reserver($produit);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'reserver_html';
            VueReservations::formulaire_reserver("");
        }
    }
    
    // extraire les données pour générer la page confirmation.html
    private static function req_confirmation()
    {
        try
        {
            /* UTILISATEUR */
            //$_GET["id_utilisateur"] = "";
            //$_GET["id_utilisateur"] = "abc";
            //$_GET["id_utilisateur"] = 999;
            //if (empty($utilisateur))
            //{
            //    throw new Exception("Il n'y a pas d'utilisateur pour cet id utilisateur");
            //}
            $_GET["id_utilisateur"] = 1;
            
            $_GET["id_produit"] = 2; // les tests sur les produits ont été fait par req_reserver
            $oReservations = new Reservations();
            $produit = $oReservations->extraireLeProduit($_GET["id_produit"]); // les tests ont été fait par req_reserver
            $utilisateur = $oReservations->extraireUtilisateur($_GET["id_utilisateur"]);
            $_GET["requete"] = 'creer_une_reservation';
            VueReservations::formulaire_confirmation($produit,$utilisateur,$_GET["date_debut"],$_GET["date_fin"],$_GET["numero_semaine"]);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'confirmation_html';
            VueReservations::formulaire_confirmation("","","","","");
        }
    }
    
    // extraire les données pour générer la page historique.html
    private static function req_historique()
    {
        try
        {
            /* UTILISATEUR */
            //$_GET["id_utilisateur"] = "";
            //$_GET["id_utilisateur"] = "abc";
            //$_GET["id_utilisateur"] = 999;
            //if (empty($reservations))
            //{
            //    throw new Exception("Il n'y a pas de réservations pour cet id utilisateur");
            //}
            $_GET["id_utilisateur"] = 2;
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireLesReservationsUtilisateur($_GET["id_utilisateur"]);
            $_GET["requete"] = 'historique_html';
            VueReservations::formulaire_historique($reservations);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'historique_html';
            VueReservations::formulaire_historique("");
        }
    }
    
    // extraire les données pour générer la page reservations.html
    private static function req_reservations()
    {
        try
        {
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireLesReservations();
            $_GET["requete"] = 'reservations_html';
            VueReservations::formulaire_reservations($reservations);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'reservations_html';
            VueReservations::formulaire_reservations("");
        }
    }

    // traitement de confirmation d'un courriel dans le but d'y extraire les commandes
    private static function req_creerUneReservation()
    {
        try
        {
            //$_GET["id_utilisateur"] = "";
            //$_GET["id_utilisateur"] = "abc";
            //$_GET["id_utilisateur"] = 999;
            $_GET["id_utilisateur"] = 1;
            //$_GET["id_produit"] = "";
            //$_GET["id_produit"] = "abc";
            //$_GET["id_produit"] = 999;
            $_GET["id_produit"] = 1;
            //$_GET["date_debut"] = '';
            $_GET["date_debut"] = '2014-02-02';
            //$_GET["date_fin"] = '';
            $_GET["date_fin"] = '2014-02-14';
            //$_GET["numero_semaine"] = '';
            //$_GET["numero_semaine"] = 'a';
            $_GET["numero_semaine"] = 23;
            //$_GET["nom_carte"] = '';
            //$_GET["nom_carte"] = 'ded';
            //$_GET["nom_carte"] = 'visa';
            $_GET["nom_carte"] = 'Mastercard';
            //$_GET["numero_carte"] = '';
            //$_GET["numero_carte"] = 'abc';
            //$_GET["numero_carte"] = '123abc1111111111';
            //$_GET["numero_carte"] = '111122223333444';
            $_GET["numero_carte"] = '1111222233335555';
            //$_GET["id_carte"] = '';
            //$_GET["id_carte"] = 'av';
            //$_GET["id_carte"] = '1av';
            //$_GET["id_carte"] = '1';
            $_GET["id_carte"] = '123';
            //$_GET["prix_a_la_reservation"] = '';
            //$_GET["prix_a_la_reservation"] = 'ab';
            //$_GET["prix_a_la_reservation"] = '23.44';
            $_GET["prix_a_la_reservation"] = 23.44;

            $oReservations = new Reservations();    
            $resultat = $oReservations->creerUneReservation($_GET["id_utilisateur"],$_GET["id_produit"],$_GET["date_debut"],$_GET["date_fin"],$_GET["numero_semaine"],$_GET["nom_carte"],$_GET["numero_carte"],$_GET["id_carte"],$_GET["prix_a_la_reservation"]);
            if ($resultat)
            {
                $produit = $oReservations->extraireLeProduit($_GET["id_produit"]); // les tests ont été fait par req_reserver
                $utilisateur = $oReservations->extraireUtilisateur($_GET["id_utilisateur"]);
                $_GET["requete"] = 'confirmation_html';
                $_GET["message_confirmation"]  = "merci d'avoir effectué votre réservation";
                VueReservations::formulaire_confirmation($produit,$utilisateur,$_GET["date_debut"],$_GET["date_fin"],$_GET["numero_semaine"]);
            }
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'confirmation_html';
            VueReservations::formulaire_confirmation("","","","","");
        }
    }    
}

?>