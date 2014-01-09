<?php
class Produits
{
    private $connexionBD;

    public function __construct()
    {
        $oConnexionPDO = new ConnexionPDO("canneapeche","UTF8");
        $this->connexionBD = $oConnexionPDO->rConnexion;
    }

    public function votreFonction1()
    {

    }    

    public function votreFonction2()
    {

    }    
}
?>