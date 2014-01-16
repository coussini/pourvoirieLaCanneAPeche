// Auteur: Louis Cyr   
// Projet d'intégration
$(document).ready(function()
{
    /*******************************************************************************************/
    /* PERMET D'AVOIR DES TOOLTIP SUR LES IMAGES DE PRODUITS, SUR LES BOUTON VIGNETTE ET LISTE */
    /*******************************************************************************************/
    $(function() 
    {
        $(document).tooltip();
    });

    /***************************************/
    /* ON CLIQUE SUR CONFIRMER LA COMMANDE */
    /***************************************/
    $("#formulaireCommande").on("click",".reserver",function()
    {
        var courriel = $("#emaCourriel").val();
        var adresse = $("#txtAdresse").val();
        PanierAchat.confirmerCommande(courriel,adresse);
        window.document.location.href = 'indexTestsReservations.php';     
    });

});