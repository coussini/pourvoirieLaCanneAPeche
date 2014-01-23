<?php
// public function SQL qui permet de vérifier si un utilisateur (son courriel) est présent
// RETOURNE 0 si le courriel n'est pas trouvé

class Produits
{
    private $connexionBD;

    public function __construct()
    {
        $oConnexionPDO = new ConnexionPDO("canneapeche","UTF8");
        $this->connexionBD = $oConnexionPDO->rConnexion;
    }

    public function selectTousProduits()
    {

        $produits = array();
    	
        $id = $this->connexionBD;

        $requete = $id->prepare("SELECT id_produit,
    									statut,
    									imageFacade,
										imageInterieur1,
										imageInterieur2,
										imageInterieur3,
    									nom,
    									emplacement,
    									description,
    									nombre_de_chambre,
    									nombre_de_salle_de_bain,
    									prix_par_semaine
                                 FROM produits");
        $requete->execute();
    	
        $requete->bindColumn('id_produit',$id_produit);
    	$requete->bindColumn('statut',$statut);
    	$requete->bindColumn('imageFacade',$imageFacade);
		$requete->bindColumn('imageInterieur1',$imageInterieur1);
		$requete->bindColumn('imageInterieur2',$imageInterieur2);
		$requete->bindColumn('imageInterieur3',$imageInterieur3);
    	$requete->bindColumn('nom',$nom);
    	$requete->bindColumn('emplacement',$emplacement);
        $requete->bindColumn('description',$description);
    	$requete->bindColumn('nombre_de_chambre',$nombre_de_chambre);
    	$requete->bindColumn('nombre_de_salle_de_bain',$nombre_de_salle_de_bain);
    	$requete->bindColumn('prix_par_semaine',$prix_par_semaine);
    	
        $i = 0;
        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $produits[$i]["id_produit"] = $id_produit;
            $produits[$i]["statut"] = $statut;
    		$produits[$i]["imageFacade"] = $imageFacade;
    		$produits[$i]["imageInterieur1"] = $imageInterieur1;
    		$produits[$i]["imageInterieur2"] = $imageInterieur2;
    		$produits[$i]["imageInterieur3"] = $imageInterieur3;
            $produits[$i]["nom"] = $nom;
    		$produits[$i]["emplacement"] = $emplacement;
    		$produits[$i]["description"] = $description;
    		$produits[$i]["nombre_de_chambre"] = $nombre_de_chambre;
    		$produits[$i]["nombre_de_salle_de_bain"] = $nombre_de_salle_de_bain;
    		$produits[$i]["prix_par_semaine"] = $prix_par_semaine;
    		
            $i++;
        }

        $requete->closeCursor();
        $id=null;

        return $produits;
    }

