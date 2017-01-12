document.filtered = true;


$('#selectAllButton').click(function(event) {
	$('[id*="_check"]').prop('checked', this.checked);
});

$('#resetOrg').click(function(event) {
	$('#defaultOrg').prop('selected', 'selected');
	$('select').material_select();
	var searchString = $('#search').val();
	AjaxAsk(searchString);
});


$('#expandAll').click(function(event) {
	$('.collapsible-header').click();
});

$('#resetCountry').click(function(event) {
	$('#defaultCountry').prop('selected', 'selected');
	$('select').material_select();
	var searchString = $('#search').val();
	AjaxAsk(searchString);
});




$('#filter').click(function(event) {
	document.filtered = !document.filtered;
	if (document.filtered) {
		$('#filterDescription').hide('slow');
	} else {
		$('#filterDescription').show('slow');		
	}
});


$('#search').on('keyup', function(event) {
	 var searchString = $('#search').val();
	AjaxAsk(searchString);
});

$("#fund_related_id").on('change', function(event) {
	 var searchString = $('#search').val();
	AjaxAsk(searchString);
});

$("#fund_org").on('change', function(event) {
	 var searchString = $('#search').val();
	AjaxAsk(searchString);
});

$("#fund_rating").on('keyup', function(event) {
	 var searchString = $('#search').val();
	AjaxAsk(searchString);
});

$("#fund_country").on('change', function(event) {
	 var searchString = $('#search').val();
	AjaxAsk(searchString);
});

$("#resSelect").on('change', function(event) {
	 var searchString = $('#search').val();
	AjaxAsk(searchString);
});

$("#tag").on('change', function(event) {
	 var searchString = $('#search').val();
	AjaxAsk(searchString);
});

$('[id*="_check"]').on('change',function(event) {
	var searchString = $('#search').val();
	AjaxAsk(searchString);
});



function AjaxAsk(searchString){
	var related = $('#fund_related_id').val();
	var country = $('#fund_country').val();
	var research = $('#resSelect').val();
	var rating = $('#fund_rating').val();
	var tag = $('#tag').val();
	var org = $('#fund_org').val();

	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var nameIsChecked = $('#fund_name_check').is(':checked');
    var progIsChecked = $('#fund_prog_check').is(':checked');
    var durationIsChecked = $('#fund_duration_check').is(':checked');
    var financialIsChecked = $('#fund_financial_check').is(':checked');
    var requirementIsChecked = $('#fund_requirement_check').is(':checked');
    var deadlineIsChecked = $('#fund_deadline_check').is(':checked');
    var linkIsChecked = $('#fund_link_check').is(':checked');
    var memoIsChecked = $('#fund_memo_check').is(':checked');
    var farsiIsChecked = $('#fund_farsi_check').is(':checked');
    var commentsIsChecked = $('#fund_comments_check').is(':checked');
    $('#board .card-header').hide();
    $('#board > .row').hide();
    $('#loadResults').show();
	$.ajax({
		url: '/main',
		type: 'post',
		dataType: 'html',
		data: {_token: CSRF_TOKEN, searchString: searchString,  name: nameIsChecked, prog: progIsChecked, duration: durationIsChecked,
				financial: financialIsChecked, requirement: requirementIsChecked, deadline: deadlineIsChecked, 
				link: linkIsChecked, memo: memoIsChecked, farsi: farsiIsChecked, comments: commentsIsChecked,
				related: related, country: country, research: research, rating: rating, tag: tag, org: org
				},
	})
	.done(function(data) {
		$('#loadResults').hide();
		$('#board > .row').show();
		$('#board .card-header').show();
		console.log("success");
		// console.log(data);
		$('#board').empty();
		$('#board').append(data);
		    $('ul.tabs').tabs();
		    $('.collapsible').collapsible();

	})
	.fail(function() {
		console.log("error");
		$('#loadResults').hide();
		$('#board > .row').show();
		$('#board .card-header').show();
	})
	.always(function() {
		
	});


	
}


