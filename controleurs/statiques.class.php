<?php

class Controleur
{

    public static function gererRequetes()
    {
        switch ($_GET['requete']) 
        {
            case 'chercherContenuStatique':
                self::req_chercherContenuStatique();
                break; 
            case 'formulaireModifierStatique':
                self::req_formulaireModifierStatique();
                break; 
            case 'modifierContenuStatique':
                self::req_modifierContenuStatique();
                break;
            case 'creerContenuStatique':  
                self::req_creerContenuStatique();
                break;
            default:
                self::req_formulaireModifierStatique(); // Premier affichage
                break; 
        }
    }

    // Générer le contenu statique  
    private static function req_chercherContenuStatique()
    {
        try
        {
            $oStatiques = new Statiques();

            $contenuStatique = $oStatiques->getContenuStatique($_POST['nom']);
     
            VueStatiques::afficherContenuStatique($contenuStatique);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueStatiques::formulaire_erreur();
        }
    }

    // Générer le formulaire de modification du contenu statique 
    private static function req_formulaireModifierStatique()
    {
        try
        {
            $oStatiques = new Statiques();

            $nomsStatique = $oStatiques->getNomsContenuStatique();    // Récupère tous les noms

            if ($_POST['nom'] == "")  // Si premier affichage de la page
            {
                $contenuStatique = $oStatiques->getContenuStatique($nomsStatique[0]);
                VueStatiques::formulaire_SelectionStatique($nomsStatique); 
                VueStatiques::formulaire_ModifierStatique($nomsStatique[0],$contenuStatique);
    
            } 
            else // Si contenu sélectionné
            {

            if ($_POST['nom'] == 'nouveauContenu') // Si select = nouveau contenu
            {
                self::req_formulaireCreerStatique();
            }
            else // Si select = contenu 
            {
                $contenuStatique = $oStatiques->getContenuStatique($_POST['nom']);
                VueStatiques::formulaire_SelectionStatique($nomsStatique,$_POST['nom']); // Param: Tous les noms, option sélectionnée
                VueStatiques::formulaire_ModifierStatique($_POST['nom'],$contenuStatique);
            }
            }
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueStatiques::formulaire_erreur();
        }
    }

    // Modifier le contenu statique   
    private static function req_modifierContenuStatique()
    {
        try
        {
            $oStatiques = new Statiques();
            $idStatique = $oStatiques->getidStatiqueByName($_POST['nom']); // Récupérer l'id d'un contenu par son nom
            //$nomsStatique = $oStatiques->updateContenuStatique($idStatique,$_POST['contenuStatique']);  // Modifier contenu statique
            $oStatiques->updateContenuStatique($idStatique,$_POST['contenuStatique']);  // Modifier contenu statique

            self::req_formulaireModifierStatique();
            
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueStatiques::formulaire_erreur();
        }
    }

    // Générer le formulaire de création du contenu statique   
    private static function req_formulaireCreerStatique()
    {
        try
        {
            $oStatiques = new Statiques();
            $nomsStatique = $oStatiques->getNomsContenuStatique();    // Récupère tous les noms
            VueStatiques::formulaire_SelectionStatique($nomsStatique); 
            VueStatiques::formulaire_formulaireCreerStatique();
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueStatiques::formulaire_erreur();
        }
    }

    // Créer le contenu statique   
    private static function req_creerContenuStatique()
    {
        try
        {
            $oStatiques = new Statiques();
            //$idStatique = $oStatiques->getidStatiqueByName($_POST['nom']); // Récupérer l'id d'un contenu par son nom
            //$nomsStatique = $oStatiques->updateContenuStatique($idStatique,$_POST['contenuStatique']);  // Modifier contenu statique
            $oStatiques->setContenuStatique('actif',$_POST['nom'],$_POST['contenu']);
            self::req_formulaireModifierStatique();
            
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueStatiques::formulaire_erreur();
        }
    }
 
}

?>