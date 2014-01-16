// Auteur: Louis Cyr   
// TP3 programmation internet III
// Gestion du panier d'achat
$(document).ready(function()
{
    /*******************************************************************************************/
    /* PERMET D'AVOIR DES TOOLTIP SUR LES IMAGES DE PRODUITS, SUR LES BOUTON VIGNETTE ET LISTE */
    /*******************************************************************************************/
    $(function() 
    {
        $(document).tooltip();
    });

    PanierAchat.mettreAJourLaQuantitePanier();

    var param = localStorage.getItem("parametres");
    if (param == "gestionPanier")
    {
        PanierAchat.gestionPanier();
    }

    /*************************************/
    /* ON CLIQUE SUR RETOURNER AU PANIER */
    /*************************************/
    $("#retournerAuPanier").click(function()
    {
        localStorage.setItem("parametres", "gestionPanier");
        window.document.location.href = 'gestionPanier.html';     
    });

    /*************************************/
    /* ON CLIQUE SUR PASSER UNE COMMANDE */
    /*************************************/
    $("#passerCommande").click(function()
    {
        localStorage.setItem("parametres", "passerCommande");
        window.document.location.href = 'passerCommande.html';     
    });

    /*********************************/
    /* ON CLIQUE SUR VIDER LE PANIER */
    /*********************************/
    $("#formulairePanier").on("click","#viderPanier",function()
    {
        localStorage.removeItem("panier");
        PanierAchat.gestionPanier();
        PanierAchat.mettreAJourLaQuantitePanier();
    });

    /***************************************/
    /* ON CLIQUE SUR CONFIRMER LA COMMANDE */
    /***************************************/
    $("#formulaireCommande").on("click",".confirmerCommande",function()
    {
        var courriel = $("#emaCourriel").val();
        var adresse = $("#txtAdresse").val();
        PanierAchat.confirmerCommande(courriel,adresse);
    });

    /***************************************/
    /* ON CLIQUE SUR CONTINUER À MAGASINER */
    /***************************************/
    $(".formulaire").on("click","#continuerAMagasiner",function()
    {
        window.document.location.href = 'index.html';     
    });

    /***************************************/
    /* ON CLIQUE SUR CONFIRMER UN COURRIEL */
    /***************************************/
    $("#formulaireAInserer").on("click",".confirmerCourriel",function()
    {
        var courriel = $("#emaCourriel").val();
        localStorage.setItem("parametres","confirmerCourriel");
        localStorage.setItem("courriel",courriel);
        window.document.location.href = "panier.html";     
    });
    
    /*******************************************************/
    /* ON CLIQUE SUR VISUALISER LES DÉTAILS D'UNE COMMANDE */
    /*******************************************************/
    $("#formulaireAInserer").on("click",".visualiserLesDetails",function()
    {
        var idCommande = $(this).attr("id");
        localStorage.setItem("parametres","visualiserLesDetails");
        localStorage.setItem("idCommande",idCommande);
        window.document.location.href = "panier.html";     
    });

    /************************************************************/
    /* ON CLIQUE SUR REVENIR À LA LISTE DE COMMANDE LA COMMANDE */
    /************************************************************/
    $("#formulaireAInserer").on("click",".revenirALaListeDeCommande",function()
    {
        // Le courriel est déjà dans un localStorage
        localStorage.setItem("parametres","confirmerCourriel");
        window.document.location.href = "panier.html";     
    });

    /************************************/
    /* ON CLIQUE SUR VOIR MES COMMANDES */
    /************************************/
    $("#partieUsager").on("click","#visualiserListeCommande",function()
    {
        localStorage.setItem("parametres", "visualiserListeCommande");
        window.document.location.href = "panier.html";     
    });

    /*************************************************/
    /* ON CLIQUE SUR LE PANIER POUR VOIR SON CONTENU */
    /*************************************************/
    $("#partiePanier").on("click","#gestionPanier",function()
    {
        localStorage.setItem("parametres", "gestionPanier");
        window.document.location.href = 'gestionPanier.html';     
    });

});