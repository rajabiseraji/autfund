$(document).ready(function() {
        $('body').addClass('loaded');



          var ss = $('#tag option').toArray();
         

          var q = [];
          for (var i = ss.length - 1; i >= 0; i--) {
            q.push($(ss[i]).text());
          }
          var qq = q.sortVersions();
          for (var i = qq.length - 1; i >= 0; i--) {
            qq[i] = qq[i].replace(".NaN", "");
            console.log(qq[i]);
          }

          $('#tag').empty();
          // $('#fund_tag_parent .select-dropdown').empty();



          var i = 0;
          var ll = qq.length;
          qq.reverse();
          while(qq.length != 0) {
            if($(ss[i]).attr('id') == qq[qq.length-1]){
              console.log(qq.pop());
              $('#tag').append($(ss[i]));
            }
            i++;
            i %= ll;
          }

           $('select').material_select(); 

           var ss = $('#fund_tag_parent .dropdown-content span').toArray();
             for (var i = ss.length - 1; i >= 0; i--) {
                  if($(ss[i]).text().match(/[0-9]+\.+[0-9]+\.+[0-9]+\.+[0-9]+/))
                      $(ss[i]).css('paddingLeft', '5%');
                  else if($(ss[i]).text().match(/[0-9]+\.+[0-9]+\.+[0-9]+/)){
                      $(ss[i]).css('paddingLeft', '4%'); 
                  }
                  else if($(ss[i]).text().match(/[0-9]+\.+[0-9]+/)){
                    $(ss[i]).css('paddingLeft', '3%'); 
                  }
                     
          } 


          initStuff();




});

document.ff = new Array();


// $('[id *= "_check"]').change(function(event) {
// 	var tmp = $(this).attr('id');
// 	if($(this).is(':checked')){
// 		if(document.ff[tmp]){
// 			document.ff[tmp].attr({'required': true});
// 			document.ff[tmp].fadeIn(500);
// 			$('#firstRow').append(document.ff[tmp]);
// 		}
// 	} else{
// 		$('#'+tmp.replace('_check', '_parent')).fadeOut('1000', function() {
// 			document.ff[tmp] = $('#'+tmp.replace('_check', '_parent')).detach();
// 		});
// 	}
// 		if($('[id*="_parent"]').length == 0)
// 			$('#subbutt').addClass('disabled');
// 		else
// 			$('#subbutt').removeClass('disabled')

// });






function appendAtag(tag){
	var ss = $('#tag option').toArray();
         var newTag = $(ss[1]).clone();
         $(newTag).attr({
         	value: tag.tag_id,
         	id: tag.tag_real
         });
         $(newTag).text(tag.tag_real + " - "+ tag.tag_desc);
         ss.push(newTag);

          var q = [];
          for (var i = ss.length - 1; i >= 0; i--) {
            q.push($(ss[i]).text());
          }
          var qq = q.sortVersions();
          for (var i = qq.length - 1; i >= 0; i--) {
            qq[i] = qq[i].replace(".NaN", "");
            console.log(qq[i]);
          }

          $('#tag').empty();
          // $('#fund_tag_parent .select-dropdown').empty();



          var i = 0;
          var ll = qq.length;
          qq.reverse();
          while(qq.length != 0) {
            if($(ss[i]).attr('id') == qq[qq.length-1]){
              console.log(qq.pop());
              $('#tag').append($(ss[i]));
            }
            i++;
            i %= ll;
          }

           $('select').material_select(); 

           var ss = $('#fund_tag_parent .dropdown-content span').toArray();
             for (var i = ss.length - 1; i >= 0; i--) {
                  if($(ss[i]).text().match(/[0-9]+\.+[0-9]+\.+[0-9]+\.+[0-9]+/))
                      $(ss[i]).css('paddingLeft', '5%');
                  else if($(ss[i]).text().match(/[0-9]+\.+[0-9]+\.+[0-9]+/)){
                      $(ss[i]).css('paddingLeft', '4%'); 
                  }
                  else if($(ss[i]).text().match(/[0-9]+\.+[0-9]+/)){
                    $(ss[i]).css('paddingLeft', '3%'); 
                  }
                     
          } 


}


function sortTags(){
      var ss = $('#tag option').toArray();

          var q = [];
          for (var i = ss.length - 1; i >= 0; i--) {
            q.push($(ss[i]).text());
          }
          var qq = q.sortVersions();
          for (var i = qq.length - 1; i >= 0; i--) {
            qq[i] = qq[i].replace(".NaN", "");
            console.log(qq[i]);
          }

          $('#tag').empty();
          // $('#fund_tag_parent .select-dropdown').empty();



          var i = 0;
          var ll = qq.length;
          qq.reverse();
          while(qq.length != 0) {
            if($(ss[i]).attr('id') == qq[qq.length-1]){
              console.log(qq.pop());
              $('#tag').append($(ss[i]));
            }
            i++;
            i %= ll;
          }

           $('select').material_select(); 

           var ss = $('#fund_tag_parent .dropdown-content span').toArray();
             for (var i = ss.length - 1; i >= 0; i--) {
                  if($(ss[i]).text().match(/[0-9]+\.+[0-9]+\.+[0-9]+\.+[0-9]+/))
                      $(ss[i]).css('paddingLeft', '5%');
                  else if($(ss[i]).text().match(/[0-9]+\.+[0-9]+\.+[0-9]+/)){
                      $(ss[i]).css('paddingLeft', '4%'); 
                  }
                  else if($(ss[i]).text().match(/[0-9]+\.+[0-9]+/)){
                    $(ss[i]).css('paddingLeft', '3%'); 
                  }
                     
          } 
}



