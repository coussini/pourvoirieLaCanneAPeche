<?php

class Controleur
{
    public static function gererRequetes()
    {
        switch ($_GET['requete']) 
        {

            case 'chalets.html':
                self::req_chalets();

                break;
            case 'req_selectTousProduits':
                self::req_selectTousProduits();
                break;        
            case 'req_selectUnProduit':
                self::req_selectUnProduit();
                break;        
            case 'req_creerUnProduit':
                self::req_creerUnProduit();
                break;        
            case 'req_modifierUnProduit':
                self::req_modifierUnProduit();
                break;
            case 'req_selectionChalet':
                self::req_selectionChalet();
                break;
            case 'req_editerChalet':
                self::req_editerChalet();
            default:
                // erreur
                break;
        }
    }


    // traitement extraire des produits
    private static function req_chalets()
    {
        try
        {
            //$oProduits = new Produits();
            //$Produits = $oProduits->selectTousProduits();
            VueProduits::formulaire_chalets("");
        }

        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_erreur();
        }


    }



    // traitement extraire des produits
    private static function req_selectTousProduits()
    {
        try
        {
            $oProduits = new Produits();
            //$Produits = $oProduits->selectTousProduits($_GET["id_produit"]);
			$Produits = $oProduits->selectTousProduits();
            VueProduits::formulaire_selectTousProduits($Produits);
        }

        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_erreur();
        }


    }

    // traitement extraire un produit
    private static function req_selectUnProduit()
    {
        try
        {
            $oProduits = new Produits();
            $Produits = $oProduits->selectUnProduit('1');
			
            VueProduits::formulaire_selectUnProduit($Produits);
        }
        
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_erreur();
        }

    }



    // traitement de séletion d'un chalet sur la carte
    private static function req_selectionChalet()
    {
        try
        {
            $oProduits = new Produits();
            $Produits = $oProduits->selectUnProduit($_GET["id_produit"]);
            
            VueProduits::formulaire_selectionChalet($Produits);
        }
        
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_erreur();
        }

    }

//----------------------------------------------------------------------------------------------------------//

    // traitement d'édition d'un chalet
    private static function req_editerChalet()
    {
        try
        {
            $oProduits = new Produits();
            $Produits = $oProduits->selectUnProduit('1');
            
            VueProduits::formulaire_editerChalet($Produits);
        }
        
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_erreur();
        }

    }

//-------------------------------------------------------------------------------------------------------------------//

    // traitement de confirmation d'un courriel dans le but d'y extraire les commandes
    private static function req_creerUnProduit()
    {
        try
        {
            $oProduits = new Produits();
                       
            $resultat = $oProduits->creerUnProduit($_GET["statut"],
			$_GET["imageFacade"],$_GET["imageInterieur1"],
			$_GET["imageInterieur2"],$_GET["imageInterieur3"],$_GET["nom"],
			$_GET["emplacement"],$_GET["description"],$_GET["nombre_de_chambre"],
			$_GET["nombre_de_salle_de_bain"],$_GET["prix_par_semaine"]);
            VueProduits::formulaire_creerUnProduit($resultat);

            /*
            $resultat = $oProduits->creerUnProduit('actif',
            'facade','beau salon',
            'salle à manger','cuisine','Belle vue',
            'Chalet 1','Magnifique chalet rénové en 2010','2',
            '1','799');
            VueProduits::formulaire_creerUnProduit($resultat);*/

        }

        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_erreur();
        }

    }   

//-------------------------------------------------------------------------------------------------------------------//


    private static function req_modifierUnProduit()
    {
        try
        {
            $oProduits = new Produits();
                       
            /*$resultat = $oProduits->modifierUnProduit($_GET["statut"],
            $_GET["imageFacade"],$_GET["imageInterieur1"],
            $_GET["imageInterieur2"],$_GET["imageInterieur3"],$_GET["nom"],
            $_GET["emplacement"],$_GET["description"],$_GET["nombre_de_chambre"],
            $_GET["nombre_de_salle_de_bain"],$_GET["prix_par_jour"],$_GET["prix_par_semaine"]);
            VueProduits::formulaire_modifierUnProduit($resultat);*/

            $resultat = $oProduits->modifierUnProduit('actif',
            'facade','salon',
            'salle à manger','cuisine','Belle vue',
            'Chalet 1','Magnifique chalet rénové en 2010','2',
            '1','799');
            VueProduits::formulaire_modifierUnProduit($resultat);

        }

        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_erreur();
        }

    }

}

?>