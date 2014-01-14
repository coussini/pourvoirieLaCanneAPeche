var startDate;
var endDate;

// Élimine la semaine courante dans le cadre d'une réservation
function elimineSemaineSelonPremierJour(dateFiltre) 
{
    var premierJourDeSemaine = dateFiltre.getDate() - dateFiltre.getDay(); // Jour - Numéro de jour de la semaine
    for (var i = 0; i < 7; i++) 
    {
        var selection = premierJourDeSemaine + i;
        var dateSelection = new Date(dateFiltre.setDate(selection));
        var mm = dateSelection.getMonth() + 1;
        var dd = dateSelection.getDate();
        var yyyy = dateSelection.getFullYear();
        var formatDateSelection = mm + "/" + dd + "/" + yyyy;
        dateAEliminer[new Date(formatDateSelection)] = new Date(formatDateSelection);
    }
}

// Permet de mettre active la semaine choisi en ajoutant la classe en conséquence
var selectionneSemaineActive = function() 
{
    window.setTimeout(function () 
    {
        $('.semaineChoisi').find('.ui-datepicker-current-day a').addClass('ui-state-active')
    },1);
}

$('.semaineChoisi').datepicker( {
    onSelect: function(dateText, inst) { 
        var date = $(this).datepicker('getDate');
        startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
        endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
        var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
        $('#semaine').text("(" + $.datepicker.iso8601Week(startDate) + ") du ");
        $('#startDate').text($.datepicker.formatDate( dateFormat, startDate, inst.settings ) + " au ");
        $('#endDate').text($.datepicker.formatDate( dateFormat, endDate, inst.settings ));
        
        selectionneSemaineActive();
    },
    beforeShowDay: function(date) {
        var cssClass = '';
        if(date >= startDate && date <= endDate)
            cssClass = 'ui-datepicker-current-day';
        var bDisable = dateAEliminer[date];
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
        selectionneSemaineActive();
    }
});

//$('.semaineChoisi .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
//$('.semaineChoisi .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });

$(".semaineChoisi .ui-datepicker-calendar tr").on("mousemove",function() { $(this).find('td a').addClass('ui-state-hover'); });
$(".semaineChoisi .ui-datepicker-calendar tr").on("mouseleave",function() { $(this).find('td a').removeClass('ui-state-hover'); });