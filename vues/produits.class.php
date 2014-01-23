<?php
// ICI on met tout ce qui va être insérer dans les squelettes
// Je vous reviens là dessus

// function qui retourne le formulaire "passer une commande" à panier.html dans le cas d'une erreur
class VueProduits
{
    public static function formulaire_selectTousProduits($produits)
    {
        $form = '';
        $form .= '<form id="formulaireExtraireDesProduits">';
        $form .= '<h2>Liste des Produit(s)</h2>';

        for ($i = 0; $i < count($produits); $i++) 
        {
            $form .= '<p> id_produit: ' . $produits[$i]["id_produit"] . '</p>';
            $form .= '<p> statut: ' . $produits[$i]["statut"] . '</p>';
            $form .= '<p> imageFacade: ' . $produits[$i]["imageFacade"] . '</p>';
            $form .= '<p> imageInterieur1: ' . $produits[$i]["imageInterieur1"] . '</p>';
            $form .= '<p> imageInterieur2: ' . $produits[$i]["imageInterieur2"] . '</p>';
            $form .= '<p> imageInterieur3: ' . $produits[$i]["imageInterieur3"] . '</p>';
            $form .= '<p> nom: ' . $produits[$i]["nom"] . '</p>';
            $form .= '<p> emplacement: ' . $produits[$i]["emplacement"] . '</p>';
            $form .= '<p> description: ' . $produits[$i]["description"] . '</p>';
            $form .= '<p> nombre_de_chambre: ' . $produits[$i]["nombre_de_chambre"] . '</p>';
            $form .= '<p> nombre_de_salle_de_bain: ' . $produits[$i]["nombre_de_salle_de_bain"] . '</p>';
            $form .= '<p> prix_par_semaine: ' . $produits[$i]["prix_par_semaine"] . '</p>';
        }

        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';

        echo $form;
    }

    // fonction qui retourne une carte des chalets afin de les sélectionner
    public static function formulaire_chalets($produits)
    {
        $form = '';
        $form .= '<div class="container main">';
        $form .= '<section class="contenu-centre">';
        $form .= '<div class="row">';
        $form .= '<div class="carte">';
        $form .= '<a href="./index.php?requete=selectionChalet_html&id_produit=1">';
        $form .= '<img id="chalet1" src="./images/symbol-chalet.png" width="60" height="60" /></a>';
        $form .= '<a href="./index.php?requete=selectionChalet_html&id_produit=2">';
        $form .= '<img id="chalet2" src="./images/symbol-chalet.png" width="60" height="60" /></a>';
        $form .= '<a href="./index.php?requete=selectionChalet_html&id_produit=3">';
        $form .= '<img id="chalet3" src="./images/symbol-chalet.png" width="60" height="60" /></a>';
        $form .= '<div id="pop1" class="popover-chalet hidden"><div class="nom-chalet">'. $produits[0]["nom"] .'</div>';
        $form .= '<div class="vue-exterieur"><img src="' . $produits[0]["imageFacade"] . '" width="400" height="200" alt=""/></div></div>';
        $form .= '<div id="pop2" class="popover-chalet hidden"><div class="nom-chalet">'. $produits[1]["nom"] .'</div>';
        $form .= '<div class="vue-exterieur"><img src="' . $produits[1]["imageFacade"] . '" width="400" height="200" alt=""/></div></div>';
        $form .= '<div id="pop3" class="popover-chalet hidden"><div class="nom-chalet">'. $produits[2]["nom"] .'</div>';
        $form .= '<div class="vue-exterieur"><img src="' . $produits[2]["imageFacade"] . '" width="400" height="200" alt=""/></div></div>';
        $form .= '</a>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</section>';
        $form .= '</div>';

        echo $form;
    }
    
