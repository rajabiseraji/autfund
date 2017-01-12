<?php 

	

$servername = "localhost";
$username = "root";
$password = "root";
   if(!empty($_POST['fund_org_new']) || !empty($_POST['fund_country_new'])){
   		if(empty($_POST['fund_country_existing']))
   			echo 'existing'.$_POST['fund_country_existing'];
   		else{
			   	try {
				    $c = new PDO("mysql:host=$servername;dbname=aut", $username, $password);
				    // set the PDO error mode to exception
				    $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				    // echo "connected successfully<br>"; 

				    if(!empty($_POST['fund_country_new']))
				    	$country = $_POST['fund_country_new'];
				    else 
				    	$country = $_POST['fund_country_existing'];

				    $stmt = $c->prepare("SELECT funding_org_name, funding_org_country FROM funding_org Where funding_org_name = :forg and funding_org_country = :fcountry"); 
				    $stmt->bindParam(':forg', $_POST['fund_org_new']);
				    $stmt->bindParam(':fcountry', $country);
				    $stmt->execute();

				    // set the resulting array to associative
				    $res = $stmt->fetchAll(); 

				    if(!empty($res))
				    	echo 'not empty res';
				    else {
				    	$stmt = $c->prepare("INSERT INTO funding_org(funding_org_name, funding_org_country) VALUES (:forg, :fcountry)"); 
					    $stmt->bindParam(':forg', $_POST['fund_org_new']);
					    $stmt->bindParam(':fcountry', $country);
					    $stmt->execute();
					    echo 0;
				    }
			   	
			   } catch (Exception $e) {
			   		echo $e->getMessage();
			   		echo 1;
			   }
   		}
   }


 ?>
