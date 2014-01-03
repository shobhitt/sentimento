<?php
require('php-excel-reader/excel_reader2.php');
require('SpreadsheetReader.php');
require_once('engine.php');

session_start();

$con=mysqli_connect("localhost","root","","sentimento");

move_uploaded_file($_FILES["file"]["tmp_name"], $_FILES["file"]["name"] );
$_SESSION['request_id']=generateId('rq');
$_SESSION['type']='excel';

try
{
	$Spreadsheet = new SpreadsheetReader($_FILES["file"]["name"]);
	foreach ($Spreadsheet as $Key => $Row)
	{
			if(($Key)==0){
				
			}
			else {
				
				if ($Row)
					{
				//var_dump($Row);
					$text=$Row[0];
					$datearray=explode('-',$Row[1]);	
					$date=intval(mktime(0,0,0,$datearray[0],$datearray[1],$datearray[2]));
					$ndate=date('Y-m-d H:i:s',$date);
					var_dump($date);
					$id=$_SESSION['request_id'];
					$sql="INSERT INTO excel_input VALUES ('".generateId('excel')."','$text','$ndate','$id')";
					echo $sql;
					if (!mysqli_query($con,$sql))
					  {
					  die('Error: ' . mysqli_error($con));
					  }
											
				}
				
			}
	}
	
	
	$result = mysqli_query($con,"SELECT * FROM excel_input where request_id='".$_SESSION['request_id']."';");
	//$result = mysqli_query($con,"SELECT * FROM excel_input where request_id='rq52bd058f9fc70';");
	engine($result,'excel');
}catch (Exception $E){
		echo $E -> getMessage();
}

header("Location: result.php");


?>