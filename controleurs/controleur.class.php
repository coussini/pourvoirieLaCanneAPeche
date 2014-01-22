<?php

class Controleur
{
    // gestion des principales requêtes
    public static function gererRequetes()
    {
        $requete = $_GET["requete"];

        switch ($requete) 
        {
            ///////////////////////////
            // UTILISATEUR ////////////
            ///////////////////////////
            case 'req_loginUtilisateur':
                self::req_loginUtilisateur();
                break;
            case 'req_extraireUtilisateur':
                self::req_extraireUtilisateur();
                break;  
            case 'req_majUtilisateur':
                self::req_majUtilisateur();
                break;
            case 'req_ajoutUtilisateur':
                self::req_ajoutUtilisateur();
                break;  
            case 'req_oubliePass':
                self::req_oubliePass();
                break;  
            case 'req_messageOubliePass':
                self::req_messageOubliePass();
                break;  
            ///////////////////////////
            // PRODUIT ////////////////
            ///////////////////////////
            case 'chalets_html':
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
                break;  
            ///////////////////////////
            // RÉSERVATION ////////////
            ///////////////////////////
            case 'reserver_html':
                self::req_reserver();
                break;        
            case 'confirmation_html':
                self::req_confirmation();
                break;        
            case 'creer_une_reservation':
                self::req_creerUneReservation();
                break;        
            case 'historique_html':
                self::req_historique();
                break;        
            case 'reservations_html':
                self::req_reservations();
                break;  
            ///////////////////////////
            // STATIQUE ///////////////
            ///////////////////////////
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
                self::req_accueil(); // générée par la page admin et le module statiques
                break;
        }
    }

    //////////////////////////////////////////////////////////////////////
    // AJAX //////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////
    //                  
    // gestion des requête AJAX
    // la requête AJAX permet de trouver, grâce à l'id_produit, les dates réservé pour ce dernier
    // afin de préparer, par la suite, les dates de non disponibilité pour le calendrier via jquery
    public static function gererAjax($requeteAJAX,$id_produit)
    {
        try
        {
            if ($_GET["requeteAJAX"] == "req_chercher_dates_reservees")
            {
                self::req_chercher_dates_reservees($id_produit);
            }
            else
            {
                throw new Exception("requete AJAX invalide");
            }
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueMaitre::formulaire_erreur();
        }
    }

    //////////////////////////////////////////////////////////////////////
    // MENU PRINCIPAL ////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////
    //
    // gestion du menu principal
    public static function gererMenuPrincipal()
    {
        $requete = $_GET["requete"];

        $accueil = ""; 
        $chalets = "";
        $informations = "";
        $contact = "";

        switch ($requete) 
        {
            ///////////////////////////
            // PRODUIT ////////////////
            ///////////////////////////
            case 'chalets_html':
                $chalets = "active";
                VueMaitre::formulaire_menu_principal($accueil,$chalets,$informations,$contact);
                break;
            ///////////////////////////
            // STATIQUE ///////////////
            ///////////////////////////
            case 'accueil_html':
                $accueil = "active";
                VueMaitre::formulaire_menu_principal($accueil,$chalets,$informations,$contact);
                break; 
            case 'informations_html':
                $informations = "active";
                VueMaitre::formulaire_menu_principal($accueil,$chalets,$informations,$contact);
                break; 
            case 'contact_html':
                $contact = "active";
                VueMaitre::formulaire_menu_principal($accueil,$chalets,$informations,$contact);
                break;
            default:
                $accueil = "active";
                VueMaitre::formulaire_menu_principal($accueil,$chalets,$informations,$contact);
                break; 
        }
    } 

    /////////////////////////////////////////////////////////////////////////
    // UTILISATEUR //////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////

    // traitement formulaire login
    private static function req_loginUtilisateur()
    {
        try
        {
            $oUtilisateurs = new Utilisateurs();
            VueUtilisateurs::formulaire_loginUtilisateur();
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueMaitre::formulaire_erreur();
        }
    } 

