<?php

$_GET['requete'] = 'req_creerUnProduit';


$_GET["statut"] = "actif";
$_GET["imageFacade"] = "./images/chalet1.jpg";
$_GET["imageInterieur1"] = "./images/chalet1-photo1.jpg";
$_GET["imageInterieur2"]= "./images/chalet1-photo2.jpg";
$_GET["imageInterieur3"]= "./images/chalet1-photo3.jpg";
$_GET["nom"]= "Belle-vue";
$_GET["emplacement"]="chalet1";
$_GET["description"]="Vous tomberez sous le charme de ce chalet au bord du lac. Ce chalet a été rénové en 2010. Grande galerie avec vue sur le lac.";
$_GET["nombre_de_chambre"]=2;
$_GET["nombre_de_salle_de_bain"]=1;
$_GET["prix_par_semaine"]=850;

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
