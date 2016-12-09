$(document).ready(function(){
	initGoogleAutocomplete();
	$(function () {$('[data-toggle="popover"]').popover()})

	$( "#suggest" ).keyup(function() {
		$('.person-does-not-exist').hide();
		var text = $( "#suggest" ).val();
		var event = $( "[name='event_id']" ).val();
		console.log(event);
		getUsersContaingString(text, event);
	});	

	$( "#add-person" ).click(function() {
		var current = $( "#suggest" ).typeahead("getActive");
		if (current) {
			// Some item from your model is active!
			if (current.name == $( "#suggest" ).val()) {
				console.log(current);
				$('.table-to-be-invited').append('<tr><td>'+current.name+'</td><td><button type="button" class="btn btn-outline-danger btn-sm" onclick="$(this).parents(' + " ' " +  'tr' + " ' " + ').remove();"><i class="fa fa-times" aria-hidden="true"></i></button></td><td><input name="toBeAdded[]" type="hidden" value="' + current.id + '"></td></tr>');
			} else {
				$('.person-does-not-exist').show();
			}
		} else {
			$('.person-does-not-exist').show();
		}
	});
});

// Google autocomplete
var initGoogleAutocomplete = function() {
	var inputStart = document.getElementById('google-autocomplete');
	var options = {};
	autocomplete = new google.maps.places.Autocomplete(inputStart, options);
}

// ajax request to webservice and returning suggested users based in user input
var getUsersContaingString = function(input, id) {
	$('.typeahead').typeahead('destroy')
	$.ajax({
		type: "GET",
		url: "http://localhost:9000/usercontains?text=" + input + "&eventid=" + id ,
		// data: input,
		dataType: "json",
		async: true,
		success: function (data) {
			displaySuggestedUsers(data);
		}
	});
}

// create data array for suggestionsbox
var createDataArray = function(data) {
	newData = [];
	$(data).each(function( index ) {
		newData.push({id: data[index]['userId'], name:(data[index]['firstName'] + " " + data[index]['surName'])});
	});
	return newData;
}

//display suggestionsbox
var displaySuggestedUsers = function(data) {
	$('.typeahead').typeahead()
	$("#suggest").typeahead({ source: createDataArray(data), autoSelect: true});	
}