    // traitement formulaire login
    private static function req_valideLogin()
    {       
        try
        {
            $oUtilisateurs = new Utilisateurs();
            $utilisateurs = $oUtilisateurs->chercherUtilisateur($_POST['courriel']);
            // TODO METTRE ENCRYPTION DU MOT DE PASSE
            // PENSER À UNE VARIABLE DE SESSION OU WEBSTORAGE
            if ($utilisateurs["mot_de_passe"] != $_POST['mot_de_passe'])
            {
                VueUtilisateurs::formulaire_validLogin($utilisateurs);
            }
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueMaitre::formulaire_erreur();
        }
    } 

    // extraire les information sur utilisateur
    private static function req_extraireUtilisateur()
    {
        try
        {
            $oUtilisateurs = new Utilisateurs();
            $utilisateurs = $oUtilisateurs->extraireUtilisateur($_GET["courriel"]);//fonction extraireUtilisateur       
            VueUtilisateurs::formulaire_extraireUtilisateur($utilisateurs);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueMaitre::formulaire_erreur();
        }   
    }
    
    // MAJ les information sur utilisateur
    private static function req_majUtilisateur()
    {
        try
        {
            $oUtilisateurs = new Utilisateurs();                                
            $utilisateurs = $oUtilisateurs->majUtilisateur($_GET["courriel"]); //fonction majUtilisateur
            VueUtilisateurs::formulaire_majUtilisateur();
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueMaitre::formulaire_erreur();
        }   
    } 

    // ajouter les information sur utilisateur
    private static function req_ajoutUtilisateur()
    {
        try
        {
            //$oUtilisateurs = new Utilisateurs();
            //$utilisateursnew = $oUtilisateurs->ajoutUtilisateur($_POST["nom"],$_POST["prenom"],$_POST["courriel"], $_POST["mot_de_passe"],$_POST["date_de_naissance"]);
            //TODO : Qu'est-ce que fais apres...
            VueUtilisateurs::formulaire_ajoutUtilisateur();
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueMaitre::formulaire_erreur();
        }   
    } 
    
    // extraire les information sur utilisateur
    private static function req_oubliePass()
    {
        try
        {
            $oUtilisateurs = new Utilisateurs();                        
            VueUtilisateurs::formulaire_oubliePass();
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueMaitre::formulaire_erreur();
        }   
    } 
    
    // extraire les information sur utilisateur
    private static function req_messageOubliePass()
    {
        try
        {
            $oUtilisateurs = new Utilisateurs();                        
            VueUtilisateurs::formulaire_messageOubliePass();
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueMaitre::formulaire_erreur();
        }   
    } 

