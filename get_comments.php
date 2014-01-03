<?php
	require_once('engine.php');
	
    session_start();
	$_SESSION['request_id']=generateId('rq');
	$_SESSION['type']='spice';
	$con=mysqli_connect("mysqlsdb.co8hm2var4k9.eu-west-1.rds.amazonaws.com","dep2kkpyk4s","7isEkD3bRUFa","dep2kkpyk4s");
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	$output=$_SESSION['xml'];
	//var_dump($output);
	//var_dump($_POST['message']);
	$xml = simplexml_load_string($output);
//	var_dump($_GET['message']);
	foreach ($xml->message as $messages){
			
			if($messages->id==$_GET['message']){
			//	echo "message mein aa gaya ";
				$spicemessage=$messages->content;
				
				$_SESSION['message']=(string)$spicemessage;
				 //var_dump($messages->content);
				 foreach($messages->messages as $comment){
				 	foreach($comment->message as $message){
						$text=addslashes($message->content);
						$id=$_SESSION['request_id'];
						//$now = new DateTime();
						//echo $now->format('Y-m-d H:i:s');    // MySQL datetime format
						// $date=$now->getTimestamp();
						// $ndate=date('Y-m-d H:i:s',$date);
						$ndate=date($message->{'created-at'});
						$like=intval($message->{'likes-count'});
						$sql="INSERT INTO spice_input VALUES ('".generateId('sp')."','$text','$ndate',$like,'$id')";	
						if (!mysqli_query($con,$sql))
						  {
						  die('Error: ' . mysqli_error($con));
						  }	
				 	}			
  			 }
		}
	}
	$result = mysqli_query($con,"SELECT * FROM spice_input where request_id='".$_SESSION['request_id']."';");
	//var_dump($result);
	// while($row = mysqli_fetch_array($result))
	  // {
	  // echo $row['text'] . " " . $row['request_id'];
	  // echo "<br>";
	  // }
	 
	//echo mysql_num_rows($result);
	if(mysqli_affected_rows( $con )!=0){
		mysqli_close($con);
		engine($result,'spice');
		
		//header("Location: result.php");
	}else{
		echo "The message does not have any comments";
	}
	
	
	
?>