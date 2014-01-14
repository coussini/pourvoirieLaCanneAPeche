<script type="text/JavaScript" language="JavaScript">
    $(document).ready(function()
    {
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

        var dateDuFiltre = new Date(); // Date courante et heure
        window.alert(dateDuFiltre);
        elimineSemaineSelonPremierJour(dateDuFiltre);
</script>
<script type="text/JavaScript" language="JavaScript">
<?php
        $reservations = Controleur::chercherDatesReservees();
        for ($i = 0; $i < count($reservations); $i++)
        {
            $dateDuFiltre = new DateTime($reservations[$i]["date_debut"]); // Date courante et heure
            $dateStr = $dateDuFiltre->format('Y-m-d H:i:s');
            echo 'elimineSemaineSelonPremierJour(' . $dateStr . ');';
        }
?>
        
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
      
    });
</script>
