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
            $form .= '<p> prix_par_jour: ' . $produits[$i]["prix_par_jour"] . '</p>';
            $form .= '<p> prix_par_semaine: ' . $produits[$i]["prix_par_semaine"] . '</p>';
        }

        $form .= '<div class="erreur">';
        $form .= '<p>' . $_GET["erreur"] . '</p>';
        $form .= '</div>';
        $form .= '</form>';
        echo $form;
    }

    // function qui retourne le formulaire "passer une commande" à panier.html dans le cas d'une réussite
    public static function formulaire_selectUnProduit($produits)
    {

		$form = '';
        $form .= '<div class="container main">';
        $form .= '<section class="contenu-centre">';
        $form .= '<div class="row">';
        $form .= '<div class="col-lg-12">';
        $form .= '<img src="./images/carte2.jpg" alt="carte" border="0" usemap="#emplacement">';
        $form .= '<map name="emplacement">';
        $form .= '<area shape="rect" data-toggle="modal" data-target="#chaletModal" coords="268,334,309,375" href="#">';
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
        $form .= '<div class="container-main">';
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
        $form .= '<li class="list-group-item"><span class="badge pull-right">150$</span>Par journée:</li>';
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
    }


//----------------------------------------------------------------------------------------------------------------------------------//
    public static function formulaire_modifierProduit($produits)
    {

        $form = '';
        $form .= '<form id="formulaireModifierProduits">';
        $form .= '<h2>Produit sélectionné</h2>';

        for ($i = 0; $i < count($produits); $i++) 
        {
            

            /*$form .= '<p>Le statut : <input type="text" name="nom" /></p>';
            $form .= '<p>Image de la facade : <input type="file" name="facade" /></p>';
            $form .= '<p>Image intérieur 1 : <input type="file" name="interieur1" /></p>';
            $form .= '<p>Image intérieur 2 : <input type="file" name="interieur2" /></p>';
            $form .= '<p>Image intérieur 3 : <input type="file" name="interieur3" /></p>';
            /*$form .= '<p> statut: ' . $produits[$i]["statut"] . '</p>';
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
            $form .= '<p> prix_par_semaine: ' . $produits[$i]["prix_par_semaine"] . '</p>';*/
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