function initStuff(){
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
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var newTitle = $('#resAreaTitle').val();
  $.ajax({
    url: '/researchInsert',
    type: 'post',
    dataType: 'html',
    data: {_token: CSRF_TOKEN, newTitle: newTitle },
  })
  .done(function(data) {
    Materialize.toast('Inserted!', 4000) ;

    $('#fund_resArea_parent').empty();
    $('#fund_resArea_parent').append(data);
      $('select').material_select();
      $('.modal').modal();
      initStuff();
    console.log("success");
  })
  .fail(function() {
     Materialize.toast('not inserted', 4000);
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
  
});


$('#editResArea').on('click', function(event) {
  event.preventDefault();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var newTitle = $('#resAreaTitleNew').val();
  var resSelectNew = $('#resSelectNew').val();
  $.ajax({
    url: '/researchEdit',
    type: 'post',
    dataType: 'html',
    data: {_token: CSRF_TOKEN, newTitle: newTitle, resSelectNew: resSelectNew },
  })
  .done(function(data) {
    if(data == 'not'){
      Materialize.toast('not inserted', 4000);
    } else {
        Materialize.toast('Inserted!', 4000) ;

        $('#fund_resArea_parent').empty();
        $('#fund_resArea_parent').append(data);
          $('select').material_select();
          $('.modal').modal();
          initStuff();
        console.log("success");
  }
  })
  .fail(function() {
     Materialize.toast('not inserted', 4000);
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
  
});


$('#deleteResArea').on('click', function(event) {
  event.preventDefault();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var resSelectNew = $('#resSelectNew').val();
  $.ajax({
    url: '/researchDelete',
    type: 'post',
    dataType: 'html',
    data: {_token: CSRF_TOKEN,resSelectNew: resSelectNew },
  })
  .done(function(data) {
    if(data == 'not'){
      Materialize.toast('not inserted', 4000);
    } else {
        Materialize.toast('Inserted!', 4000) ;

        $('#fund_resArea_parent').empty();
        $('#fund_resArea_parent').append(data);
          $('select').material_select();
          $('.modal').modal();
          initStuff();
        console.log("success");
  }
  })
  .fail(function() {
     Materialize.toast('not inserted', 4000);
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
  
});


$('#insTag').on('click', function(e){
  e.preventDefault();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var parID = $('#parentID').val();
  var tagTitle = $('#tagTitle').val();
$.ajax({
    url: '/home',
    async: true,
    type: 'POST',
    data: {_token: CSRF_TOKEN, parentID: parID, tagTitle: tagTitle}

}).done(function(data){
  // console.log(data.tag_real);
  // appendAtag(data);
  
  $('#fund_tag_parent').empty();
  $('#fund_tag_parent').append(data);
      $('select').material_select();
      $('.modal').modal();
      initStuff();
      sortTags();
  Materialize.toast('Succusfully changed', 4000);
});

});


$('#renameTag').on('click', function(e){
  e.preventDefault();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var tagIdEdit = $('#tagIdEdit').val();
  var tagTitleEdit = $('#tagTitleEdit').val();
$.ajax({
    url: '/tagEdit',
    async: true,
    type: 'POST',
    data: {_token: CSRF_TOKEN, tagIdEdit: tagIdEdit, tagTitleEdit: tagTitleEdit}

}).done(function(data){
  // console.log(data);
  $('#fund_tag_parent').empty();
  $('#fund_tag_parent').append(data);
      $('select').material_select();
      $('.modal').modal();
      initStuff();
      sortTags();
  Materialize.toast('Succusfully changed', 4000);

  // location.reload();
}).fail(function() {
     Materialize.toast('not changed', 4000);
    console.log("error");
  });

});

$('#deleteTag').on('click', function(e){
  e.preventDefault();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var tagIdEdit = $('#tagIdEdit').val();
  var tagTitleEdit = $('#tagTitleEdit').val();
$.ajax({
    url: '/tagDelete',
    async: true,
    type: 'POST',
    data: {_token: CSRF_TOKEN, tagIdEdit: tagIdEdit, tagTitleEdit: tagTitleEdit}

}).done(function(data){
  console.log(data);
  $('#fund_tag_parent').empty();
  $('#fund_tag_parent').append(data);
    $('.modal').modal();
      $('select').material_select();
      sortTags();
      initStuff();
    Materialize.toast('Succusfully Deleted', 4000);
}).fail(function() {
     Materialize.toast('not changed', 4000);
    console.log("error");
  });

});



$('#renameCountry').on('click', function(e){
  e.preventDefault();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var CountrySelectEdit = $('#CountrySelectEdit').val();
  var CountryTitleEdit = $('#CountryTitleEdit').val();
$.ajax({
    url: '/CountryEdit',
    async: true,
    type: 'POST',
    data: {_token: CSRF_TOKEN, CountrySelectEdit: CountrySelectEdit, CountryTitleEdit: CountryTitleEdit}

}).done(function(data){
  console.log(data);
  // $('#fund_Country_parent').empty();
  // $('#fund_Country_parent').append(data);
  
  // location.reload();
});

});

$('#deleteCountry').on('click', function(e){
  e.preventDefault();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var CountrySelectEdit = $('#CountrySelectEdit').val();
  var CountryTitleEdit = $('#CountryTitleEdit').val();
  // alert('hiii');
$.ajax({
    url: '/CountryDelete',
    async: true,
    type: 'POST',
    data: {_token: CSRF_TOKEN, CountrySelectEdit: CountrySelectEdit, CountryTitleEdit: CountryTitleEdit}

}).done(function(data){
  console.log(data);
  // $('#fund_tag_parent').empty();
  // $('#fund_tag_parent').append(data);
  
  location.reload();
});

});

$('form').keypress(function(e) {
    if(e.which == 13) {
        e.preventDefault();
    }
});

$('#insFundOrg').on('click', function(event) {
  event.preventDefault();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var fundingOrgName = $('#fundingOrgName').val();
  var newCountry = $('#newCountry').val();
  var country = $('#country').val();
$.ajax({
    url: '/fundOrgInsert',
    async: true,
    type: 'POST',
    data: {_token: CSRF_TOKEN, fundingOrgName: fundingOrgName, country: country, newCountry: newCountry}

}).done(function(data){
  console.log(data);
  $('#fund_org_parent').empty();
  $('#fund_org_parent').append(data);
    $('.modal').modal();
      $('select').material_select();
      initStuff();
    Materialize.toast('Succusfully Inserted', 4000);
}).fail(function() {
     Materialize.toast('not changed', 4000);
    console.log("error");
  });

});


$('#editFundOrgSub').on('click', function(event) {
  event.preventDefault();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var fundingOrgName = $('#fundingOrgNameEdit').val().split("-")[0];
  var countryEditSelect = $('#fundingOrgNameEdit').val().split("-")[1];
  var newNameEdit = $('#newNameEdit').val();
  var newCountryEdit = $('#countryEditSelector').val();
  var typeNewCountry = $('#typeNewCountry').val();
$.ajax({
    url: '/fundOrgEdit',
    async: true,
    type: 'POST',
    data: {_token: CSRF_TOKEN, fundingOrgName: fundingOrgName, countryEditSelect: countryEditSelect,
     newNameEdit: newNameEdit, newCountryEdit: newCountryEdit, typeNewCountry: typeNewCountry}

}).done(function(data){
  if(data == 'not'){
     Materialize.toast('not changed', 4000, 'toasts');
    console.log("error");
  } else {
        console.log(data);
        $('#fund_org_parent').empty();
        $('#fund_org_parent').append(data);
          $('.modal').modal();
            $('select').material_select();
            initStuff();
          Materialize.toast('Succusfully Updated', 4000, 'toasts');
  }
}).fail(function() {
     Materialize.toast('not changed', 4000, 'toasts');
    console.log("error");
  });

});


$('#deleteFundOrg').on('click', function(event) {
  event.preventDefault();
  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  var fundingOrgName = $('#fundingOrgNameEdit').val().split("-")[0];
  var countryEditSelect = $('#fundingOrgNameEdit').val().split("-")[1];
    var toastContent = $('<div class="col s6 offset-s3">You can\'t delete the organization, it has some funds depending on it</div>');
$.ajax({
    url: '/fundOrgDelete',
    async: true,
    type: 'POST',
    data: {_token: CSRF_TOKEN, fundingOrgName: fundingOrgName, countryEditSelect: countryEditSelect}

}).done(function(data){
  if(data == 'not'){
     Materialize.toast(toastContent, 4000, 'toasts');
    console.log("error");
  } else {
        // console.log(data);
        $('#fund_org_parent').empty();
        $('#fund_org_parent').append(data);
          $('.modal').modal();
            $('select').material_select();
            initStuff();
          Materialize.toast('Succusfully Deleted', 4000, 'toasts');
  }
}).fail(function() {
     Materialize.toast(toastContent, 4000, 'toasts');
    console.log("error");
  });

});

$('#toggleAddCountry').click(function(event) {
  event.preventDefault();
  $('#toggleContainer').toggleClass('hide');  
});

}




