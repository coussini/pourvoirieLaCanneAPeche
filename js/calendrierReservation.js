// Auteur: Louis Cyr   
// Gestion du calendrier de réservation
var CalendrierReservation = (function(win,doc,$) 
{
    /*********************/
    /* VARIABLES PRIVÉES */
    /*********************/

    // Tableau des dates réservés et de la semaine courante
    var tableauDatesReservees = new Array();
    
    /*********************/
    /* MODULES RETOURNÉS */
    /*********************/
    return {
        
        // Préférence en français et sélection des options du calendrier
        // en fonction des besoins de notre site sur la pourvoirie de la canna à pêche
        // 
        // ----------------------------------
        // l'idée provient des sites suivants:
        // ----------------------------------
        // http://stevethomas.com.au/jquery/jquery-datepicker-ajax-request-to-highlight-days-from-mysql.html
        // http://forum.alsacreations.com/topic-5-62863-1-Resolu-Calendrier-en-jquery-datepicker-La-galere-.html
        //
        initialisation: function() 
        {
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
        },

        // Appel AJAX XHR selon l'instance xhr et l'url
        appelAJAX_XHR: function(xhr,url) 
        {
            xhr.open("GET", url, true);

            xhr.onerror = function(e) 
            {
                document.getElementById("messageErreur").innerHTML = "Une erreur s'est produite au cours du traitement d'appel AJAX";
            }

            xhr.send();
        },
        // Selon la date passée en paramètre, on élimine la semaine de cette date au calendrier  
        // question de ne pas permettre de sélectionner des dates déjà réservées
        // ou d'enlever la semaine courante comme sélection possible.
        elimineUneSemaineSelonLaDate: function(dateFiltre) 
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
                CalendrierReservation.setTableauDatesReservees(formatDateSelection);
            }
        },

        // Permet d'éliminer du calendrier toutes les semaines réservées
        // pour ce produit, question de ne pas permettre
        // de sélectionner des dates déjà réservées
        elimineSemainesReservees: function() 
        {
            var source = "indexTestsReservations.php";
            var requete = "?requeteAJAX=req_chercher_dates_reservees";
            var url = source + requete;
            var xhr = new XMLHttpRequest();
            
            CalendrierReservation.appelAJAX_XHR(xhr,url);

            xhr.onreadystatechange = function() 
            {
                if (xhr.status == 200 && xhr.readyState == xhr.DONE) 
                {
                    var reponse = JSON.parse(xhr.responseText);
                    console.log("-----------");
                    console.log(reponse);
                    console.log("-----------");
                    console.log(" ");
                    dates=reponse.split(','); 

                    for (var i = 0; i < dates.length; i++) 
                    {
                        var dateFiltre = new Date(dates[i]);
                        console.log(dateFiltre);
                        console.log("-----------");
                        CalendrierReservation.elimineUneSemaineSelonLaDate(dateFiltre);
                    }
                }
            };
        },
        
        // Permet de mettre active la semaine choisi en ajoutant la classe en conséquence
        selectionneSemaineActive: function() 
        {
            win.setTimeout(function () 
            {
                $('.semaineChoisi').find('.ui-datepicker-current-day a').addClass('ui-state-active')
            },1);
        },


        // Cette méthode met les dates dans un tableau de dates réservées
        setTableauDatesReservees: function(datesReservees) 
        {
            tableauDatesReservees.push(datesReservees);
        },
        
        // Cette méthode retourne un tableau de dates réservées
        getTableauDatesReservees: function() 
        {
            return tableauDatesReservees;
        }
    };
})(window,document,jQuery);