<?php

$_GET['requete'] = 'req_creerUnProduit';


$_GET["statut"] = "inactif";
$_GET["imageFacade"] = "./images/chalet2.jpg";
$_GET["imageInterieur1"] = "./images/chalet2-photo1.jpg";
$_GET["imageInterieur2"]= "./images/chalet2-photo2.jpg";
$_GET["imageInterieur3"]= "./images/chalet2-photo3.jpg";
$_GET["nom"]= "Relax";
$_GET["emplacement"]="chalet2";
$_GET["description"]="Situé au bord d'un lac. Vous tomberez sous le charme. Ce chalet a été rénové en 2010. Grande galerie avec vue sur le lac.";
$_GET["nombre_de_chambre"]=3;
$_GET["nombre_de_salle_de_bain"]=2;
$_GET["prix_par_semaine"]=699;

$_GET["requetePage"]="client";


/*****************************************/
/* CONNEXION DE LA BASE DE DONNÉE EN PDO */
/*****************************************/
require_once("./includes/connexionPDO.class.php");

/******************/
/* INITIALISATION */
/******************/
require_once("./inits/maitre.init.php");
require_once("./inits/produits.init.php");

/**********/
/* MODELE */
/**********/
require_once("./modeles/produits.class.php");

/*******/
/* VUE */
/*******/
require_once("./vues/produits.class.php");

/**************/
/* CONTROLEUR */
/**************/
/*****************************/
/* il n'y a qu'un controleur */
/*****************************/
require_once("./controleurs/produits.class.php"); // CONTROLEUR DE TEST POUR LES PRODUITS

/************************/
/* SQUELETTES DES PAGES */
/************************/
if ($_GET["requetePage"] = "client")
{
	// pages pour les produits normaux du site
	require_once("./squelettes/client.php");
}
else
{
	// pages pour les administrateurs du site
	require_once("./squelettes/admin.php");
} 

?>