    public function selectUnProduit($id_produit)
    {
        $produits = array();
    	
        $id = $this->connexionBD;

        $requete = $id->prepare("SELECT id_produit,
    									statut,
    									imageFacade,
										imageInterieur1,
										imageInterieur2,
										imageInterieur3,
    									nom,
    									emplacement,
    									description,
    									nombre_de_chambre,
    									nombre_de_salle_de_bain,
    									prix_par_semaine
                                  FROM  produits
    							  WHERE id_produit = :id_produit");
    							  
    	$requete->bindParam(':id_produit',$id_produit,PDO::PARAM_INT);
    							  
        $requete->execute();
    	
        $requete->bindColumn('id_produit',$id_produit);
    	$requete->bindColumn('statut',$statut);
    	$requete->bindColumn('imageFacade',$imageFacade);
		$requete->bindColumn('imageInterieur1',$imageInterieur1);
		$requete->bindColumn('imageInterieur2',$imageInterieur2);
		$requete->bindColumn('imageInterieur3',$imageInterieur3);
    	$requete->bindColumn('nom',$nom);
    	$requete->bindColumn('emplacement',$emplacement);
        $requete->bindColumn('description',$description);
    	$requete->bindColumn('nombre_de_chambre',$nombre_de_chambre);
    	$requete->bindColumn('nombre_de_salle_de_bain',$nombre_de_salle_de_bain);
    	$requete->bindColumn('prix_par_semaine',$prix_par_semaine);
    	
        $resultat = $requete->fetchColumn(PDO::FETCH_BOUND);

        if ($requete->rowCount() > 0)
        {
            $produits["id_produit"] = $id_produit;
            $produits["statut"] = $statut;
            $produits["imageFacade"] = $imageFacade;
            $produits["imageInterieur1"] = $imageInterieur1;
            $produits["imageInterieur2"] = $imageInterieur2;
            $produits["imageInterieur3"] = $imageInterieur3;
            $produits["nom"] = $nom;
            $produits["emplacement"] = $emplacement;
            $produits["description"] = $description;
            $produits["nombre_de_chambre"] = $nombre_de_chambre;
            $produits["nombre_de_salle_de_bain"] = $nombre_de_salle_de_bain;
            $produits["prix_par_semaine"] = $prix_par_semaine;
        }
        else
        {
            $produits["id_produit"] = "";
            $produits["statut"] = "";
            $produits["imageFacade"] = "";
            $produits["imageInterieur1"] = "";
            $produits["imageInterieur2"] = "";
            $produits["imageInterieur3"] = "";
            $produits["nom"] = "";
            $produits["emplacement"] = "";
            $produits["description"] = "";
            $produits["nombre_de_chambre"] = "";
            $produits["nombre_de_salle_de_bain"] = "";
            $produits["prix_par_semaine"] = "";
        }

        $requete->closeCursor();
        $id=null;

        return $produits;
    }

    //-------------------------------------------------------------------------------------------------------//

        public function selectionChalet($id_produit)
    {
        $produits = array();
        
        $id = $this->connexionBD;

        $requete = $id->prepare("SELECT id_produit,
                                        statut,
                                        imageFacade,
                                        imageInterieur1,
                                        imageInterieur2,
                                        imageInterieur3,
                                        nom,
                                        emplacement,
                                        description,
                                        nombre_de_chambre,
                                        nombre_de_salle_de_bain,
                                        prix_par_semaine
                                  FROM  produits
                                  WHERE id_produit = :id_produit");
                                  
        $requete->bindParam(':id_produit',$id_produit,PDO::PARAM_INT);
                                  
        $requete->execute();
        
        $requete->bindColumn('id_produit',$id_produit);
        $requete->bindColumn('statut',$statut);
        $requete->bindColumn('imageFacade',$imageFacade);
        $requete->bindColumn('imageInterieur1',$imageInterieur1);
        $requete->bindColumn('imageInterieur2',$imageInterieur2);
        $requete->bindColumn('imageInterieur3',$imageInterieur3);
        $requete->bindColumn('nom',$nom);
        $requete->bindColumn('emplacement',$emplacement);
        $requete->bindColumn('description',$description);
        $requete->bindColumn('nombre_de_chambre',$nombre_de_chambre);
        $requete->bindColumn('nombre_de_salle_de_bain',$nombre_de_salle_de_bain);
        $requete->bindColumn('prix_par_semaine',$prix_par_semaine);
        
        $i = 0;
        while ($resultat = $requete->fetch(PDO::FETCH_BOUND))
        {
            $produits[$i]["id_produit"] = $id_produit;
            $produits[$i]["statut"] = $statut;
            $produits[$i]["imageFacade"] = $imageFacade;
            $produits[$i]["imageInterieur1"] = $imageInterieur1;
            $produits[$i]["imageInterieur2"] = $imageInterieur2;
            $produits[$i]["imageInterieur3"] = $imageInterieur3;
            $produits[$i]["nom"] = $nom;
            $produits[$i]["emplacement"] = $emplacement;
            $produits[$i]["description"] = $description;
            $produits[$i]["nombre_de_chambre"] = $nombre_de_chambre;
            $produits[$i]["nombre_de_salle_de_bain"] = $nombre_de_salle_de_bain;
            $produits[$i]["prix_par_semaine"] = $prix_par_semaine;
            
            $i++;
        }

        $requete->closeCursor();
        $id=null;

        return $produits;
    }



    // -----------------------------------------------------------------------------------------------------//

    public function creerUnProduit($statut,$imageFacade,$imageInterieur1,$imageInterieur2,
                                    $imageInterieur3,$nom,$emplacement,$description,$nombre_de_chambre,
                                    $nombre_de_salle_de_bain,$prix_par_semaine)
    {

        if ($statut == "")
        {
            throw new Exception("Statut invalide");
        }
    	
    	else if ($imageFacade == "")
        {
            throw new Exception("Image de la facade invalide");
        }
		
		else if ($imageInterieur1 == "")
        {
            throw new Exception("Image interieur1 invalide");
        }
		
		else if ($imageInterieur2 == "")
        {
            throw new Exception("Image interieur2 invalide");
        }
		
		else if ($imageInterieur3 == "")
        {
            throw new Exception("Image interieur3 invalide");
        }
    	
        else if ($nom == "")
        {
            throw new Exception("Nom invalide");
        }
    	
    	else if ($emplacement == "")
        {
            throw new Exception("Emplacement invalide");
        }
    	
        else if ($description == "")
        {
            throw new Exception("Description invalide");
        }
    	
    	else if (!is_numeric($nombre_de_chambre))
        {
            throw new Exception("Nombre_de_chambre invalide");
        }
    	
    	else if (!is_numeric($nombre_de_salle_de_bain))
        {
            throw new Exception("Nombre_de_salle_de_bain invalide");
        }
    	
    	else if (!is_numeric($prix_par_semaine))
        {
            throw new Exception("Prix_par_semaine invalide");
        }

        // enlever ou convertir les caractères spéciaux

        $statut = htmlentities($statut, ENT_QUOTES, "UTF-8");
    	$imageFacade = htmlentities($imageFacade, ENT_QUOTES, "UTF-8");
		$imageInterieur1 = htmlentities($imageInterieur1, ENT_QUOTES, "UTF-8");
		$imageInterieur2 = htmlentities($imageInterieur2, ENT_QUOTES, "UTF-8");
		$imageInterieur3 = htmlentities($imageInterieur3, ENT_QUOTES, "UTF-8");
        $nom = htmlentities($nom, ENT_QUOTES, "UTF-8");
    	$emplacement = htmlentities($emplacement, ENT_QUOTES, "UTF-8");
        $description = htmlentities($description, ENT_QUOTES, "UTF-8");
    	$nombre_de_chambre = htmlentities($nombre_de_chambre, ENT_QUOTES, "UTF-8");
    	$nombre_de_salle_de_bain = htmlentities($nombre_de_salle_de_bain, ENT_QUOTES, "UTF-8");
    	$prix_par_semaine = htmlentities($prix_par_semaine, ENT_QUOTES, "UTF-8");
    	
        $id = $this->connexionBD;

        $requete = $id->prepare("INSERT INTO produits 
							  (
							  statut,
							  imageFacade,
							  imageInterieur1,
							  imageInterieur2,
							  imageInterieur3,
							  nom,
							  emplacement,
							  description,
							  nombre_de_chambre,
							  nombre_de_salle_de_bain,
							  prix_par_semaine
							  )
							  VALUES (
									  :statut,
									  :imageFacade,
									  :imageInterieur1,
									  :imageInterieur2,
									  :imageInterieur3,
									  :nom,
									  :emplacement,
									  :description,
									  :nombre_de_chambre,
									  :nombre_de_salle_de_bain,
									  :prix_par_semaine)");

        if (!$requete) 
        {
            throw new Exception("Erreur de syntaxte SQL" . $id->errorCode());
        }
        
      
        $requete->bindParam(':statut',$statut,PDO::PARAM_STR);
    	$requete->bindParam(':imageFacade',$imageFacade,PDO::PARAM_STR);
    	$requete->bindParam(':imageInterieur1',$imageInterieur1,PDO::PARAM_STR);
    	$requete->bindParam(':imageInterieur2',$imageInterieur2,PDO::PARAM_STR);
    	$requete->bindParam(':imageInterieur3',$imageInterieur3,PDO::PARAM_STR);
    	$requete->bindParam(':nom',$nom,PDO::PARAM_STR);
    	$requete->bindParam(':emplacement',$emplacement,PDO::PARAM_STR);
    	$requete->bindParam(':description',$description,PDO::PARAM_STR);
    	$requete->bindParam(':nombre_de_chambre',$nombre_de_chambre,PDO::PARAM_INT);
    	$requete->bindParam(':nombre_de_salle_de_bain',$nombre_de_salle_de_bain,PDO::PARAM_INT);
    	$requete->bindParam(':prix_par_semaine',$prix_par_semaine,PDO::PARAM_INT);

        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur d'insertion sur la table produits " . $id->errorCode());
        }
        
        $requete->closeCursor();
        
        $id=null;

        // retourne true si tout s'est bien passé
        return true;
    }
    // -----------------------------------------------------------------------------------------------------//

    public function modifierUnProduit($statut,$imageFacade,$imageInterieur1,$imageInterieur2,$imageInterieur3,$nom,$emplacement,$description,$nombre_de_chambre,$nombre_de_salle_de_bain,$prix_par_jour,$prix_par_semaine)
    {
        /*if (!is_numeric($id_produit))
        {
            throw new Exception("Identifiant produit invalide");
        }
        else*/ 

        if ($statut == "")
        {
            throw new Exception("Statut invalide");
        }
        else if ($imageFacade == "")
        {
            throw new Exception("Image de la facade invalide");
        }
		
		else if ($imageInterieur1 == "")
        {
            throw new Exception("Image interieur1 invalide");
        }
		
		else if ($imageInterieur2 == "")
        {
            throw new Exception("Image interieur2 invalide");
        }
		
		else if ($imageInterieur3 == "")
        {
            throw new Exception("Image interieur3 invalide");
        }
		
        else if ($nom == "")
        {
            throw new Exception("Nom invalide");
        }
        else if ($emplacement == "")
        {
            throw new Exception("Emplacement invalide");
        }

        else if ($description == "")
        {
            throw new Exception("Description invalide");
        }

        else if (!is_numeric($nombre_de_chambre))
        {
            throw new Exception("Nombre_de_chambre invalide");
        }

        else if (!is_numeric($nombre_de_salle_de_bain))
        {
            throw new Exception("Nombre_de_salle_de_bain invalide");
        }

        else if (!is_numeric($prix_par_semaine))
        {
            throw new Exception("Prix_par_semaine invalide");
        }

        // enlever ou convertir les caractères spéciaux
		
        //$id_produit = htmlentities($id_produit, ENT_QUOTES, "UTF-8");
        $statut = htmlentities($statut, ENT_QUOTES, "UTF-8");
        $imageFacade = htmlentities($imageFacade, ENT_QUOTES, "UTF-8");
		$imageInterieur1 = htmlentities($imageInterieur1, ENT_QUOTES, "UTF-8");
		$imageInterieur2 = htmlentities($imageInterieur2, ENT_QUOTES, "UTF-8");
		$imageInterieur3 = htmlentities($imageInterieur3, ENT_QUOTES, "UTF-8");
        $nom = htmlentities($nom, ENT_QUOTES, "UTF-8");
        $emplacement = htmlentities($emplacement, ENT_QUOTES, "UTF-8");
        $description = htmlentities($description, ENT_QUOTES, "UTF-8");
        $nombre_de_chambre = htmlentities($nombre_de_chambre, ENT_QUOTES, "UTF-8");
        $nombre_de_salle_de_bain = htmlentities($nombre_de_salle_de_bain, ENT_QUOTES, "UTF-8");
        $prix_par_semaine = htmlentities($prix_par_semaine, ENT_QUOTES, "UTF-8");

        $id = $this->connexionBD;

        $requete &= $id->prepare("UPDATE produits 
                                  SET statut                    = :statut,
                                      imageFacade               = :imageFacade,
									  imageInterieur1           = :imageInterieur1,
									  imageInterieur2           = :imageInterieur2,
									  imageInterieur3           = :imageInterieur3,
                                      nom                       = :nom,
                                      emplacement               = :emplacement,
                                      description               = :description,
                                      nombre_de_chambre         = :nombre_de_chambre,
                                      nombre_de_salle_de_bain   = :nombre_de_salle_de_bain,
                                      prix_par_semaine          = :prix_par_semaine
                                  WHERE id_produit              = 1");

        //$requete->bindParam(':id_produit',$id_produit,PDO::PARAM_INT);
        $requete->bindParam(':statut',$statut,PDO::PARAM_STR);
        $requete->bindParam(':imageFacade',$imageFacade,PDO::PARAM_STR);
    	$requete->bindParam(':imageInterieur1',$imageInterieur1,PDO::PARAM_STR);
    	$requete->bindParam(':imageInterieur2',$imageInterieur2,PDO::PARAM_STR);
    	$requete->bindParam(':imageInterieur3',$imageInterieur3,PDO::PARAM_STR);
        $requete->bindParam(':nom',$nom,PDO::PARAM_STR);
        $requete->bindParam(':emplacement',$emplacement,PDO::PARAM_STR);
        $requete->bindParam(':description',$description,PDO::PARAM_STR);
        $requete->bindParam(':nombre_de_chambre',$nombre_de_chambre,PDO::PARAM_INT);
        $requete->bindParam(':nombre_de_salle_de_bain',$nombre_de_salle_de_bain,PDO::PARAM_INT);
        $requete->bindParam(':prix_par_semaine',$prix_par_semaine,PDO::PARAM_INT);
        
        $result = $requete->execute();

        if (!$result) 
        {
            throw new Exception("Erreur de mise à jour sur la table produits " . $id->errorCode());
        }
        
        $requete->closeCursor();
        
        $id=null;

        // retourne true si tout s'est bien passé
        return true;
    }

}

?>
