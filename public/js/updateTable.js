

jQuery(document).ready(function($) {
	initForms();
});








function initForms(){
	$('[data*="text"]').on('change', function(event) {
		var fieldName = $(this).attr('id');
		var fieldValue = $(this).val();
		var fundID = $(location).attr('pathname').split('/');
		fundID = fundID[2];
		// return;
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

		$.ajax({
			url: '/fundNameSave',
			type: 'post',
			data: {_token: CSRF_TOKEN, fieldName: fieldName, fundID: fundID, fieldValue: fieldValue},
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


	$('#tag').on('change', function(event) {
		
		var fundID = $(location).attr('pathname').split('/');
		fundID = fundID[2];
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var tag = $('#tag').val();
		$.ajax({
			url: '/tagSave',
			type: 'post',
			data: {_token: CSRF_TOKEN, tag: tag, fundID: fundID},
		})
		.done(function(data) {
			Materialize.toast('Tags Autosaved!', 4000) ;
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

	$('#fund_related_id').on('change', function(event) {
		
		var fundID = $(location).attr('pathname').split('/');
		fundID = fundID[2];
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var fund_related_id = $('#fund_related_id').val();
		$.ajax({
			url: '/fundRelSave',
			type: 'post',
			data: {_token: CSRF_TOKEN, fund_related_id: fund_related_id, fundID: fundID},
		})
		.done(function(data) {
			Materialize.toast('Related ID Autosaved!', 4000) ;
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

	$('#resSelect').on('change', function(event) {
		
		var fundID = $(location).attr('pathname').split('/');
		fundID = fundID[2];
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var res_code = $('#resSelect').val();
		$.ajax({
			url: '/resSave',
			type: 'post',
			data: {_token: CSRF_TOKEN, res_code: res_code, fundID: fundID},
		})
		.done(function(data) {
			Materialize.toast('Research Area Autosaved!', 4000) ;
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


	$('#fundSelect').on('change', function(event) {
		
		var fundID = $(location).attr('pathname').split('/');
		fundID = fundID[2];
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var fund_org = $('#fundSelect').val();
		$.ajax({
			url: '/orgSave',
			type: 'post',
			data: {_token: CSRF_TOKEN, fund_org: fund_org, fundID: fundID},
		})
		.done(function(data) {
			Materialize.toast('Related ID Autosaved!', 4000) ;
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