$(function() {

    // Préférence en français et sélection des options du calendrier
    // en fonction des besoins
    $.datepicker.regional['fr'] = 
    {
        closeText: 'Fermer',
        prevText: 'Mois précédent',
        nextText: 'Mois suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin',
        'Juillet','Aout','Septembre','Octobre','Novembre','Décembre'],
        monthNamesShort: ['Jan','Fev','Mar','Avr','Mai','Jun',
        'Jul','Aou','Sep','Oct','Nov','Dec'],
        dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
        dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
        dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
        showOtherMonths: true,
        selectOtherMonths: true,
        minDate: 0,
        maxDate: '+24M +0D',
        numberOfMonths: 1,
        showButtonPanel: true
    };
    
    $.datepicker.setDefaults($.datepicker.regional['fr']);

    var dateAEliminer = {}; // Tableau des dates réservés et de la semaine courante

    // Élimine la semaine courante dans le cadre d'une réservation
    function elimineSemaineSelonPremierJour(courante) 
    {
        var courante = new Date; // Date courante
        var premierJourDeSemaine = courante.getDate() - courante.getDay(); // Jour - Numéro de jour de la semaine
        for (var i = 0; i < 7; i++) 
        {
            var selection = premierJourDeSemaine + i;
            var dateSelection = new Date(courante.setDate(selection));
            var mm = dateSelection.getMonth() + 1;
            var dd = dateSelection.getDate();
            var yyyy = dateSelection.getFullYear();
            var formatDateSelection = mm + "/" + dd + "/" + yyyy;
            dateAEliminer[new Date(formatDateSelection)] = new Date(formatDateSelection);
        }
    }
    
    var startDate;
    var endDate;
    
    // Permet de mettre active la semaine choisi en ajoutant la classe en conséquence
    var selectCurrentWeek = function() 
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
            
            selectCurrentWeek();
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
            selectCurrentWeek();
        }
    });
    
    $('.semaineChoisi .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
    $('.semaineChoisi .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
});
