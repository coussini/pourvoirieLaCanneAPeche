<?php

class Controleur
{
    public static function gererRequetes()
    {
        switch ($_GET['requete']) 
        {
            case 'req_extraireDesProduits':
                self::req_extraireDesProduits();
                break;        
            case 'req_extraireUnProduit':
                self::req_extraireUnProduit();
                break;        
            case 'req_creerUnProduit':
                self::req_creerUnProduit();
                break;        
            case 'req_modifierUnProduit':
                //req_modifierUnProduit();
                break;        
            default:
                // erreur
                break;
        }
    }
    // traitement extraire des produits
    private static function req_extraireDesProduits()
    {
        try
        {
            $oProduits = new Produits();
            $Produits = $oProduits->extraireDesProduits($_GET["id_produit"]);
            VueProduits::formulaire_extraireDesProduits($Produits);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_extraireDesProduits("");
        }
    }

    // traitement extraire un produit
    private static function req_extraireUnProduit()
    {
        try
        {
            $oProduits = new Produits();
            $Produits = $oProduits->extraireUnProduit();
            VueProduits::formulaire_extraireUnProduit($produits);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_extraireUnProduit("");
        }
    }

    // traitement de confirmation d'un courriel dans le but d'y extraire les commandes
    private static function req_creerUnProduit()
    {
        try
        {
            $oProduits = new Produits();            
            $resultat = $oProduits->creerUnProduit($_GET["id_utilisateur"],
			$_GET["id_produit"],$_GET["statut"],$_GET["image"],$_GET["nom"],
			$_GET["emplacement"],$_GET["description"],$_GET["nombre_de_chambre"],
			$_GET["nombre_de_salle_de_bain"],$_GET["prix_par_jour"],$_GET["prix_par_semaine"]);
            VueProduits::formulaire_creerUnProduit($resultat);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_creerUnProduit("");
        }
    }    
}

?>