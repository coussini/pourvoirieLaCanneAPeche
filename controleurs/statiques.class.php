<?php

class Controleur
{

    public static function gererRequetes()
    {
        switch ($_GET['requete']) 
        {
            // Pages statiques section client:
            case 'accueil_html':
                self::req_accueil();
                break; 
            case 'informations_html':
                self::req_informations();
                break; 
            case 'contact_html':
                self::req_contact();
                break;
            // Page statique section admin:
            case 'elements_statique_html':
                self::req_elements_statique();
                break; 
            // Fonctions section admin
            case 'modifierContenuStatique':
                self::req_modifierContenuStatique();
                break;
            case 'creerContenuStatique':  
                self::req_creerContenuStatique();
                break;
            default:
                break; 
        }
    }

    // Générer accueil.html
    private static function req_accueil()
    {
        try
        {
            $oStatiques = new Statiques();

            $contenuStatique = $oStatiques->getContenuStatique('À propos');
     
            VueStatiques::afficherContenuStatique($contenuStatique);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueStatiques::formulaire_erreur();
        }
    }

    // Générer informations.html  
    private static function req_informations()
    {
        try
        {
            $oStatiques = new Statiques();

            $contenuStatique = $oStatiques->getContenuStatique('Informations');
     
            VueStatiques::afficherContenuStatique($contenuStatique);

            $contenuStatique = $oStatiques->getContenuStatique('Activités');
     
            VueStatiques::afficherContenuStatique($contenuStatique);

            $contenuStatique = $oStatiques->getContenuStatique('Pêche');
     
            VueStatiques::afficherContenuStatique($contenuStatique);

            $contenuStatique = $oStatiques->getContenuStatique('Politique qualité');
     
            VueStatiques::afficherContenuStatique($contenuStatique);

            $contenuStatique = $oStatiques->getContenuStatique('Politique environnementale');
     
            VueStatiques::afficherContenuStatique($contenuStatique);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueStatiques::formulaire_erreur();
        }
    }

    // Générer contact.html  
    private static function req_contact()
    {
        try
        {
            $oStatiques = new Statiques();

            $contenuStatique = $oStatiques->getContenuStatique('Contact');
     
            VueStatiques::afficherContenuStatique($contenuStatique);

            VueStatiques::afficherMap();

        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueStatiques::formulaire_erreur();
        }
    }

    // Générer le formulaire de modification du contenu statique 
    private static function req_elements_statique()
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
                VueStatiques::formulaire_SelectionStatique($nomsStatique); // Param: Tous les noms, option sélectionnée
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
            $oStatiques->updateContenuStatique($idStatique,$_POST['contenu']);  // Modifier contenu statique
            $nomsStatique = $oStatiques->getNomsContenuStatique();
            $contenuStatique = $oStatiques->getContenuStatique($_POST['nom']);
            VueStatiques::formulaire_SelectionStatique($nomsStatique); // Param: Tous les noms, option sélectionnée
            VueStatiques::formulaire_ModifierStatique($_POST['nom'],$contenuStatique);
            
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
            $oStatiques->setContenuStatique('actif',$_POST['nom'],$_POST['contenu']);
            $nomsStatique = $oStatiques->getNomsContenuStatique();
            $contenuStatique = $oStatiques->getContenuStatique($nomsStatique[0]);
            VueStatiques::formulaire_SelectionStatique($nomsStatique); // Param: Tous les noms, option sélectionnée
            VueStatiques::formulaire_ModifierStatique($nomsStatique[0],$contenuStatique);
            
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueStatiques::formulaire_erreur();
        }
    }
 
}

?>