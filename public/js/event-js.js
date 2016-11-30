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

	$( "#suggest" ).keyup(function() {
		var text = $( "#suggest" ).val();
		getUsersContaingString(text);
	});	
});


var customSlideUp = function() {
		$('#jq-toggle').slideUp();
}

// Google autocomplete
var initGoogleAutocomplete = function() {

	// Google suggestions code
	var inputStart = document.getElementById('google-autocomplete');
	var options = {};
	autocomplete = new google.maps.places.Autocomplete(inputStart, options);
}

newData = [];
var getUsersContaingString = function(input) {
	$('.typeahead').typeahead('destroy')
	console.log('requests');
	$.ajax({
	    type: "GET",
	    url: "http://localhost:9000/usercontains?text=",
	    data: input,
	    dataType: "json",
	    async: true,
	    success: function (data) {
	    	newData = [];
	        $(data).each(function( index ) {
			  var dataItem = {id: data[index]['userId'], name:(data[index]['firstName'] + " " + data[index]['surName']) }
			  newData.push(dataItem);
			});

	        $('.typeahead').typeahead()
			$("#suggest").typeahead({ source: newData, 
            autoSelect: true});	
	    }
	});
}