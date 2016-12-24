$(document).ready(function() {
        $('body').addClass('loaded');
});

document.ff = new Array();


$('[id *= "_check"]').change(function(event) {
	var tmp = $(this).attr('id');
	if($(this).is(':checked')){
		if(document.ff[tmp]){
			document.ff[tmp].attr({'required': true});
			document.ff[tmp].fadeIn(500);
			$('#firstRow').append(document.ff[tmp]);
		}
	} else{
		$('#'+tmp.replace('_check', '_parent')).fadeOut('1000', function() {
			document.ff[tmp] = $('#'+tmp.replace('_check', '_parent')).detach();
		});
	}
		if($('[id*="_parent"]').length == 0)
			$('#subbutt').addClass('disabled');
		else
			$('#subbutt').removeClass('disabled')

});


$('#cancelCountry').on('click', function(event) {
	event.preventDefault();
	$('#country').val('');
});
$('#addC').on('click', function(event) {
	event.preventDefault();
	var tmp = $('<option></option>');
	tmp.attr('value', $('#country').val());
	tmp.text($('#country').val());
	tmp.appendTo('#fund_country');
	$('select').material_select();
});

$('#insResArea').on('click', function(event) {
	event.preventDefault();
	var tmp = $('<option></option>');
	tmp.attr('value', $('#resAreaTitle').val());
	tmp.text($('#resAreaTitle').val());
	tmp.appendTo('#resSelect');
	$('select').material_select();
});

$('form').keypress(function(e) {
    if(e.which == 13) {
        e.preventDefault();
    }
});

$('#insFundOrg').on('click', function(event) {
	event.preventDefault();
	var tmp = $('<option></option>');
	tmp.attr('value', $('#fundingOrgName').val());
	tmp.text($('#fundingOrgName').val());
	tmp.appendTo('#fundSelect');
	$('select').material_select();
});




