$(document).ready(function(){
	console.log("loaded");


	// Google autocomplete
	var initGoogleAutocomplete = function() {
 
		// Google suggestions code
		var inputStart = document.getElementById('google-autocomplete');
		var options = {};
		autocomplete = new google.maps.places.Autocomplete(inputStart, options);
	}

	initGoogleAutocomplete();


	// hide form on load
	if ($( "#toggle-init" ).val() == '') {
			$('#jq-toggle').hide();
		}
	// $('#jq-toggle').hide();
	// console.log("executed");


	// slide down if title is focussed
	$( "#toggle-init" ).focus(function() {
		$('#jq-toggle').slideDown();
	});

	
	
	// If no title -> slide up
	// $( "#toggle-init" ).focusout(function() {
	// 	if ($( "#toggle-init" ).val() == '') {
	// 		$('#jq-toggle').slideUp();
	// 	}
	// });
	
});


var customSlideUp = function() {
		$('#jq-toggle').slideUp();
}