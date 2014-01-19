<?php

// traitement des POST
if (empty($_POST["id_utilisateur"]))
{
    $_POST["id_utilisateur"] = '';
}

if (empty($_POST["id_produit"]))
{
    $_POST["id_produit"] = '';
}

if (empty($_POST["date_debut"]))
{
    $_POST["date_debut"] = '';
}

if (empty($_POST["date_fin"]))
{
    $_POST["date_fin"] = '';
}

if (empty($_POST["numero_semaine"]))
{
    $_POST["numero_semaine"] = '';
}

if (empty($_POST["nom_carte"]))
{
    $_POST["nom_carte"] = '';
}

if (empty($_POST["numero_carte"]))
{
    $_POST["numero_carte"] = '';
}

if (empty($_POST["numero_carte"]))
{
    $_POST["numero_carte"] = '';
}

if (empty($_POST["id_carte"]))
{
    $_POST["id_carte"] = '';
}

if (empty($_POST["prix_a_la_reservation"]))
{
    $_POST["prix_a_la_reservation"] = '';
}

// traitement des GET
if (empty($_GET["id_reservation"]))
{
    $_GET["id_reservation"] = '';
}

if (empty($_GET["id_utilisateur"]))
{
    $_GET["id_utilisateur"] = '';
}

if (empty($_GET["id_produit"]))
{
    $_GET["id_produit"] = '';
}

if (empty($_GET["date_debut"]))
{
    $_GET["date_debut"] = '';
}

if (empty($_GET["date_fin"]))
{
    $_GET["date_fin"] = '';
}

if (empty($_GET["numero_semaine"]))
{
    $_GET["numero_semaine"] = '';
}

if (empty($_GET["nom_carte"]))
{
    $_GET["nom_carte"] = '';
}

if (empty($_GET["numero_carte"]))
{
    $_GET["numero_carte"] = '';
}

if (empty($_GET["id_carte"]))
{
    $_GET["id_carte"] = '';
}

if (empty($_GET["prix_a_la_reservation"]))
{
    $_GET["prix_a_la_reservation"] = '';
}

if (empty($_GET["message_confirmation"]))
{
    $_GET["message_confirmation"] = '';
}

// affecte les get de post s'il y a lieu
if (!empty($_POST["id_utilisateur"]))
{
    $_GET["id_utilisateur"] = $_POST["id_utilisateur"];
}

if (!empty($_POST["id_produit"]))
{
    $_GET["id_produit"] = $_POST["id_produit"];
}
if (!empty($_POST["date_debut"]))
{
    $_GET["date_debut"] = $_POST["date_debut"];
}

if (!empty($_POST["date_fin"]))
{
    $_GET["date_fin"] = $_POST["date_fin"];
}

if (!empty($_POST["numero_semaine"]))
{
    $_GET["numero_semaine"] = $_POST["numero_semaine"];
}

if (!empty($_POST["nom_carte"]))
{
    $_GET["nom_carte"] = $_POST["nom_carte"];
}

if (!empty($_POST["numero_carte"]))
{
    $_GET["numero_carte"] = $_POST["numero_carte"];
}

if (!empty($_POST["numero_carte"]))
{
    $_GET["numero_carte"] = $_POST["numero_carte"];
}

if (!empty($_POST["id_carte"]))
{
    $_GET["id_carte"] = $_POST["id_carte"];
}

if (!empty($_POST["prix_a_la_reservation"]))
{
    $_GET["prix_a_la_reservation"] = $_POST["prix_a_la_reservation"];
}
?>
