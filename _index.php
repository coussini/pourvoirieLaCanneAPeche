<?php

/*****************************************/
/* CONNEXION DE LA BASE DE DONNÉE EN PDO */
/*****************************************/
require_once("./includes/connexionPDO.class.php");

/******************/
/* INITIALISATION */
/******************/
require_once("./inits/maitre.init.php");
require_once("./inits/utilisateurs.init.php");
require_once("./inits/produits.init.php");
require_once("./inits/statiques.init.php");
require_once("./inits/reservations.init.php");

/**********/
/* MODELE */
/**********/
require_once("./modeles/utilisateurs.class.php");
require_once("./modeles/produits.class.php");
require_once("./modeles/reservations.class.php");
require_once("./modeles/statiques.class.php");

/*******/
/* VUE */
/*******/
require_once("./vues/maitre.class.php");
require_once("./vues/utilisateurs.class.php");
require_once("./vues/produits.class.php");
require_once("./vues/reservations.class.php");
require_once("./vues/statiques.class.php");

/**************/
/* CONTROLEUR */
/**************/
/*****************************/
/* il n'y a qu'un controleur */
/*****************************/
require_once("./controleurs/controleur.class.php"); // CECI EST LE CONTROLEUR FINAL

/************************/
/* SQUELETTES DES PAGES */
/************************/
if ($_GET["requetePage"] = "client")
{
	// pages pour les utilisateurs normaux du site
	require_once("./squelettes/client.php");
}
else
{
	// pages pour les administrateurs du site
	require_once("./squelettes/admin.php");
} 

?>
