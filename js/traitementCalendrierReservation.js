// Auteur: Louis Cyr   
// TP3 programmation internet III
// Gestion du panier d'achat
$(document).ready(function()
{
    CalendrierReservation.initialisation();
    var dateCourante = new Date; // la date du jour
    CalendrierReservation.elimineUneSemaineSelonLaDate(dateCourante);
    CalendrierReservation.elimineSemainesReservees();

    $('.semaineChoisi').datepicker( {
        onSelect: function(dateText, inst) { 
            var date = $(this).datepicker('getDate');
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
            var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
            $('#semaine').text("(" + $.datepicker.iso8601Week(startDate) + ") du ");
            $('#startDate').text($.datepicker.formatDate( dateFormat, startDate, inst.settings ) + " au ");
            $('#endDate').text($.datepicker.formatDate( dateFormat, endDate, inst.settings ));
            
            CalendrierReservation.selectionneSemaineActive();
        },
        beforeShowDay: function(date) {
            var cssClass = '';
            if(date >= startDate && date <= endDate)
                cssClass = 'ui-datepicker-current-day';
            var bDisable = CalendrierReservation.getTableauDatesReservees()[date];
            if (bDisable)
            {
                return [false, cssClass];
            }
            else
            {
                return [true, cssClass];
            }              
        },
        onChangeMonthYear: function(year, month, inst) {
            CalendrierReservation.selectionneSemaineActive();
        }
    });
    
    $(".semaineChoisi .ui-datepicker-calendar tr").on("mousemove",function() { $(this).find('td a').addClass('ui-state-hover'); });
    $(".semaineChoisi .ui-datepicker-calendar tr").on("mouseleave",function() { $(this).find('td a').removeClass('ui-state-hover'); });

});