    // fonction qui retourne un chalet sélectionné sur la carte de la pourvoirie
    public static function formulaire_selectionChalet($produits)
    {

        $form = '';
        $form .= '<div class="container main">';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="GET">';
        $form .= '<div class="row">';

        if (empty($_SESSION["courriel"]))
        {
            $form .= '<div class="col-md-12 grostitres">';
            $form .= '<p>POUR RÉSERVER CONNECTEZ-VOUS!</p>';
            $form .= '</div>';
        }

        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p class="img-thumbnail">' . $produits["nom"] . '</p></h4>';
        $form .= '<img src="' . $produits["imageFacade"] . '" alt="chalet-accueil" class="img-thumbnail">';
        $form .= '<p>Magnifique chalet possédant une grande et large galerie, avec une vue magnifique sur le lac. La location du chalet peu se faire peu importe le mois durant l\'année. Construction de 2010</p>';
        $form .= '</div>';
        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p class="img-thumbnail"> Options du chalet : </p></h4>';
        $form .= '<ul class="list-group">';
        $form .= '<li class="list-group-item"><span class="badge pull-right">' . $produits["nombre_de_chambre"] . '</span>Nombre de chambre:</li>';
        $form .= '<li class="list-group-item"><span class="badge pull-right">' . $produits["nombre_de_salle_de_bain"] . '</span>Nombre de salle de bain:</li>';
        $form .= '</ul>';
        $form .= '</div>';
        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p class="img-thumbnail"> Prix de location : </p></h4>';
        $form .= '<ul class="list-group">';
        $form .= '<li class="list-group-item"><span class="badge pull-right">' . $produits["prix_par_semaine"] . '$</span>Par semaine:</li>';
        $form .= '</ul>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-4 col-lg-offset-8">';
        $form .= '<a class="btn btn-custom-gris btn-lg" href="./index.php?requete=chalets_html">Fermer</a>';  

        if (!empty($_SESSION["courriel"]))
        {
            $form .= '<button type="submit" class="btn btn-custom-vert btn-lg">Réserver</button><br/><br/>';
        }

        $form .= '</div>';
        $form .= '</div>';
        $form .= '<div class="col-lg-12">';
        $form .= '<div class="panel-group" id="accordion">';
        $form .= '<div class="panel panel-default">';
        $form .= '<div class="panel-heading">';
        $form .= '<h4 class="panel-title">';
        $form .= '<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">';
        $form .= '> Galerie photo';
        $form .= '</a>';
        $form .= '</h4>';
        $form .= '</div>';
        $form .= '<div id="collapseOne" class="panel-collapse collapse">';
        $form .= '<div class="panel-body">';
        $form .= '<img src="' . $produits["imageInterieur1"] . '" alt="chalet-accueil" class="img-thumbnail">';
        $form .= '<img src="' . $produits["imageInterieur2"] . '" alt="chalet-accueil" class="img-thumbnail">';
        $form .= '<img src="' . $produits["imageInterieur3"] . '" alt="chalet-accueil" class="img-thumbnail">';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</div>'; 
        $form .= '</div>';
        $form .= '</div>';
        $form .= '<input type="hidden" name="requete" value="reserver_html">';
        $form .= '<input type="hidden" name="id_produit" value="' . $produits["id_produit"] . '">';
        $form .= '<input type="hidden" name="id_utilisateur" value="1">';
        $form .= '</form>';
        $form .= '</div>';

        echo $form;
    }

    // fonction qui retourne un chalet dans le but de le modifier (section administrateur)
    public static function formulaire_editerChalet($tousProduits,$Produits)
    {
        $form = '';

        $form .= '<div class="container">';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-12">';
        $form .= '<h4><p class="img-thumbnail">Page administration des chalets :</p></h4>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p>Sélectionnez le chalet à modifier</p></h4>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-12">';
        $form .= '<select class="selectpicker" data-selected-text-format="count>2">';
        for ($i = 0; $i < count($tousProduits); $i++) 
        {
            $form .= '<option>' . $tousProduits[$i]["nom"] . '</option>';
        }
        $form .= '</select>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-6">';
        $form .= '<h4><p class="img-thumbnail">' . $Produits["emplacement"] . '</p></h4>';
        $form .= '<img src="' . $Produits["imageFacade"] . '" alt="photo exterieur chalet" class="img-thumbnail">';
        $form .= '<div class="form-group">';
        $form .= '<p><h4>URL de l\'image à modifier :<input type="text" value="' . $Produits["imageFacade"] . '"></h4></p>';
        $form .= '<p><h6>(Uniquement images au format jpg,gif ou png)</h6></p>';
        $form .= '<p><h4><p>Description :</h4>';
        $form .= '<textarea cols="45" rows="4">' . $Produits["description"] . '</textarea>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '<div class="col-lg-6">';
        $form .= '<h4><p class="img-thumbnail">Options du chalet :</p></h4>';
        $form .= '<li class="list-group-item"><label>Nombre de chambre:<input size="3" type="text" name="nombre_de_chambre" value="' . $Produits["nombre_de_chambre"] . '"></label></li>';
        $form .= '<hr>';
        $form .= '<li class="list-group-item"><label>Nombre de salle de bain:<input size="3" type="text" name="nombre_de_salle_de_bain" value="' . $Produits["nombre_de_salle_de_bain"] . '"></label></li>';
        $form .= '<hr>';
        $form .= '<li class="list-group-item"><label>Prix par semaine:<input size="10" type="text" name="prix_par_semaine" value="' . $Produits["prix_par_semaine"] . '"></label> $can</li>';
        $form .= '<br/>';
        $form .= '<a class="btn btn-custom-vert btn-lg" href="#">Publier</a>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</div>';

        echo $form;

    }

//----------------------------------------------------------------------------------------------------------------------//

