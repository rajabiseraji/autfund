<?php 
include 'classes/PHPExcel/IOFactory.php';





if(isset($_POST["sub"])) {
	$target_dir = "./uploads/";
	$target_file = $target_dir . basename($_FILES["upFile"]["name"]);

	 if (move_uploaded_file($_FILES["upFile"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["upFile"]["name"]). " has been uploaded.<br>";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }

	$fund_name_cell = $_POST["fund_name"];
	$fund_org_existing = $_POST["fund_org_existing"];
}






$servername = "localhost";
$username = "root";
$password = "root";

    $conn = new PDO("mysql:host=$servername;dbname=aut", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully<br>"; 


$servername = "localhost";
$username = "root";
$password = "root";

    $conntwo = new PDO("mysql:host=$servername;dbname=aut", $username, $password);
    // set the PDO error mode to exception
    $conntwo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



	$inputFileName = './uploads/'.$_FILES["upFile"]["name"];

//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

//  Loop through each row of the worksheet in turn
for ($sh = 1; $sh <= $objPHPExcel->getSheetCount()-1; $sh++){ 
	
	$sheet = $objPHPExcel->getSheet($sh); 

	$rows = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

	$fund_name_row = preg_replace("/[^a-zA-Z]/", "", $fund_name_cell);
	$fund_name_col = (int) (preg_replace("/[^0-9]/", "", $fund_name_cell));

	$base_row = array_search($fund_name_row, $rows);
	#B3  - D2 is default base
 	$tmpData[$sh]['fund_name'] = $sheet->getCell($rows[$base_row].$fund_name_col.'')->getValue();
 	$tmpData[$sh]['rating'] = $sheet->getCell($rows[$base_row+2].($fund_name_col-1).'')->getValue();
 	$tmpData[$sh]['fund_id'] = $sheet->getCell($rows[$base_row+4].($fund_name_col-1).'')->getValue();
 	$tmpData[$sh]['related_IDs'] = $sheet->getCell($rows[$base_row+6].($fund_name_col-1).'')->getValue();
 	$tmpData[$sh]['fund_acceptence'] = $sheet->getCell($rows[$base_row+2].($fund_name_col+1).'')->getValue();
 	$tmpData[$sh]['Funding_org'] = $sheet->getCell($rows[$base_row+4].($fund_name_col+1).'')->getValue();
 	$tmpData[$sh]['fund_research_area'] = $sheet->getCell($rows[$base_row+6].($fund_name_col).'')->getValue();
 	$tmpData[$sh]['fund_program_description'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+1).'')->getValue();
 	$tmpData[$sh]['Duration'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+2).'')->getValue();
 	$tmpData[$sh]['Financial_support'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+3).'')->getValue();
 	$tmpData[$sh]['Requirements'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+4).'')->getValue();
 	$tmpData[$sh]['Deadline'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+5).'')->getValue();
 	$tmpData[$sh]['Link1'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+6).'')->getValue();
 	$tmpData[$sh]['Link2'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+7).'')->getValue();
 	$tmpData[$sh]['Memo'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+8).'')->getValue();
 	$tmpData[$sh]['Farsi_desc'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+9).'')->getValue();
 	$tmpData[$sh]['Tag'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+10).'')->getValue();
 	$tmpData[$sh]['Comments'] = $sheet->getCell($rows[$base_row+1].($fund_name_col+11).'')->getValue();
 	
 	if(empty($tmpData[$sh]['fund_name'])){
 		$tmpData[$sh]['fund_name'] = 'undone';
 		$tmpData[$sh]['Comments'] = 'undone - name';
 	}
 	if(empty($tmpData[$sh]['rating'])){
 		$tmpData[$sh]['rating'] = '1';
 		$tmpData[$sh]['Comments'] = 'undone - rating';

 	} 
 	 if(empty($tmpData[$sh]['Funding_org'])){
 	 // 	$tmpData[$sh]['Funding_org'] = 'DAAD';
 		// $tmpData[$sh]['Comments'] = 'undone - fund_org';

 	 } if(empty($tmpData[$sh]['fund_research_area'])){
 	 	$tmpData[$sh]['fund_research_area'] = '1';
 		$tmpData[$sh]['Comments'] = 'undone - research';

 	 } if(empty($tmpData[$sh]['Farsi_desc'])){
 	 	$tmpData[$sh]['Farsi_desc'] = 'ناقص';
 		$tmpData[$sh]['Comments'] = 'undone - farsi_desc';
	}
 
 	#tags 
 	
 	$tagTmp = $tmpData[$sh]['Tag'];
 	if(empty($tagTmp)){
 		$tmpData[$sh]['Tag'] = '1';
 		$tmpData[$sh]['Comments'] = 'undone - tag';
 	}
 	$tagArray = explode(", ", $tagTmp);
 	foreach ($tagArray as $x) {
 		$x = addslashes($x);
 	}

 	} #end of first for (for over sheets)


