  Array.prototype.sortVersions = function() {
                return this.map(function(e) {
                  return e.split('.').map(function(e) {
                    return parseInt(e)
                   }
                 )}).sort(function(a,b) {
                   for (var i = 0; i < Math.max(a.length, b.length); i++) { 
                     if (!a[i]) return -1; 
                     if (!b[i]) return 1; 
                     if (a[i]-b[i] != 0) return a[i]-b[i]; 
                   } 
                   return 0; 
                 }).map(function(e) {
                   return e.join('.')
                 });
                }



          


         $(document).ready(function() {
        

         $('ul.tabs').tabs();

         $('select').material_select();
         // $('textarea#program_desc').characterCounter();
         // $('.modal').modal();

         $('.modal').modal({
            complete: function(){
              $('#resAreaCode').val('');
              $('#resAreaTitle').val('');
            }
         });

         $('.chips-placeholder').material_chip({
            placeholder: 'Enter a tag',
            secondaryPlaceholder: '+Tag',
          });



          $('.button-collapse').sideNav({
              menuWidth: 280, // Default is 240
              edge: 'left', // Choose the horizontal origin
              closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
              draggable: true // Choose whether you can drag to open on touch screens
            }
        );

          $('.tooltipped').tooltip({delay: 50});




          // var ss = $('#tag option').toArray();
         

          // var q = [];
          // for (var i = ss.length - 1; i >= 0; i--) {
          //   q.push($(ss[i]).text());
          // }
          // var qq = q.sortVersions();
          // for (var i = qq.length - 1; i >= 0; i--) {
          //   qq[i] = qq[i].replace(".NaN", "");
          //   console.log(qq[i]);
          // }

          // $('#tag').empty();
          // // $('#fund_tag_parent .select-dropdown').empty();



          // var i = 0;
          // var ll = qq.length;
          // qq.reverse();
          // while(qq.length != 0) {
          //   if($(ss[i]).attr('id') == qq[qq.length-1]){
          //     console.log(qq.pop());
          //     $('#tag').append($(ss[i]));
          //   }
          //   i++;
          //   i %= ll;
          // }

          //  $('select').material_select(); 

          //  var ss = $('#fund_tag_parent .dropdown-content span').toArray();
          //    for (var i = ss.length - 1; i >= 0; i--) {
          //         if($(ss[i]).text().match(/[0-9]+\.+[0-9]+\.+[0-9]+\.+[0-9]+/))
          //             $(ss[i]).css('paddingLeft', '5%');
          //         else if($(ss[i]).text().match(/[0-9]+\.+[0-9]+\.+[0-9]+/)){
          //             $(ss[i]).css('paddingLeft', '4%'); 
          //         }
          //         else if($(ss[i]).text().match(/[0-9]+\.+[0-9]+/)){
          //           $(ss[i]).css('paddingLeft', '3%'); 
          //         }
                     
          // } 


          //  var ss = $('#parentID option').toArray();
         

          // var q = [];
          // for (var i = ss.length - 1; i >= 0; i--) {
          //   q.push($(ss[i]).text());
          // }
          // var qq = q.sortVersions();
          // for (var i = qq.length - 1; i >= 0; i--) {
          //   qq[i] = qq[i].replace(".NaN", "");
          //   console.log(qq[i]);
          // }

          // $('#parentID').empty();
          // // $('#fund_tag_parent .select-dropdown').empty();

          // var i = 0;
          // var ll = qq.length;
          // qq.reverse();
          // while(qq.length != 0) {
          //   if($(ss[i]).attr('id') == qq[qq.length-1]){
          //     console.log(qq.pop());
          //     $('#parentID').append($(ss[i]));
          //   }
          //   i++;
          //   i %= ll;
          // }

          //  $('select').material_select(); 

          //  var ss = $('#tagPar .dropdown-content span').toArray();
          //    for (var i = ss.length - 1; i >= 0; i--) {
          //         if($(ss[i]).text().match(/[0-9]+\.+[0-9]+\.+[0-9]+\.+[0-9]+/))
          //             $(ss[i]).css('paddingLeft', '5%');
          //         else if($(ss[i]).text().match(/[0-9]+\.+[0-9]+\.+[0-9]+/)){
          //             $(ss[i]).css('paddingLeft', '4%'); 
          //         }
          //         else if($(ss[i]).text().match(/[0-9]+\.+[0-9]+/)){
          //           $(ss[i]).css('paddingLeft', '3%'); 
          //         }
                     
          // } 

      });