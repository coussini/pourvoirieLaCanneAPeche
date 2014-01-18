<?php

$_GET["requetePage"] = "admin";
$_GET["id_utilisateur"] = 1;
$_GET["id_produit"] = 1;

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
//require_once("./controleurs/reservations.class.test.php"); // CONTROLEUR DE TEST POUR LES RÉSERVATIONS
require_once("./controleurs/reservations.class.php");

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