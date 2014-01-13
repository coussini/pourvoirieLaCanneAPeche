<?php

class Controleur
{
    public static function gererRequetes()
    {
		//$_GET['requete'] = 'req_selectTousProduits';
		//$_GET['requete'] = 'req_selectUnProduit';
		$_GET['requete'] = 'req_creerUnProduit';
		
        switch ($_GET['requete']) 
        {
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
                //req_modifierUnProduit();
                break;        
            default:
                // erreur
                break;
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

        /*
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_selectTousProduits("");
        }*/

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
            $Produits = $oProduits->selectUnProduit(1);
			
            VueProduits::formulaire_selectUnProduit($Produits);
        }
        
        /*
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_selectUnProduit("");
        }*/

        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_erreur();
        }


    }

    // traitement de confirmation d'un courriel dans le but d'y extraire les commandes
    private static function req_creerUnProduit()
    {
        try
        {
            $oProduits = new Produits();            
            /*$resultat = $oProduits->creerUnProduit($_GET["id_produit"],$_GET["statut"],
			$_GET["imageFacade"],$_GET["imageInterieur1"],
			$_GET["imageInterieur2"],$_GET["imageInterieur3"],$_GET["nom"],
			$_GET["emplacement"],$_GET["description"],$_GET["nombre_de_chambre"],
			$_GET["nombre_de_salle_de_bain"],$_GET["prix_par_jour"],$_GET["prix_par_semaine"]);
            VueProduits::formulaire_creerUnProduit($resultat);*/

            $resultat = $oProduits->creerUnProduit('1','actif',
            'facade','salon',
            'salle à manger','cuisine','belle vue',
            'Chalet 1','Magnifique chalet rénové en 2010, grande galerie, vous tomberez sous le charme','2',
            '1','100,99 $can','799,99 $can');
            VueProduits::formulaire_creerUnProduit($resultat);

        }

        /*
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_creerUnProduit("");
        }*/

        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueProduits::formulaire_erreur();
        }

    }    
}

?>