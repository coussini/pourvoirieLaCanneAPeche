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

    // function qui retourne le formulaire "passer une commande" à panier.html dans le cas d'une réussite
    public static function formulaire_chalets($produits)
    {

		$form = '';
        $form .= '<div class="container main">';
        $form .= '<section class="contenu-centre">';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-12">';
        $form .= '<img src="./images/carte2.jpg" alt="carte" border="0" usemap="#emplacement">';
        $form .= '<map name="emplacement">';
        //$form .= '<a class="monPopover" data-toggle="popover" data-placement="top" data-trigger="hover" data-title="Design" data-content="test">';
        $form .= '<area shape="rect" coords="171,114,216,159" href="./index.php?requete=req_selectionChalet&id_produit=1" alt="chalet1">';
        //$form .= '</a>';
        $form .= '<area shape="rect" coords="138,206,183,251" href="./index.php?requete=req_selectionChalet&id_produit=2" alt="chalet2">';
        $form .= '<area shape="rect" coords="167,293,213,338" href="./index.php?requete=req_selectionChalet&id_produit=3" alt="chalet3">';
        $form .= '<area shape="rect" coords="258,339,299,380" href="./index.php?requete=req_selectionChalet&id_produit=1" alt="chalet4">';
        $form .= '<area shape="rect" coords="469,409,516,456" href="./index.php?requete=req_selectionChalet&id_produit=2" alt="chalet5">';
        $form .= '<area shape="rect" coords="678,298,723,343" href="./index.php?requete=req_selectionChalet&id_produit=3" alt="chalet6">';
        $form .= '<area shape="rect" coords="678,206,723,251" href="./index.php?requete=req_selectionChalet&id_produit=1" alt="chalet7">';
        $form .= '<area shape="rect" coords="691,68,735,112"  href="./index.php?requete=req_selectionChalet&id_produit=2" alt="chalet8">';
        $form .= '</map>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</section>';
        $form .= '</div>';
        echo $form;

        //------------------------------------------------------------------------------------------------------------//

    }
        public static function formulaire_selectionChalet($produits)
    {

        $form = '';
        $form .= '<div class="container main">';
        $form .= '<form role="form" action="' . $_SERVER['PHP_SELF'] . '" method="GET">';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p class="img-thumbnail">' . $produits[0]["nom"] . '</p></h4>';
        $form .= '<img src="' . $produits[0]["imageFacade"] . '" alt="chalet-accueil" class="img-thumbnail">';
        $form .= '<p>Magnifique chalet possédant une grande et large galerie, avec une vue magnifique sur le lac. La location du chalet peu se faire peu importe le mois durant l\'année. Construction de 2010</p>';
        $form .= '</div>';
        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p class="img-thumbnail"> Options du chalet : </p></h4>';
        $form .= '<ul class="list-group">';
        $form .= '<li class="list-group-item"><span class="badge pull-right">' . $produits[0]["nombre_de_chambre"] . '</span>Nombre de chambre:</li>';
        $form .= '<li class="list-group-item"><span class="badge pull-right">' . $produits[0]["nombre_de_salle_de_bain"] . '</span>Nombre de salle de bain:</li>';
        $form .= '</ul>';
        $form .= '</div>';
        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p class="img-thumbnail"> Prix de location : </p></h4>';
        $form .= '<ul class="list-group">';
        $form .= '<li class="list-group-item"><span class="badge pull-right">' . $produits[0]["prix_par_semaine"] . '$</span>Par semaine:</li>';
        $form .= '</ul>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-4 col-lg-offset-8">';
        $form .= '<a class="btn btn-custom-gris btn-lg" href="./index.php?requete=chalets_html">Fermer</a>';                  
        $form .= '<button type="submit" class="btn btn-custom-vert btn-lg">Réserver</button><br/><br/>';
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
        $form .= '<img src="' . $produits[0]["imageInterieur1"] . '" alt="chalet-accueil" class="img-thumbnail">';
        $form .= '<img src="' . $produits[0]["imageInterieur2"] . '" alt="chalet-accueil" class="img-thumbnail">';
        $form .= '<img src="' . $produits[0]["imageInterieur3"] . '" alt="chalet-accueil" class="img-thumbnail">';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</div>'; 
        $form .= '</div>';
        $form .= '</div>';
        $form .= '<input type="hidden" name="requete" value="reserver_html">';
        $form .= '<input type="hidden" name="id_produit" value="' . $produits[0]["id_produit"] . '">';
        // TODO ATTENTION LA VALEUR DOIT ÊTRE VALRIABLE
        $form .= '<input type="hidden" name="id_utilisateur" value="1">';
        $form .= '</form>';
        $form .= '</div>';

        echo $form;

    }

