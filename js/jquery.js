$(document).ready(function()
{
    // Attache évènement au select dans la page admin - contenu statique
	$( "#selectNomContenu" ).change(function() {this.form.submit();});

	// Popover Chalet 1
	$('#chalet1').bind({ mouseenter: function(e) {$('#pop1').removeClass('hidden');}, mouseleave: function(e) {$('#pop1').addClass('hidden');}, click: function(e) { $('#pop1').addClass('hidden'); },});

	// Popover Chalet 2
	$('#chalet2').bind({ mouseenter: function(e) {$('#pop2').removeClass('hidden');}, mouseleave: function(e) {$('#pop2').addClass('hidden');}, click: function(e) { $('#pop2').addClass('hidden'); },});

	// Popover Chalet 3
	$('#chalet3').bind({ mouseenter: function(e) {$('#pop3').removeClass('hidden');}, mouseleave: function(e) {$('#pop3').addClass('hidden');}, click: function(e) { $('#pop3').addClass('hidden'); },});

	// Google Maps

	var map;
	function initialize() {
		var mapOptions = {
		zoom: 12,
		center: new google.maps.LatLng(46.699671,-73.949962),
		mapTypeId: google.maps.MapTypeId.ROADMAP
		};
	  	map = new google.maps.Map(document.getElementById('map-canvas'),
		mapOptions);
		}

		google.maps.event.addDomListener(window, 'load', initialize);
});

