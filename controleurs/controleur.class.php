<?php

class Controleur
{
    
// TODO LES MENU NE SONT PAS ÉGAUX EN HAUT QUAND ON NAVIGUE.... VOIR INFORMATIONS VERSUS ACCUEIL...

    // gestion des principales requêtes
    public static function gererRequetes()
    {
        $requete = $_GET["requete"];

        switch ($requete) 
        {
            ///////////////////////////
            // UTILISATEUR ////////////
            ///////////////////////////
            case 'login_html':
                self::req_login_html();
                break;
            case 'validerLogin':
                self::req_validerLogin();
                break;
            case 'inscription_html':
                self::req_inscription_html();
                break;  
            case 'validerInscription':
                self::req_validerInscription();
                break;  
            case 'profil_html':
                self::req_profil_html();
                break;  
            case 'deconnexion':
                self::req_deconnexion();
                break;  
            case 'nouveaupass_html':
                self::req_nouveaupass_html();
                break;  
            case 'validerNouveaupass':
                self::req_validerNouveaupass();
                break;  
            case 'req_majUtilisateur':
                self::req_majUtilisateur();
                break;
            ///////////////////////////
            // PRODUIT ////////////////
            ///////////////////////////
            case 'chalets_html':
                self::req_chalets();
                break;
            case 'selectionChalet_html':
                self::req_selectionChalet_html();
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
    private static function gererMenuPrincipal()
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

    // afficher formulaire login.html
    private static function req_login_html()
    {
        try
        {
            $message_erreur_login  = "";
            $prochaineRequete = 'validerLogin';
            self::gererMenuPrincipal();
            VueUtilisateurs::formulaire_login_html($prochaineRequete,$message_erreur_login);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            self::gererMenuPrincipal();
            VueMaitre::formulaire_erreur();
        }
    } 

    // valider le formulaire login.html
    private static function req_validerLogin()
    {       
        try
        {
            if ($_POST['courriel'] == "admin@admin.com" && $_POST['mot_de_passe'] == "admin")
            {
                self::gererMenuPrincipal();
                VueUtilisateurs::formulaire_se_diriger_vers_admin();
            }
            else
            {
                $message_erreur_login  = "";
                $oUtilisateurs = new Utilisateurs();
                $utilisateurs = $oUtilisateurs->chercherUtilisateur($_POST['courriel']);

                if ($utilisateurs["mot_de_passe"] != $_POST['mot_de_passe'])
                {
                    $message_erreur_login  = "Veuillez inscrire un courriel et un mot de passe valide pour vous connecter";
                    $prochaineRequete = 'validerLogin';
                    self::gererMenuPrincipal();
                    VueUtilisateurs::formulaire_login_html($prochaineRequete,$message_erreur_login);
                }
                else
                {
                    // utilisateur connecté
                    $_SESSION["courriel"] = $_POST['courriel'];
                    self::req_accueil();
                }
            }
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            self::gererMenuPrincipal();
            VueMaitre::formulaire_erreur();
        }
    } 

    // afficher formulaire inscription.html
    private static function req_inscription_html()
    {

//////////////// TODO VALIDER QUE L'UTILISATEUR N'EST PAS DÉJÀ LÀ
//////////////// TODO AFFICHER LES ERREUR VIA LE FORMULAIRE ET NON MESSAGE ERREUR

        try
        {
            $message_erreur_login  = "";
            $prochaineRequete = 'validerInscription';
            self::gererMenuPrincipal();
            VueUtilisateurs::formulaire_inscription_html($prochaineRequete,$message_erreur_login);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            self::gererMenuPrincipal();
            VueMaitre::formulaire_erreur();
        }
    } 

    // valider le formulaire inscription.html
    private static function req_validerInscription()
    {    
        try
        {
            $message_erreur_login  = "";
            $oUtilisateurs = new Utilisateurs();
            $oUtilisateurs->ajoutUtilisateur($_POST["nom"],$_POST["prenom"],$_POST["courriel"],$_POST["mot_de_passe"],$_POST["mot_de_passe2"],$_POST["date_de_naissance"]);
            // utilisateur connecté
            $_SESSION["courriel"] = $_POST['courriel'];
            self::req_accueil();
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            self::gererMenuPrincipal();
            VueMaitre::formulaire_erreur();
        }
    } 

    // extraire les information sur utilisateur connecté et afficher le tout dans profil.html
    private static function req_profil_html()
    {
        try
        {
            $oUtilisateurs = new Utilisateurs();
            $utilisateurs = $oUtilisateurs->extraireUtilisateur($_SESSION["courriel"]);      
            self::gererMenuPrincipal();
            VueUtilisateurs::formulaire_profil_html($utilisateurs);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            self::gererMenuPrincipal();
            VueMaitre::formulaire_erreur();
        }   
    }

    // déconnexion d'un utilisateur
    private static function req_deconnexion()
    {
        try
        {
            $_SESSION["courriel"] = "";
            self::req_accueil();
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            self::gererMenuPrincipal();
            VueMaitre::formulaire_erreur();
        }   
    }
    
    // afficher formulaire nouveaupass.html
    private static function req_nouveaupass_html()
    {
        try
        {
            self::gererMenuPrincipal();
            $prochaineRequete = 'validerNouveaupass';
            VueUtilisateurs::formulaire_nouveaupass_html($prochaineRequete,"");
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            self::gererMenuPrincipal();
            VueMaitre::formulaire_erreur();
        }   
    } 
    
    // valider le formulaire nouveaupass.html
    private static function req_validerNouveaupass()
    {
        try
        {
            self::gererMenuPrincipal();
            $prochaineRequete = 'accueil_html'; 
            VueUtilisateurs::formulaire_nouveaupass_html($prochaineRequete,"Votre nouveau mot de passe à été envoyé à votre courriel");
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            self::gererMenuPrincipal();
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

    /////////////////////////////////////////////////////////////////////////
    // PRODUIT //////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////

    // afficher formulaire chalets.html
    private static function req_chalets()
    {
        try
        {
            self::gererMenuPrincipal();
            VueProduits::formulaire_chalets("");
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            self::gererMenuPrincipal();
            VueMaitre::formulaire_erreur();
        }
    }

    // afficher formulaire selectionChalet.html
    private static function req_selectionChalet_html()
    {
        try
        {
            $oProduits = new Produits();
            $Produits = $oProduits->selectUnProduit($_GET["id_produit"]);
            self::gererMenuPrincipal();
            VueProduits::formulaire_selectionChalet($Produits);
        }
        catch(Exception $e)
        {
            $_GET['erreur']  = $e->getMessage();
            self::gererMenuPrincipal();
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
            self::gererMenuPrincipal();
            VueReservations::formulaire_reserver($produit);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'reserver_html';
            self::gererMenuPrincipal();
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
            self::gererMenuPrincipal();
            VueReservations::formulaire_confirmation($produit,$utilisateur,$_GET["date_debut"],$_GET["date_fin"],$_GET["numero_semaine"]);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'confirmation_html';
            self::gererMenuPrincipal();
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
            self::gererMenuPrincipal();
            VueReservations::formulaire_historique($reservations);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'historique_html';
            self::gererMenuPrincipal();
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
            self::gererMenuPrincipal();
            VueReservations::formulaire_reservations($reservations);
        }
        catch(Exception $e)
        {
            $_GET["erreur"]  = $e->getMessage();
            $_GET["requete"] = 'reservations_html';
            self::gererMenuPrincipal();
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
                self::gererMenuPrincipal();
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
            self::gererMenuPrincipal();
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
            self::gererMenuPrincipal();
            VueStatiques::afficherBanniereAccueil();
            VueStatiques::afficherContenuStatique($contenuStatique);
        }
        catch(Exception $e)
        {
            self::gererMenuPrincipal();
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

            $contenuStatiqueInformations = $oStatiques->getContenuStatique('Informations');
            $contenuStatiqueActivités = $oStatiques->getContenuStatique('Activités');
            $contenuStatiquePeche = $oStatiques->getContenuStatique('Pêche');
            $contenuStatiquePolitiqueQ = $oStatiques->getContenuStatique('Politique qualité');
            $contenuStatiquePolitiqueE = $oStatiques->getContenuStatique('Politique environnementale');

            self::gererMenuPrincipal();
            VueStatiques::afficherContenuStatique($contenuStatiqueInformations);
            VueStatiques::afficherContenuStatique($contenuStatiqueActivités);
            VueStatiques::afficherContenuStatique($contenuStatiquePeche);
            VueStatiques::afficherContenuStatique($contenuStatiquePolitiqueQ);
            VueStatiques::afficherContenuStatique($contenuStatiquePolitiqueE);
        }
        catch(Exception $e)
        {
            self::gererMenuPrincipal();
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
            self::gererMenuPrincipal();
            VueStatiques::afficherContenuStatique($contenuStatique);
            VueStatiques::afficherMap();
        }
        catch(Exception $e)
        {
            self::gererMenuPrincipal();
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