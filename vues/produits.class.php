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
        $form .= '<area shape="rect" coords="171,114,216,159" href="#" alt="chalet1">';
        $form .= '<area shape="rect" coords="138,206,183,251" href="#" alt="chalet2">';
        $form .= '<area shape="rect" coords="167,293,213,338" href="#" alt="chalet3">';
        $form .= '<area shape="rect" coords="258,339,299,380" href="#" alt="chalet4" href="afficher-chalet.html">';
        $form .= '<area shape="rect" coords="469,409,516,456" href="#" alt="chalet5">';
        $form .= '<area shape="rect" coords="678,298,723,343" href="#" alt="chalet6">';
        $form .= '<area shape="rect" coords="678,206,723,251" href="#" alt="chalet7">';
        $form .= '<area shape="rect" coords="691,68,735,112"  href="#" alt="chalet8">';
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
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p class="img-thumbnail"> Chalet 1 : </p></h4>';
        $form .= '<img src="./images/chalet1.jpg" alt="chalet-accueil" class="img-thumbnail">';
        $form .= '<p>Magnifique chalet possédant une grande et large galerie, avec une vue magnifique sur le lac. La location du chalet peu se faire peu importe le mois durant l\'année. Construction de 2010</p>';
        $form .= '</div>';
        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p class="img-thumbnail"> Options du chalet : </p></h4>';
        $form .= '<ul class="list-group">';
        $form .= '<li class="list-group-item"><span class="badge pull-right">2</span>Nombre de chambre:</li>';
        $form .= '<li class="list-group-item"><span class="badge pull-right">2</span>Nombre de salle de bain:</li>';
        $form .= '</ul>';
        $form .= '</div>';
        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p class="img-thumbnail"> Prix de location : </p></h4>';
        $form .= '<ul class="list-group">';
        $form .= '<li class="list-group-item"><span class="badge pull-right">899$</span>Par semaine:</li>';
        $form .= '</ul>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-4 col-lg-offset-8">';
        $form .= '<button type="button" class="btn btn-custom-gris btn-lg" data-dismiss="modal">Fermer</button>';
        $form .= '<button type="button" class="btn btn-custom-vert btn-lg" onclick="traiteConnexion("./reserver.html")">Réserver</button><br/><br/>';
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
        $form .= '<img src="./images/chalet1-photo1.jpg" alt="chalet-accueil" class="img-thumbnail">';
        $form .= '<img src="./images/chalet1-photo2.jpg" alt="chalet-accueil" class="img-thumbnail">';
        $form .= '<img src="./images/chalet1-photo3.jpg" alt="chalet-accueil" class="img-thumbnail">';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</div>'; 
        $form .= '</div>';
        $form .= '</div>';
        $form .= '</div>';

        echo $form;

    }

//----------------------------------------------------------------------------------------------------------------------//
    
        public static function formulaire_editerChalet($produits)
    {

        $form .= '';
        $form .= '<div class="container main">';
        $form .= '<section class="contenu-centre">';  
        $form .= '<div class="row">';  
        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p class="img-thumbnail"> Le chalet 1 : </p></h4>';
        $form .= '<img src="images/chalet1.jpg" alt="chalet-accueil" class="img-thumbnail">';    
        $form .= '<ul class="pagination">';
        $form .= '<li><a href="chalet1.html" id="chalet1">1</a></li>';
        $form .= '<li><a href="chalet2.html" id="chalet2">2</a></li>';
        $form .= '<li><a href="chalet3.html" id="chalet3">3</a></li>';
        $form .= '<li><a href="#">4</a></li>';
        $form .= '<li><a href="#">5</a></li>';
        $form .= '<li><a href="#">6</a></li>';
        $form .= '<li><a href="#">7</a></li>';
        $form .= '<li><a href="#">8</a></li>';
        $form .= '</ul>';
        $form .= '<div class="form-group">';
        $form .= '<label for="exampleInputFile">Modifier l\'image</label>';
        $form .= '<input type="file" id="imageTelecharge">';
        $form .= '</div>';
        $form .= '<p>Description :<textarea rows="4" cols="50" id="description"></textarea></p>';
        $form .= '</div>';
        $form .= '<div class="col-lg-4">';
        $form .= '<h4><p class="img-thumbnail">Options du chalet :</p></h4>';
        $form .= '<div class="col-lg-12">';
        $form .= '<ul class="list-group">';
        $form .= '<li class="list-group-item"><label>Nombre de chambre :</label></li>';
        $form .= '<li class="list-group-item"><label><input type="radio" name="chambre" checked = "checked" value="1"> 1 </label>';
        $form .= '<label><input type="radio" name="chambre" value="2"> 2 </label>';
        $form .= '<label><input type="radio" name="chambre" value="3"> 3 </label>';
        $form .= '<label><input type="radio" name="chambre" value="4"> 4 </label>';
        $form .= '<label><input type="radio" name="chambre" value="5"> 5 </label>';
        $form .= '</li>';
        $form .= '</ul>';
        $form .= '<hr>';
        $form .= '<ul class="list-group">';
        $form .= '<li class="list-group-item"><label>Nombre de salle de bain :</label></li>';
        $form .= '<li class="list-group-item"><label>';
        $form .= '<input type="radio" checked = "checked" name="bain" value="1">1</label>';
        $form .= '<label><input type="radio" name="bain" value="2">2</label>';
        $form .= '</li>';
        $form .= '</ul>';
        $form .= '</div>';
        $form .= '</div>';
        $form .= '<div class="col-lg-3">';
        $form .= '<h4><p class="img-thumbnail">Prix de location :</p></h4>';
        $form .= '<ul class="list-group">';
        $form .= '<li class="list-group-item"><label>Par semaine : <br><input type="text" id="prixLocation" value="000.00">$can</label></li>';
        $form .= '</ul>';
        $form .= '</div>';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-4 col-lg-offset-8">';
        $form .= '<p><a class="btn btn-custom-gris btn-lg" href="#">Réinitialiser</a><a class="btn btn-custom-vert btn-lg" method="post" type="submit" href="#">Publier</a></p>';
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