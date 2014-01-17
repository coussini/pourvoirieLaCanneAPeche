<?php


if (empty($_GET["action"]))
{
    $_GET["action"] = '';
}

if (empty($_POST["nom"]))
{
    $_GET["nom"] = '';
}

if (empty($_POST["prenom"]))
{
    $_GET["prenom"] = '';
}

if (empty($_POST["courriel"]))
{
    $_POST["courriel"] = '';
}

if (empty($_GET["courriel"]))
{
    $_GET["courriel"] = '';
}

if ( $_POST["courriel"] != '')
{
    $_GET["courriel"] = $_POST["courriel"];
}

if (empty($_POST["mot_de_passe"]))
{
    $_GET["mot_de_passe"] = '';
}

if (empty($_POST["mot_de_passe"]))
{
    $_GET["mot_de_passe"] = '';
}

if (empty($_POST["date_de_naissance"]))
{
    $_GET["date_de_naissance"] = '';
}

?>
