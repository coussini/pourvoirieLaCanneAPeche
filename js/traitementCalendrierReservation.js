// Auteur: Louis Cyr   
// TP3 programmation internet III
// Gestion du panier d'achat
$(document).ready(function()
{
    var href = $(window.location).attr('href');
    var tableauHref = href.split("?");
    var parametreUrl = tableauHref[1].split("&");
    var parametre = "";

    for (var i = 0; i < parametreUrl.length; i++) 
    {
        if (parametreUrl[i].indexOf("id_produit") != -1)
        {
            var parametreProduit = parametreUrl[i];
        }
    };

    CalendrierReservation.initialisation();
    var dateCourante = new Date; // la date du jour
    CalendrierReservation.elimineUneSemaineSelonLaDate(dateCourante);
    CalendrierReservation.elimineSemainesReservees(parametreProduit);

    $(".semaineChoisi .ui-datepicker-calendar tr").on("mousemove",function() { $(this).find('td a').addClass('ui-state-hover'); });
    $(".semaineChoisi .ui-datepicker-calendar tr").on("mouseleave",function() { $(this).find('td a').removeClass('ui-state-hover'); });
});