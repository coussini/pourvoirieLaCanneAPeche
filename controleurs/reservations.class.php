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
            $requete = $_GET["requete"];
        }
        else
        {
            $requete = $_GET["requeteAJAX"];
        }

        switch ($requete) 
        {
            case 'req_chercher_dates_reservees':
                self::req_chercher_dates_reservees();
                break;        
            case 'reserver_html':
                self::req_reserver();
                break;        
            case 'confirmation_html':
                self::req_confirmation();
                break;        
            case 'historique_html':
                self::req_historique();
                break;        
            case 'reservations_html':
                self::req_reservations();
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
            VueReservations::formulaire_reserver($produit);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
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
            VueReservations::formulaire_confirmation($produit,$utilisateur,$_GET["date_debut"],$_GET["date_fin"]);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            VueReservations::formulaire_erreur();
        }
    }
    
    // extraire les données pour générer la page historique.html
    private static function req_historique()
    {
        try
        {
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireLesReservationsUtilisateur($_GET["id_utilisateur"]);
            VueReservations::formulaire_historique($reservations);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            VueReservations::formulaire_erreur();
        }
    }
    
    // extraire les données pour générer la page reservations.html
    private static function req_reservations()
    {
        try
        {
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireLesReservations();
            VueReservations::formulaire_reservations($reservations);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
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
            $_GET["erreur"]  = $e->getMessage();
            VueReservations::formulaire_erreur();
        }
    }    
}

?>