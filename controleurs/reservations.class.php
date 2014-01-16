<?php

class Controleur
{
    public static function gererRequetes($requeteAJAX)
    {
        // si le champ requete dédié au appel AJAX est vide, on
        // on prend le get de la requete normale
        // sinon on traite la requete AJAX tel quel
        //
        $requete = "";

        if ($requeteAJAX == "")
        {
            $requete = $_GET['requete'];
        }
        else
        {
            $requete = $_GET['requeteAJAX'];
        }

        switch ($requete) 
        {
            case 'req_chercher_dates_reservees':
                self::req_chercher_dates_reservees();
                break;        
            case 'reserver.html':
                self::req_reserver();
                break;        
            case 'confirmation.html':
                self::req_confirmation();
                break;        
            case 'historique.html':
                self::req_historique();
                break;        
            case 'reservations.html':
                self::req_reservations();
                break;        
            case 'req_extraireDesReservations':
                self::req_extraireDesReservations();
                break;        
            case 'req_extraireUneReservation':
                self::req_extraireUneReservation();
                break;        
            case 'req_creerUneReservation':
                self::req_creerUneReservation();
                break;        
            default:
                // erreur
                break;
        }
    }

    // extraire les données pour générer le calendrier de réservation
    private static function req_chercher_dates_reservees()
    {
        try
        {
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireLesReservationPourCeProduit($_GET["id_produit"]);
            VueReservations::formulaire_chercher_dates_reservees($reservations);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
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
            VueReservations::formulaire_reserver($produit);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueReservations::formulaire_erreur();
        }
    }
    
    // extraire les données pour générer la page confirmation.html
    private static function req_confirmation()
    {
        try
        {
            $oReservations = new Reservations();
            $produit = $oReservations->extraireLeProduit($_GET["id_produit"]);
            $utilisateur = $oReservations->extraireUtilisateur($_GET["id_utilisateur"]);
            VueReservations::formulaire_confirmation($produit,$utilisateur,($_GET["date_debut"],($_GET["date_fin"]);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueReservations::formulaire_erreur();
        }
    }
    
    // extraire les données pour générer la page historique.html
    private static function req_historique()
    {
        try
        {
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireUneReservation($_GET["id_utilisateur"]);
            VueReservations::formulaire_historique($reservations);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueReservations::formulaire_erreur();
        }
    }

    // traitement extraire des réservations
    private static function req_extraireDesReservations()
    {
        try
        {
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireDesReservations();
            VueReservations::formulaire_extraireDesReservations($reservations);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueReservations::formulaire_erreur();
        }
    }

    // traitement extraire une réservation
    private static function req_extraireUneReservation()
    {
        try
        {
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireUneReservation(($_GET["id_utilisateur"]);
            VueReservations::formulaire_extraireUneReservation($reservations);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueReservations::formulaire_erreur();
        }
    }

    // traitement de confirmation d'un courriel dans le but d'y extraire les commandes
    private static function req_creerUneReservation()
    {
        try
        {
            $oReservations = new Reservations();            
            $resultat = $oReservations->creerUneReservation($_GET["id_utilisateur"],$_GET["id_produit"],$_GET["date_debut"],$_GET["date_fin"],$_GET["nombre_de_semaine"],$_GET["prix_a_la_reservation"]);
            VueReservations::formulaire_creerUneReservation($resultat);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueReservations::formulaire_erreur();
        }
    }    
}

?>