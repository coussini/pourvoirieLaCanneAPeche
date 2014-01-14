<?php
if (empty($_GET["requete"]))
{
    $_GET["requete"] = '';
}

if (empty($_GET["requetePage"]))
{
    $_GET["requetePage"] = '';
}

if (empty($_GET["requeteAJAX"]))
{
    $_GET["requeteAJAX"] = '';
}

// pour les messages d'erreur
$_GET["erreur"] = '';

// pour le message de confirmation de la commande
$_GET["confirmation"] = '';

?>