    /////////////////////////////////////////////////////////////////////////
    // PRODUIT //////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////

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
            VueMaitre::formulaire_erreur();
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
            VueMaitre::formulaire_erreur();
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
            VueMaitre::formulaire_erreur();
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
            VueMaitre::formulaire_erreur();
        }
    }

    // traitement d'édition d'un chalet
    private static function req_editerChalet()
    {
        try
        {
            //$oProduits = new Produits();
            //$Produits = $oProduits->selectUnProduit('1');
            //VueProduits::formulaire_editerChalet($Produits);
            VueProduits::formulaire_editerChalet();
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueMaitre::formulaire_erreur();
        }
    }

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
            VueMaitre::formulaire_erreur();
        }
    }   

    // traitement de modification d'un produit
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
            VueMaitre::formulaire_erreur();
        }
    }

    /////////////////////////////////////////////////////////////////////////
    // RÉSERVATION //////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////

    // extraire les données pour générer le calendrier de réservation
    private static function req_chercher_dates_reservees($id_produit)
    {
        try
        {
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireLesReservationPourCeProduit($id_produit);
            VueReservations::formulaire_chercher_dates_reservees($reservations);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            VueMaitre::formulaire_erreur();
        }
    }
    
    // extraire les données pour générer la page reserver.html
    private static function req_reserver()
    {
        try
        {
            $oReservations = new Reservations();
            $produit = $oReservations->extraireLeProduit($_GET["id_produit"]);
            $_GET["requete"] = 'confirmation_html';
            VueReservations::formulaire_reserver($produit);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'reserver_html';
            VueReservations::formulaire_reserver("");
        }
    }
    
    // extraire les données pour générer la page confirmation.html
    private static function req_confirmation()
    {
        try
        {
            $oReservations = new Reservations();
            $produit = $oReservations->extraireLeProduit($_GET["id_produit"]); // les tests ont été fait par req_reserver
            $utilisateur = $oReservations->extraireUtilisateur($_GET["id_utilisateur"]);
            $_GET["requete"] = 'creer_une_reservation';
            VueReservations::formulaire_confirmation($produit,$utilisateur,$_GET["date_debut"],$_GET["date_fin"],$_GET["numero_semaine"]);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'confirmation_html';
            VueReservations::formulaire_confirmation("","","","","");
        }
    }
    
    // extraire les données pour générer la page historique.html
    private static function req_historique()
    {
        try
        {
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireLesReservationsUtilisateur($_GET["id_utilisateur"]);
            $_GET["requete"] = 'historique_html';
            VueReservations::formulaire_historique($reservations);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'historique_html';
            VueReservations::formulaire_historique("");
        }
    }
    
    // extraire les données pour générer la page reservations.html
    private static function req_reservations()
    {
        try
        {
            $oReservations = new Reservations();
            $reservations = $oReservations->extraireLesReservations();
            $_GET["requete"] = 'reservations_html';
            VueReservations::formulaire_reservations($reservations);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'reservations_html';
            VueReservations::formulaire_reservations("");
        }
    }

    // traitement de confirmation d'une réservation
    private static function req_creerUneReservation()
    {
        try
        {
            $oReservations = new Reservations();    
            $resultat = $oReservations->creerUneReservation($_GET["id_utilisateur"],$_GET["id_produit"],$_GET["date_debut"],$_GET["date_fin"],$_GET["numero_semaine"],$_GET["nom_carte"],$_GET["numero_carte"],$_GET["id_carte"],$_GET["prix_a_la_reservation"]);
            if ($resultat)
            {
                $produit = $oReservations->extraireLeProduit($_GET["id_produit"]); // les tests ont été fait par req_reserver
                $utilisateur = $oReservations->extraireUtilisateur($_GET["id_utilisateur"]);
                $_GET["requete"] = 'creer_une_reservation';
                $_GET["message_confirmation"]  = "merci d'avoir effectué votre réservation";
                VueReservations::formulaire_creerUneReservation($produit,$utilisateur,$_GET["date_debut"],$_GET["date_fin"],$_GET["numero_semaine"],$_GET["nom_carte"],$_GET["numero_carte"],$_GET["id_carte"],$_GET["prix_a_la_reservation"]);
            }
        }
        catch(Exception $e)
        {
            $oReservations = new Reservations();    
            $produit = $oReservations->extraireLeProduit($_GET["id_produit"]); // les tests ont été fait par req_reserver
            $utilisateur = $oReservations->extraireUtilisateur($_GET["id_utilisateur"]);
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'creer_une_reservation';
            VueReservations::formulaire_creerUneReservation($produit,$utilisateur,$_GET["date_debut"],$_GET["date_fin"],$_GET["numero_semaine"],$_GET["nom_carte"],$_GET["numero_carte"],$_GET["id_carte"],$_GET["prix_a_la_reservation"]);
        }
    }

    /////////////////////////////////////////////////////////////////////////
    // STATIQUE /////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////

    // Générer accueil.html
    private static function req_accueil()
    {
        try
        {
            $oStatiques = new Statiques();
            $contenuStatique = $oStatiques->getContenuStatique('À propos');
            VueStatiques::afficherBanniereAccueil();
            VueStatiques::afficherContenuStatique($contenuStatique);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            VueMaitre::formulaire_erreur();
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
            VueMaitre::formulaire_erreur();
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
            VueMaitre::formulaire_erreur();
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
            VueMaitre::formulaire_erreur();
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
            VueMaitre::formulaire_erreur();
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
            VueMaitre::formulaire_erreur();
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
            VueMaitre::formulaire_erreur();
        }
    }
}
?>