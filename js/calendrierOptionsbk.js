// Préférence en français et sélection des options du calendrier
// en fonction des besoins
// l'idée provient des sites suivants:
// http://stevethomas.com.au/jquery/jquery-datepicker-ajax-request-to-highlight-days-from-mysql.html
// http://forum.alsacreations.com/topic-5-62863-1-Resolu-Calendrier-en-jquery-datepicker-La-galere-.html
//

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