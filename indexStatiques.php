<?php

/*****************************************/
/* CONNEXION DE LA BASE DE DONNÉE EN PDO */
/*****************************************/
require_once("./includes/connexionPDO.class.php");

/******************/
/* INITIALISATION */
/******************/
require_once("./inits/maitre.init.php");
require_once("./inits/statiques.init.php");

/**********/
/* MODELE */
/**********/
require_once("./modeles/statiques.class.php");

/*******/
/* VUE */
/*******/
require_once("./vues/statiques.class.php");

/**************/
/* CONTROLEUR */
/**************/
/*****************************/
/* il n'y a qu'un controleur */
/*****************************/
require_once("./controleurs/statiques.class.php"); // CONTROLEUR DE TEST POUR LES ÉLÉMENTS STATIQUES

/************************/
/* SQUELETTES DES PAGES */
/************************/
if ($_GET["requetePage"] = "client")
{
	// pages pour les statiques normaux du site
	require_once("./squelettes/client.php");
}
else
{
	// pages pour les administrateurs du site
	require_once("./squelettes/admin.php");
} 

?>
