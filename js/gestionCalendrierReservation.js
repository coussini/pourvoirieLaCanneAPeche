    var unavailableDates = ["9-12-2013", "14-12-2013", "15-12-2013"];

    function unavailable(date) {
        dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
        if ($.inArray(dmy, unavailableDates) == -1) {
            return [true, ""];
        } else {
            return [false, "", "Unavailable"];
        }
    }

    $(function() {
        $("#iDate").datepicker({
            dateFormat: 'dd MM yy',
            beforeShowDay: unavailable
        });

    });