            /*$form .= '<p> id_produit: ' . $produits[$i]["id_produit"] . '</p>';
                        $form .= '<p> statut: ' . $produits[$i]["statut"] . '</p>';
                        $form .= '<p> imageFacade: ' . $produits[$i]["imageFacade"] . '</p>';
                        $form .= '<p> imageInterieur1: ' . $produits[$i]["imageInterieur1"] . '</p>';
                        $form .= '<p> imageInterieur2: ' . $produits[$i]["imageInterieur2"] . '</p>';
                        $form .= '<p> imageInterieur3: ' . $produits[$i]["imageInterieur3"] . '</p>';
                        $form .= '<p> nom: ' . $produits[$i]["nom"] . '</p>';
                        $form .= '<p> emplacement: ' . $produits[$i]["emplacement"] . '</p>';
                        $form .= '<p> description: ' . $produits[$i]["description"] . '</p>';
                        $form .= '<p> nombre_de_chambre: ' . $produits[$i]["nombre_de_chambre"] . '</p>';
                        $form .= '<p> nombre_de_salle_de_bain: ' . $produits[$i]["nombre_de_salle_de_bain"] . '</p>';
                        $form .= '<p> prix_par_jour: ' . $produits[$i]["prix_par_jour"] . '</p>';
                        $form .= '<p> prix_par_semaine: ' . $produits[$i]["prix_par_semaine"] . '</p>';
                }

                $form .= '<div class="erreur">';
                $form .= '<p>' . $_GET["erreur"] . '</p>';
                $form .= '</div>';
                $form .= '</form>';
                echo $form;
                */
    
    public static function formulaire_modifierProduit($produits)
    {

        $form = '';
        $form .= '<form id="formulaireModifierProduits">';
        $form .= '<h2>Produit sélectionné</h2>';

        for ($i = 0; $i < count($produits); $i++) 
        {
            
            $form .= '<p> statut: ' . $produits[$i]["statut"] . '</p>';
            $form .= '<p> imageFacade: ' . $produits[$i]["imageFacade"] . '</p>';
            $form .= '<p> imageInterieur1: ' . $produits[$i]["imageInterieur1"] . '</p>';
            $form .= '<p> imageInterieur2: ' . $produits[$i]["imageInterieur2"] . '</p>';
            $form .= '<p> imageInterieur3: ' . $produits[$i]["imageInterieur3"] . '</p>';
            $form .= '<p> nom: ' . $produits[$i]["nom"] . '</p>';
            $form .= '<p> emplacement: ' . $produits[$i]["emplacement"] . '</p>';
            $form .= '<p> description: ' . $produits[$i]["description"] . '</p>';
            $form .= '<p> nombre_de_chambre: ' . $produits[$i]["nombre_de_chambre"] . '</p>';
            $form .= '<p> nombre_de_salle_de_bain: ' . $produits[$i]["nombre_de_salle_de_bain"] . '</p>';
            $form .= '<p> prix_par_semaine: ' . $produits[$i]["prix_par_semaine"] . '</p>';
        }

        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        echo $form;

    }

//-----------------------------------------------------------------------------------------------------------------------------------//
    // function qui retourne le formulaire "visualiser une Commande" à panier.html
    public static function formulaire_creerUnProduit($resultat)
    {
        $form = '';
        $form .= '<form id="formulaireCreerUnProduit">';
        $form .= '<h2>Créer un produit</h2>';
        $form .= '<p> resultat: ' . $resultat . '</p>';    
        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        echo $form;
    }
}

?>