// }




	$stmt = $conn->prepare("INSERT INTO funds(fund_name,fund_id, fund_program_description, rating, fund_acceptence, duration, deadline, requirements, link1, link2, memo, farsi_desc, comments, financial_support, funding_org_code) VALUES(:fund_name,:fund_id, :fund_program_description, :rating, :fund_acceptence, :duration, :deadline, :requirements, :link1, :link2, :memo, :farsi_desc, :comments, :financial_support, :fund_org_code)");
	$stmt->bindParam(':fund_name', $f1);
	$stmt->bindParam(':fund_id', $f2);
	$stmt->bindParam(':fund_program_description', $f3);
	$stmt->bindParam(':rating', $f4);
	$stmt->bindParam(':fund_acceptence', $f5);
	// $stmt->bindParam(':fund_research_area', $f6);
	$stmt->bindParam(':duration', $f7);
	$stmt->bindParam(':requirements', $f8);
	$stmt->bindParam(':deadline', $f9);
	$stmt->bindParam(':link1', $f10);
	$stmt->bindParam(':link2', $f11);
	$stmt->bindParam(':memo', $f12);
	$stmt->bindParam(':farsi_desc', $f13);
	$stmt->bindParam(':comments', $f14);
	$stmt->bindParam(':financial_support', $f15);
	$stmt->bindParam(':fund_org_code', $fund_org_existing);
	for($u = 1; $u < count($tmpData) ; $u++){ #iterate in order to execute queries
		
	echo "Now inserting table ".$tmpData[$u]['fund_id'].' - '.$tmpData[$u]['fund_name'];
	echo "<br>";
	try{


			$f1 = addslashes($tmpData[$u]['fund_name']);
			$f2 = addslashes($tmpData[$u]['fund_id']);
			$f3 = addslashes($tmpData[$u]['fund_program_description']);
			$f4 = addslashes($tmpData[$u]['rating']);
			$f5 = addslashes($tmpData[$u]['fund_acceptence']);
			// $f6 = addslashes($tmpData[$u]['fund_research_area']);
		
			
			$f7 = addslashes($tmpData[$u]['Duration']);
			$f8 = addslashes($tmpData[$u]['Requirements']);
			$f9 = addslashes($tmpData[$u]['Deadline']);
			$f10 = addslashes($tmpData[$u]['Link1']);
			$f11 = addslashes($tmpData[$u]['Link2']);
			$f12 = addslashes($tmpData[$u]['Memo']);
			$f13 = addslashes($tmpData[$u]['Farsi_desc']);
			$f14 = addslashes($tmpData[$u]['Comments']);
			$f15 = addslashes($tmpData[$u]['Financial_support']);
			$stmt->execute();
	} catch (PDOException $e){
	echo "There was a fatal problem in importing the fund ".$f2." - ". $f1. " :<br>";
	echo $e->getMessage();
	}



	} # end of inserting into "funds" table

	# beginning of "fund_resarea" table insertion 
	echo "Now Inserting fund and research area relations into fund_resarea table<br>";
	for($q = 1; $q < count($tmpData) ; $q++)
	{
		echo "Now inserting <strong>research</strong> areas for ". $tmpData[$q]['fund_id']. " - ". $tmpData[$q]['fund_name']."<br>";
		$st2 = $conn->prepare("INSERT INTO fund_resarea(fund_id, research_area_code) VALUES(:fund_id, :research_area_code)");	
		$st2->bindParam(':fund_id', $b1);
		$st2->bindParam(':research_area_code', $b2);

			$resAreas = trim($tmpData[$q]['fund_research_area']);
		 	$resAreaArray = explode(",", $resAreas);
		 	foreach ($resAreaArray as $y) 
		 	{
		 		$y = addslashes($y);
		 		// echo $y;
		 		// echo '<br>';
		 		// echo '<br>';
		 		// echo '<br>';
		 		// echo '<br>';
		 		// echo '<br>';
		 		// echo '<br>';
	 		}

	 		echo "<ul>";
			foreach ($resAreaArray as $value) 
			{	
				try {
					
					if(!$value){
						echo "This one doesn\'t have any research areas and <strong style='color: red'>has been marked</strong>"."<br>";
						$tmpData[$q]['Comments'] = "undone - research";
						$b1 = $tmpData[$q]['fund_id'];
						$b2 = '1';
						$st2 -> execute();
						continue;
					}
					echo "Trying to insert ".$value." for this fund";
					$b1 = $tmpData[$q]['fund_id'];
					$b2 = $value;
					$st2 -> execute();
					echo "<li>".$b2." is inserted for this fund</li>";
			
				} catch (Exception $e) {
					echo "</ul><br>";
					echo "This one had a problem while inserting research areas and <strong style='color: red'>has been marked</strong>. All is set as default<br>";
						echo $e->getMessage()."<br>";
						$tmpData[$q]['Comments'] = "undone - research";
						$stm = $conntwo->prepare("update funds set comments=:comments where fund_id = :fund_id");
						$stm->bindParam(':comments', $tmpData[$q]['Comments']);
						$stm->bindParam(':fund_id', $tmpData[$q]['fund_id']);
						$stm->execute();
						$b1 = $tmpData[$q]['fund_id'];
						$b2 = '1';
						$st2 -> execute();
						continue;
				}
			}



			echo "</ul>";
	}# end of the fund_resarea insertion

	echo "Now inserting related ID dependencies into id_map table<br>";
	
	for($q = 1; $q < count($tmpData) ; $q++)
	{
		echo "Now inserting <strong>Related IDs</strong> for ". $tmpData[$q]['fund_id']. " - ". $tmpData[$q]['fund_name'];
		$st3 = $conn->prepare("INSERT INTO id_map(fund_id, related_id) VALUES(:fund_id, :related_id)");	
		$st3->bindParam(':fund_id', $b3);
		$st3->bindParam(':related_id', $b4);

		$relatedID = trim($tmpData[$q]['related_IDs']);
		 	$relatedIDArray = explode(",", $relatedID);
		 	foreach ($relatedIDArray as $y) 
		 	{
		 		$y = addslashes($y);
		 		// echo $y;
		 		// echo '<br>';
		 		// echo '<br>';
		 		// echo '<br>';
		 		// echo '<br>';
		 		// echo '<br>';
		 		// echo '<br>';
	 		}

			echo "<ul>";
			foreach ($relatedIDArray as $value) 
			{
				if(!$value){
					echo "This one doesn\'t have any related IDs<br>";
					continue;
				}
				try {
					echo "</ul><br>";
					echo "Trying to insert ".$value." for this fund";
					$b3 = $tmpData[$q]['fund_id'];
					$b4 = $value;
					$st3 -> execute();
					echo "<li>".$b4." is related to this fund</li>";	
				} catch (Exception $e) {
					$tmpData[$q]['Comments'] = "undone - Related";
					$stm = $conntwo->prepare("update funds set comments=:comments where fund_id = :fund_id");
					$stm->bindParam(':comments', $tmpData[$q]['Comments']);
					$stm->bindParam(':fund_id', $tmpData[$q]['fund_id']);
					$stm->execute();
					echo "There was a problem while inserting related funds for this one, it<strong style='color: red'>has been marked</strong>.<br>: ";
					echo $e->getMessage()."<br>";
					continue;
				}
			}
			echo "</ul>";
	}

	echo "Now inserting Tags for each fund into fund_tag table<br>";

	for($q = 1; $q < count($tmpData) ; $q++)
	{
		echo "Now inserting <strong>Tags</strong> for ". $tmpData[$q]['fund_id']. " - ". $tmpData[$q]['fund_name']."<br>";

		$tagTmp = trim($tmpData[$q]['Tag']);
	 	$tagArray = explode(", ", $tagTmp);
	 	foreach ($tagArray as $x) 
	 	{
	 		$x = addslashes($x);
	 		// echo $x." <br> ".gettype($x);
	 	}


	 	 $st2 = $conn->prepare("INSERT INTO fund_tag(fund_id, tag_id) VALUES (:fund_id,(SELECT tag_id from tags where tag_real=:tag_real ))");	
		$st2->bindParam(':fund_id', $b3);
		$st2->bindParam(':tag_real', $b4);


		echo "<ul>";
	 	foreach ($tagArray as $value) 
	 	{
				
				if(!$value){
					echo "This one doesn\'t have any tags and <strong style='color: red'>has been marked</strong><br>";
					$tmpData[$q]['Comments'] = "undone - tag";
					$stm = $conntwo->prepare("update funds set comments=:comments where fund_id = :fund_id");
					$stm->bindParam(':comments', $tmpData[$q]['Comments']);
					$stm->bindParam(':fund_id', $tmpData[$q]['fund_id']);
					$stm->execute();
					$b3 = $tmpData[$q]['fund_id'];
					$b4 = '1';
					$st2 -> execute();
					continue;
				}
				try {
					echo "Trying to insert ".$value." for this fund";
					$b3 = $tmpData[$q]['fund_id'];
					$b4 = $value;
					$st2 -> execute();
					echo "<li>".$b4." is inserted as a tag for this fund</li>";
				} catch (Exception $e) {
					echo "There was a problem while inserting tags for this one, it<strong style='color: red'>has been marked</strong>. 1 inserted as default<br>: ";
					echo $e->getMessage()."<br>";
					$tmpData[$q]['Comments'] = "undone - tag";
					$stm = $conntwo->prepare("update funds set comments=:comments where fund_id = :fund_id");
					$stm->bindParam(':comments', $tmpData[$q]['Comments']);
					$stm->bindParam(':fund_id', $tmpData[$q]['fund_id']);
					$stm->execute();
					$b3 = $tmpData[$q]['fund_id'];
					$b4 = '1';
					$st2 -> execute();
					continue;
				}
		}
			

		echo "</ul>";
    }





 ?>
