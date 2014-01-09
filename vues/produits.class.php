<?php
// ICI on met tout ce qui va être insérer pour changer les titres "TITLE"
// ICI on met ce qui doit être changé comme item de menu actif ou non
// le maitre fait la partie générale
// Je vous reviens là dessus

// function qui retourne le formulaire "passer une commande" à panier.html dans le cas d'une erreur
class VueProduits
{

    public static function formulairePasserUneCommande()
    {
        $form = '';
        $form .= '<form id="formulairePasserUneCommande">';
        $form .= '<h2>Passer la commande (identification)</h2>';
        $form .= '<label class="emaCourriel" for="emaCourriel">Courriel<label>';
        $form .= '<input type="email" id="emaCourriel"  placeholder="abc@hotmail.com" required autofocus/><br/><br/>';
        $form .= '<label class="txtAdresse" for="txtAdresse">Adresse<label>';
        $form .= '<textarea  rows="4" cols="50" id="txtAdresse" pattern="^[a-zA-Z\-\,\s\u00C0-\u00FF]{1,}$" placeholder="votre adresse complete" required/></textarea>';
        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '<div class="confirmation">';
        $form .= '<p>' . $_GET["confirmation"] . '</p>';
        $form .= '</div>';
        $form .= '<input class="retournerAuPanier" id="retournerAuPanier" type="button" value="Retourner au panier">';
        $form .= '<input class="confirmerCommande" id="confirmerCommande" type="submit" value="Confirmer la commande">';
        $form .= '</form>';
        echo $form;
    }

    // function qui retourne le formulaire "passer une commande" à panier.html dans le cas d'une réussite
    public static function formulaireCommandeCompletee()
    {
        $form = '';
        $form .= '<form id="formulairePasserUneCommande">';
        $form .= '<h2>Passer la commande (identification)</h2>';
        $form .= '<div class="confirmation">';
        $form .= '<p>' . $_GET["confirmation"] . '</p>';
        $form .= '</div>';
        $form .= '<input class="continuerAMagasiner" id="continuerAMagasiner" type="button" value="Continuer à magasiner">';
        $form .= '</form>';
        echo $form;
    }

    // function qui retourne le formulaire "visualiser une Commande" à panier.html
    public static function formulaireVisualiserCommande()
    {
        $form = '';
        $form .= '<form id="formulaireVisualiserCommande">';
        $form .= '<h2>Voir mes commandes</h2>';
        $form .= '<label class="emaCourriel" for="emaCourriel">Courriel</label>';
        $form .= '<input type="email" id="emaCourriel"  placeholder="abc@hotmail.com" required autofocus/><br/><br/>';
        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '<input class="continuerAMagasiner" id="continuerAMagasiner" type="button" value="Continuer à magasiner">';
        $form .= '<input class="confirmerCourriel" type="submit" value="Confirmer">';
        $form .= '</form>';
        echo $form;
    }

    // function qui retourne le formulaire "liste des commandes" à panier.html
    public static function formulaireListeDeCommande($commandes)
    {
        $sousTotal = 0;
        $form = '';
        $form .= '<form id="formulaireListeDeCommande">';
        $form .= '<h2>Liste de commande(s)</h2>';

        for ($i = 0; $i < count($commandes); $i++) 
        {
            $sousTotal += $commandes[$i]["total"];
            $form .= '<p class="listeCommande"> Date : ' . $commandes[$i]["date"] .  ' Commande totale : ' . $commandes[$i]["total"] . '$';
            $form .= '<input class="visualiserLesDetails" type="button" id="' . $commandes[$i]["id"] . '" value="Détails"/>';
        }

        $form .= '<article class="sousTotal">Total de vos achats : ' . round($sousTotal * 100,2) / 100 . ' $can</article>';
        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '<input class="continuerAMagasiner" id="continuerAMagasiner" type="button" value="Continuer à magasiner">';
        $form .= '</form>';
        echo $form;
    }

    // function qui retourne le formulaire "détails d'une commande" à panier.html
    public static function formulaireDetailsDeCommande($details)
    {

        $sousTotal = 0;
        $form = '';
        $form .= '<form id="formulaireListeDeDetails">';

        for ($i = 0; $i < count($details); $i++) 
        {
            $sousTotal += ($details[$i]["prix"] * $details[$i]["quantite"]);
            if ($i == 0) // entete avec la date de commande
            {
                $form .= '<h2>Liste de détails concernant votre commande du ' . $details[$i]["date_de_la_commande"] . '</h2>';
            }
            $form .= '<article class="liste">' .
                    '<section class="image"><img src="' . $details[$i]["image"] . '"></section>' . 
                    '<header class="nom">' . $details[$i]["titre"] . '</header>' .
                    '<section class="prix">' .
                    '<span class="prixPanier"> Prix = ' . $details[$i]["prix"] .
                    ' $ CAN</span>' .
                    '</section>' .
                    '<section>' .
                    '<span class="quantite"> , Quantité = ' . $details[$i]["quantite"] . '</span>' .
                    '</section>' .
                    '</article>' .
                    '<hr>';
        }

        $form .= '<article class="sousTotal">Total de vos achats : ' . round($sousTotal * 100,2) / 100 . ' $can</article>';
        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '<input class="revenirALaListeDeCommande" id="revenirALaListeDeCommande" type="button" value="Revenir  à la liste de commande">';
        $form .= '</form>';
        echo $form;
    }
}
?>