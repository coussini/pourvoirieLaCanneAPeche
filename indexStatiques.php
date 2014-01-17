<?php

        ///// TESTS UNITAIRES /////

        ///// Récupérer contenu /////
        //$_GET['nom'] = 'test4';
        //$_GET['nom'] = 'nom_inexistant';    

        ///// Récupérer contenu par l'id /////
        //$_GET['requete'] = 'req_getContenuStatiqueParID';
        //$_GET['idStatique'] = 'test';      
        //$_GET['idStatique'] = 31;   

        ///// Récupérer id par le nom /////
        //$_GET['requete'] = 'req_getidstatiqueByName';
        //$_GET['nom'] = 'test3';   

        ///// Récupérer tous les noms des contenus statiques /////
        //$_GET['requete'] = 'req_getNomsContenuStatique';    

        ///// Créer contenu /////
        //$_GET['requete'] = 'req_setContenuStatique';
        //$_GET['statut'] = 'actif';
        //$_GET['nom'] = 'test2';
        //$_GET['contenu'] = 'ceci est le test 2';
        //$_GET['statut'] = 'inactif';
        //$_GET['nom'] = 'test3';
        //$_GET['contenu'] = 'ceci est le test 2#%&(*&*"';
        //$_GET['requete'] = 'req_setContenuStatique';
        //$_GET['statut'] = 'detruit';
        //$_GET['nom'] = 'test4';
        //$_GET['contenu'] = 'Ceci est encore un contenu';

        ///// Changer le statut d'un contenu /////
        //$_GET['requete'] = 'req_changeStatutStatique';
        //$_GET['nom'] = 'test';
        //$_GET['idStatique'] = '31';
        //$_GET['statut'] = 'rien';
        //$_GET['statut'] = 'inactif';

        ///// Modifier un contenu /////
        //$_GET['requete'] = 'req_updateContenuStatique';
        //$_GET['idStatique'] = 'quoi';
        //$_GET['idStatique'] = '31';
        //$_GET['contenu'] = 'Ceci est un nouveau contenu';


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

//require_once("./squelettes/admin.php");
require_once("./squelettes/client.php");


/*if ($_GET["requetePage"] = "client")
{
	// pages pour les statiques normaux du site
	require_once("./squelettes/client.php");
}
else
{
	// pages pour les administrateurs du site
	require_once("./squelettes/admin.php");
} */

?>
