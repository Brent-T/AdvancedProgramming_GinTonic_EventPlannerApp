$(document).ready(function(){
	console.log("loaded");
	initGoogleAutocomplete();
	
	if ($( "#toggle-init" ).val() == '') {
		$('#jq-toggle').hide();
	}

	// slide down if title is focussed
	$( "#toggle-init" ).focus(function() {
		$('#jq-toggle').slideDown();
	});

	$(function () {
		$('[data-toggle="popover"]').popover()
	})
});


var customSlideUp = function() {
		$('#jq-toggle').slideUp();
}

// Google autocomplete
var initGoogleAutocomplete = function() {
	var inputStart = document.getElementById('google-autocomplete');
	var options = {};
	autocomplete = new google.maps.places.Autocomplete(inputStart, options);
}