
<?php 


$servername = "localhost";
$username = "root";
$password = "root";

   try {
	    $conn = new PDO("mysql:host=$servername;dbname=aut", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    echo "Connected successfully<br>"; 

	    $stmt = $conn->prepare("SELECT * FROM funding_org"); 
	    $stmt->execute();

	    // set the resulting array to associative
	    $GLOBALS['result'] = $stmt->fetchAll(); 

	    $stmt = $conn->prepare("SELECT distinct funding_org_country FROM funding_org"); 
	    $stmt->execute();

	    // set the resulting array to associative
	    $GLOBALS['countries'] = $stmt->fetchAll();
   	
   } catch (Exception $e) {
   		echo $e->getMessage();
   }



	
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Import page</title>
 	<link rel="stylesheet" href="./css/materialize.css">

    <script src="./js/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
     <script src="./js/materialize.min.js"></script>
    <script type="text/javascript">
    	jQuery(document).ready(function($) {

    		$('select').material_select();


    		$('#addNewOrg').click(function(event) {
    			var fund_org_existing = $('#fund_org_existing').val();
    			var fund_org_new = $('#fund_org_new').val();
    			var fund_country_existing = $('#fund_country_existing').val();
    			var fund_country_new = $('#fund_country_new').val();
    			$.ajax({
    				url: './ajax.php',
    				type: 'post',
    				dataType: 'html',
    				data: {fund_org_existing: fund_org_existing, 
    					   fund_org_new: fund_org_new,
    					   fund_country_existing: fund_country_existing,
    					   fund_country_new: fund_country_new
    				},
    			})
    			.done(function(data) {
    				if(data=='0'){
    				 Materialize.toast('Fund organization succusfully inserted', 4000);
    				console.log("success");
    				 setTimeout(location.reload(), 3000);
    				} else 
    					 Materialize.toast('Fund organization not inserted', 4000);
    			})
    			.fail(function() {
    				 Materialize.toast('Fund organization not inserted', 4000);
    				console.log("error");
    			})
    			.always(function() {
    				console.log("complete");
    			});
    			
    		});
    	});
    </script>
 </head>
 <body class="blue">
 	<div class="container">
 		<div class="card col s8 offset-s2">
 			<div class="row">
 				<div class="card-header center col s10 offset-s1"><h2>Import your tables</h2></div><br>
 			</div><br>
 			<h4 class="center" class="col s8 offset-s2">Specify the cell in which your <strong>Fund name</strong> resides</h4><br>
 			<form class="container" method="post" enctype="multipart/form-data" action="./function.php">
 				<div class="row">
 					<div class="input-field col s6">
			          <input name="fund_name" placeholder="for example D2" id="fund_name" type="text" class="validate">
			          <label for="fund_name">Fund Name Cell</label>
			        </div>
	 				
	 				<div class="file-field input-field col s6">
				      <div class="btn">
				        <span>File</span>
				        <input type="file" name="upFile">
				      </div>
				      <div class="file-path-wrapper">
				        <input class="file-path validate" type="text">
				      </div>
				    </div>

				    <div class="input-field col s12">
			          <select name="fund_org_existing" id="fund_org_existing" type="" class="validate">
			          	<?php 
			          		 foreach ($GLOBALS['result'] as $row) {
	    							echo "<option value=".$row['funding_org_id'].">".$row['funding_org_name']." - ".$row['funding_org_country']."</option>";
							    }
			          	 ?>
			          </select>
			          <label for="fund_org_existing">Choose from existing Fund organization</label>
			        </div>
			        <h3 class="center col s4 offset-s4">OR</h3><br>
			        <div class="input-field col s6">
			          <input name="fund_org_new"  id="fund_org_new" type="text" class="validate">
			          <label for="fund_org_new">Add a new fund organization</label>
			        </div>

			        <div class="input-field col s6">
			          <select name="fund_country_existing" id="fund_country_existing" >
			          	<?php 
			          		 foreach ($GLOBALS['countries'] as $row) {
	    							echo "<option value=".$row['funding_org_country'].">".$row['funding_org_country']."</option>";
							    }
			          	 ?>
			          </select>
			          <label for="fund_org_existing">Choose a country from existing countries</label>
			        </div>
			        <h3 class="center col s4 offset-s4">OR</h3><br>
			        <div class="input-field col s6 offset-s3">
			          <input name="fund_country_new"  id="fund_country_new" type="text" class="validate">
			          <label for="fund_country_new">Add a new country </label>
			        </div>

			        <div class="row">
			        	<div id="addNewOrg" class="btn green col s12">Add this new funding org</div>
			        </div>

 				</div>	
 				
 				<div class="row">
 					<input name="sub" type="submit" class="btn btn-large green center col s6 offset-s3" value="Submit"></input>
 				</div>
 			</form>
 		</div>
 	</div>
   
 </body>
 </html>