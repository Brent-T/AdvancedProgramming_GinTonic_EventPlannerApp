$(document).ready(function(){
	console.log("loaded");


	// add colors to input fields when field match or do not match
	$( ".js-check-trigger" ).keyup(function() {

		if($( ".pw1" ).val() === "" && $( ".pw2" ).val() === "") {

			$( ".input-pw1" ).removeClass( "has-warning" );
			$( ".input-pw2" ).removeClass( "has-warning" );
			$( ".input-pw1" ).removeClass( "has-success" );
			$( ".input-pw2" ).removeClass( "has-success" );
			$( ".pw1" ).removeClass( "form-control-warning" );
			$( ".pw2" ).removeClass( "form-control-warning" );
			$( ".pw1" ).removeClass( "form-control-success" );
			$( ".pw2" ).removeClass( "form-control-success" );

			$(".form-control-feedback").html('');

		} else {

			var passwordNew = $( ".pw1" ).val();
			var passwordConfirm = $( ".pw2" ).val();

			if(passwordNew === passwordConfirm) {
				$( ".input-pw1" ).removeClass( "has-warning" );
				$( ".input-pw2" ).removeClass( "has-warning" );
				$( ".input-pw1" ).addClass( "has-success" );
				$( ".input-pw2" ).addClass( "has-success" );

				$( ".pw1" ).removeClass( "form-control-warning" );
				$( ".pw2" ).removeClass( "form-control-warning" );
				$( ".pw1" ).addClass( "form-control-success" );
				$( ".pw2" ).addClass( "form-control-success" );

				$(".form-control-feedback").html('passwords match!');

			} else {

				$( ".input-pw1" ).addClass( "has-warning" );
				$( ".input-pw2" ).addClass( "has-warning" );
				$( ".pw1" ).addClass( "form-control-warning" );
				$( ".pw2" ).addClass( "form-control-warning" );

				$(".form-control-feedback").html('passwords do not match!');
			}
		}
	});

});



var triggerFileUpload = function() {
	$('.trigger-file-upload').click();
}


