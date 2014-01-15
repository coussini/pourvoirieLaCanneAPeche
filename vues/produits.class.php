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
		$form .= '<form id="formulaireExtraireDesProduits">';
		$form .= '<h2>Produit sélectionné</h2>';

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