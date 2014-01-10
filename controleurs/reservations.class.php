<?php

class Controleur
{
    public static function gererRequetes()
    {
        $_GET['requete'] = 'req_extraireuUnUtilisateur';
        
        switch ($_GET['requete']) 
        {
            case 'req_extraireuUnUtilisateur':
                self::req_extraireuUnUtilisateur();
                break;        
            case 'req_extraireUneReservation':
                self::req_extraireUneReservation();
                break;        
            case 'req_creerUneReservation':
                self::req_creerUneReservation();
                break;        
            case 'req_modifierUneReservation':
                //req_modifierUneReservation();
                break;        
            default:
                // erreur
                break;
        }
    }
    // traitement extraire un utilisateur
    private static function req_extraireuUnUtilisateur()
    {
        try
        {
            $oReservations = new Reservations();
            $utilisateur = $oReservations->extraireuUnUtilisateur("");
            VueReservations::formulaire_extraireuUnUtilisateur($utilisateur);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueReservations::formulaire_extraireuUnUtilisateur("");
        }
    }

    // traitement extraire des réservations
    private static function req_extraireDesReservations()
    {
        try
        {
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireDesReservations($_GET["id_reservation"]);
            VueReservations::formulaire_extraireDesReservations($reservations);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueReservations::formulaire_extraireDesReservations("");
        }
    }

    // traitement extraire une réservation
    private static function req_extraireUneReservation()
    {
        try
        {
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireUneReservation();
            VueReservations::formulaire_extraireUneReservation($reservations);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueReservations::formulaire_extraireUneReservation("");
        }
    }

    // traitement de confirmation d'un courriel dans le but d'y extraire les commandes
    private static function req_creerUneReservation()
    {
        try
        {
            $oReservations = new Reservations();            
            $resultat = $oReservations->creerUneReservation($_GET["id_utilisateur"],$_GET["id_produit"],$_GET["date_debut"],$_GET["date_fin"],$_GET["nombre_de_semaine"]);
            VueReservations::formulaire_creerUneReservation($resultat);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueReservations::formulaire_creerUneReservation("");
        }
    }    
}

?>