<?php

class Controleur
{
    public static function gererRequetes($requeteAJAX,$id_produit)
    {

        // si le champ requete dédié au appel AJAX est vide, on
        // on prend le get de la requete normale
        // sinon on traite la requete AJAX tel quel
        //
        $requete = "";

        if ($requeteAJAX == "")
        {
            $requete = $_GET["requete"];
        }
        else
        {
            $requete = $_GET["requeteAJAX"];
        }

        switch ($requete) 
        {
            case 'req_chercher_dates_reservees':
                self::req_chercher_dates_reservees($id_produit);
                break;        
            case 'reserver_html':
                self::req_reserver();
                break;        
            case 'confirmation_html':
                self::req_confirmation();
                break;        
            case 'creer_une_reservation':
                self::req_creerUneReservation();
                break;        
            case 'historique_html':
                self::req_historique();
                break;        
            case 'reservations_html':
                self::req_reservations();
                break;        
            default:
                echo "veuillez inscrire une requête avec le mot ?requete=...";
                break;
        }
    }

    // extraire les données pour générer le calendrier de réservation
    private static function req_chercher_dates_reservees($id_produit)
    {
        try
        {
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireLesReservationPourCeProduit($id_produit);
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

    // traitement de confirmation d'une réservation
    private static function req_creerUneReservation()
    {
        try
        {
            $oReservations = new Reservations();    
            $resultat = $oReservations->creerUneReservation($_GET["id_utilisateur"],$_GET["id_produit"],$_GET["date_debut"],$_GET["date_fin"],$_GET["numero_semaine"],$_GET["nom_carte"],$_GET["numero_carte"],$_GET["id_carte"],$_GET["prix_a_la_reservation"]);
            if ($resultat)
            {
                $produit = $oReservations->extraireLeProduit($_GET["id_produit"]); // les tests ont été fait par req_reserver
                $utilisateur = $oReservations->extraireUtilisateur($_GET["id_utilisateur"]);
                $_GET["requete"] = 'creer_une_reservation';
                $_GET["message_confirmation"]  = "merci d'avoir effectué votre réservation";
                VueReservations::formulaire_creerUneReservation($produit,$utilisateur,$_GET["date_debut"],$_GET["date_fin"],$_GET["numero_semaine"],$_GET["nom_carte"],$_GET["numero_carte"],$_GET["id_carte"],$_GET["prix_a_la_reservation"]);
            }
        }
        catch(Exception $e)
        {
            $oReservations = new Reservations();    
            $produit = $oReservations->extraireLeProduit($_GET["id_produit"]); // les tests ont été fait par req_reserver
            $utilisateur = $oReservations->extraireUtilisateur($_GET["id_utilisateur"]);
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'creer_une_reservation';
            VueReservations::formulaire_creerUneReservation($produit,$utilisateur,$_GET["date_debut"],$_GET["date_fin"],$_GET["numero_semaine"],$_GET["nom_carte"],$_GET["numero_carte"],$_GET["id_carte"],$_GET["prix_a_la_reservation"]);
        }
    }    
}
?>