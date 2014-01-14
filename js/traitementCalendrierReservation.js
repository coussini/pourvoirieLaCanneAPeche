// Auteur: Louis Cyr   
// TP3 programmation internet III
// Gestion du panier d'achat
$(document).ready(function()
{
    CalendrierReservation.initialisation();
    var dateCourante = new Date; // la date du jour
    CalendrierReservation.elimineUneSemaineSelonLaDate(dateCourante);
    CalendrierReservation.elimineSemainesReservees();

    $(".semaineChoisi .ui-datepicker-calendar tr").on("mousemove",function() { $(this).find('td a').addClass('ui-state-hover'); });
    $(".semaineChoisi .ui-datepicker-calendar tr").on("mouseleave",function() { $(this).find('td a').removeClass('ui-state-hover'); });
});