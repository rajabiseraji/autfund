

jQuery(document).ready(function($) {
	initForms();
});








function initForms(){
	$('[data*="text"]').on('change', function(event) {
		var fieldName = $(this).val();
		var fundID = $(location).attr('pathname').split('/');
		fundID = fundID[2];
		// return;
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

		$.ajax({
			url: '/fundNameSave',
			type: 'post',
			data: {_token: CSRF_TOKEN, fieldName: fieldName, fundID: fundID},
		})
		.done(function(data) {
			Materialize.toast('Autosaved!', 4000) ;
			console.log("success");
		})
		.fail(function() {
			Materialize.toast('An error occured while auto saving', 4000) ;
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
}