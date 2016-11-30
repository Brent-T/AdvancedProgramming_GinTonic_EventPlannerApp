$(document).ready(function(){
	console.log("loaded");
	initGoogleAutocomplete();

	$(function () {
		$('[data-toggle="popover"]').popover()
	})

	$( "#suggest" ).keyup(function() {
		var text = $( "#suggest" ).val();
		getUsersContaingString(text);
	});	
});

// Google autocomplete
var initGoogleAutocomplete = function() {
	var inputStart = document.getElementById('google-autocomplete');
	var options = {};
	autocomplete = new google.maps.places.Autocomplete(inputStart, options);
}

var getUsersContaingString = function(input) {
	$('.typeahead').typeahead('destroy')
	$.ajax({
		type: "GET",
		url: "http://localhost:9000/usercontains?text=",
		data: input,
		dataType: "json",
		async: true,
		success: function (data) {
				displaySuggestedUsers(data);
		}
	});
}

var createDataArray = function(data) {
	newData = [];
	$(data).each(function( index ) {
		newData.push({id: data[index]['userId'], name:(data[index]['firstName'] + " " + data[index]['surName'])});
	});
	return newData;
}

var displaySuggestedUsers = function(data) {
	$('.typeahead').typeahead()
	$("#suggest").typeahead({ source: createDataArray(data), autoSelect: true});	
}