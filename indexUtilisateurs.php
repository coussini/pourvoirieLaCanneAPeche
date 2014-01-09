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

/**********/
/* MODELE */
/**********/
require_once("./modeles/utilisateurs.class.php");

/*******/
/* VUE */
/*******/
require_once("./vues/utilisateurs.class.php");

/**************/
/* CONTROLEUR */
/**************/
/*****************************/
/* il n'y a qu'un controleur */
/*****************************/
require_once("./controleurs/utilisateurs.class.php"); // CONTROLEUR DE TEST POUR LES UTILISATEURS

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
