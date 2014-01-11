// Auteur: Louis Cyr   
// TP2 mise en page internet
// Permet de gérer le date picker
$(document).ready(function()
{
    //$('.datepicker').datepicker();

    $( ".datepicker" ).datepicker({
        dateFormat: 'dd MM yy',
        beforeShowDay: checkBadDates
        });

});

var $myBadDates = new Array("10 December 2013","21 December 2013","12 December 2013","13 December 2013");

function checkBadDates(mydate)
{
    var $return=true;
    var $returnclass ="available";
    $checkdate = $.datepicker.formatDate('dd MM yy', mydate);

    for(var i = 0; i < $myBadDates.length; i++)
    {    
        if($myBadDates[i] == $checkdate)
        {
            $return = false;
            $returnclass= "unavailable";
        }
    }
    return [$return,$returnclass];
}    


