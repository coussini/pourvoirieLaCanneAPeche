<?php

// temporaire
$_GET["requetePage"] = "admin";
$_GET['requete'] = "reservations.html";
$_GET["id_reservation"] = '';
$_GET["id_utilisateur"] = 1;
$_GET["id_produit"] = 1;
$_GET["date_debut"] = '';
$_GET["date_fin"] = '';
$_GET["nombre_de_semaine"] = '';
$_GET["prix_a_la_reservation"] = '';


/*****************************************/
/* CONNEXION DE LA BASE DE DONNÉE EN PDO */
/*****************************************/
require_once("./includes/connexionPDO.class.php");

/******************/
/* INITIALISATION */
/******************/
require_once("./inits/maitre.init.php");
require_once("./inits/reservations.init.php");

/**********/
/* MODELE */
/**********/
require_once("./modeles/reservations.class.php");

/*******/
/* VUE */
/*******/
require_once("./vues/reservations.class.php");

/**************/
/* CONTROLEUR */
/**************/
/*****************************/
/* il n'y a qu'un controleur */
/*****************************/
require_once("./controleurs/reservations.class.php"); // CONTROLEUR DE TEST POUR LES RÉSERVATIONS

/************************/
/* SQUELETTES DES PAGES */
/************************/
if ($_GET["requeteAJAX"] == "")
{
    if ($_GET["requetePage"] == "client")
    {
        // pages pour les reservations normaux du site
        require_once("./squelettes/client.php");
    }
    else
    {
        // pages pour les administrateurs du site
        require_once("./squelettes/admin.php");
    } 
}
else
{
    Controleur::gererRequetes($_GET["requeteAJAX"]);
}
?>