


  
	<!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta name="csrf-token" content="{{ csrf_token() }}" />

	<!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
  	<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>

  <!-- Compiled and minified JavaScript -->
  <script src="{{ asset('js/materialize.min.js') }}"></script>
        <script>

          



         $(document).ready(function() {
          
         $('select').material_select();
         $('textarea#program_desc').characterCounter();
         $('.modal').modal();

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


         $('#test').select2({
            placeholder: 'Select an option'
        });

          $('.button-collapse').sideNav({
              menuWidth: 280, // Default is 240
              edge: 'left', // Choose the horizontal origin
              closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
              draggable: true // Choose whether you can drag to open on touch screens
            }
        );

          $('.tooltipped').tooltip({delay: 50});


          var ss = $('.select-dropdown span').toArray();
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
            
          

        
          
        


      });
      </script> 

      <style type="text/css">
      #prel {
              position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: blue;
      }

      #spinner{
        position: absolute;
        top: 50%;
        left: 50%;
      }
      </style>

      <link rel="stylesheet" type="text/css" href="{{ asset('css/mine.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/normalize.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
  