//----------------------------------------------------------------------------------------------------------------------//
    
        public static function formulaire_editerChalet()
    {

        $form = '';
        $form .= '<div class="container main">';
        $form .= '<section class="contenu-centre">';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-12">';
        $form .= '<h4>PANNEAU D\'ÉDITION :</h4>';
        $form .= '</div>';
        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p class="img-thumbnail"> Le chalet 1 : </p></h4>';
        $form .= '<img src="./images/chalet1.jpg" alt="chalet-accueil" class="img-thumbnail">';
        $form .= '<ul class="pagination">';
        $form .= '<li><a href="chalet1.html">1</a></li>';
        $form .= '<li><a href="chalet2.html">2</a></li>';
        $form .= '<li><a href="chalet3.html">3</a></li>';
        $form .= '<li><a href="#">4</a></li>';
        $form .= '<li><a href="#">5</a></li>';
        $form .= '<li><a href="#">6</a></li>';
        $form .= '<li><a href="#">7</a></li>';
        $form .= '<li><a href="#">8</a></li>';
        $form .= '</ul>';
        $form .= '<div class="form-group">';
        $form .= '<label for="exampleInputFile">Modifier l\'image</label>';
        $form .= '<input type="file" id="exampleInputFile">';
        $form .= '</div>';
        $form .= '<p>Description :<textarea rows="4" cols="50"></textarea></p>';
        $form .= '</div>';
        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p class="img-thumbnail">Options du chalet :</p></h4>';
        $form .= '<div class="col-lg-12">';
        $form .= '<ul class="list-group">';
        $form .= '<li class="list-group-item"><label>Nombre de chambre :</label></li>';
        $form .= '<li class="list-group-item"><label><input type="radio" name="lit" checked = "checked"> 1 </label>';
        $form .= '<label><input type="radio" name="lit"> 2 </label>';
        $form .= '<label><input type="radio" name="lit"> 3 </label>';
        $form .= '<label><input type="radio" name="lit"> 4 </label>';
        $form .= '<label><input type="radio" name="lit"> 5 </label>';
        $form .= '</li>';
        $form .= '</ul>';
        $form .= '<hr>';
        $form .= '<ul class="list-group">';
        $form .= '<li class="list-group-item"><label>Nombre de salle de bain :</label></li>';
        $form .= '<li class="list-group-item"><label>';
        $form .= '<input type="radio" checked = "checked" name="bain">1</label>';
        $form .= '<label><input type="radio" name="bain">2</label>';
        $form .= '</li>';
        $form .= '</ul>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '<div class="col-lg-3">';
        $form .= '<h4><p class="img-thumbnail">Prix de location :</p></h4>';
        $form .= '<ul class="list-group">';
        $form .= '<li class="list-group-item"><label>Par semaine : <br><input type="text" value="000.00">$</label></li>';
        $form .= '</ul>';
        $form .= '</div>';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-4 col-lg-offset-8">';
        $form .= '<p><a class="btn btn-custom-gris btn-lg" href="#">Réinitialiser</a><a class="btn btn-custom-vert btn-lg" href="#">Publier</a></p>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</section>';
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

//----------------------------------------------------------------------------------------------------------------------------------//
    
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

    public static function formulaire_erreur()
    {
        $form = '';
        $form .= '<form id="formulaire_erreur">';
        $form .= '<h2>formulaire_erreur</h2>';
        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        echo $form;
    }

}

?>