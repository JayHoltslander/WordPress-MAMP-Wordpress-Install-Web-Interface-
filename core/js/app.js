$('#sitename').bind('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
       event.preventDefault();
       return false;
    }
});

// When the browser is ready...
$(function() {  
	// Setup form validation on the #register-form element
	$("#wpinfo").validate({

	    // Specify the validation rules
	    rules: {
	        localhostdir: "required",
	        sitename: "required",
	        dbname: "dbname"
	    },
	    
	    // Specify the validation error messages
	    messages: {
	        localhostdir: "Please enter the correct path to your localhost directory",
	        sitename: "Please enter the site name",
	        dbname: "Specify a database name"
	    },
	    
	    submitHandler: function(form) {
	        form.submit();
	    }
	});

});


//progress
$(document).ready(function(){
	$( "#sitename" ).click(function() {
		$("#progress").attr('aria-valuenow', '45');
		$("#progress").css( "width", "45%" );
		$("#progress" ).html( "45%" );
	});
	$( "#dbname" ).click(function() {
		$("#progress").attr('aria-valuenow', '66');
		$("#progress").css( "width", "66%" );
		$("#progress" ).html( "66%" );
	});
	$( "#dbuser" ).click(function() {
		$("#progress").attr('aria-valuenow', '67');
		$("#progress").css( "width", "67%" );
		$("#progress" ).html( "67%" );
	});
	$( "#dbpass" ).click(function() {
		$("#progress").attr('aria-valuenow', '68');
		$("#progress").css( "width", "68%" );
		$("#progress" ).html( "68%" );
	});
	$( "#host" ).click(function() {
		$("#progress").attr('aria-valuenow', '69');
		$("#progress").css( "width", "69%" );
		$("#progress" ).html( "69%" );
	});
	$( "#dbprefix" ).click(function() {
		$("#progress").attr('aria-valuenow', '70');
		$("#progress").css( "width", "70%" );
		$("#progress" ).html( "70%" );
	});
	$( ".btn-primary" ).hover(function() {
		$("#progress").attr('aria-valuenow', '72');
		$("#progress").css( "width", "72%" );
		$("#progress" ).html( "72%" );
	});
});

$( "#manager" ).click(function() {
	$('.showsites').toggleClass( "show" );
});

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
});