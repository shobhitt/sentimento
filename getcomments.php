<?php
	require_once("facebook.php");
	require_once('engine.php');
	session_start();
	
	$con=mysqli_connect("localhost","root","","sentimento");
	
	
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	else{
		echo "connected";
	}

	$_SESSION['request_id']=generateId('rq');
	$_SESSION['type']='fb';
	$rid=$_SESSION['request_id'];
	  $config = array(
	      'appId' => '1458974224329503',
	      'secret' => 'eb702d38b46ac6600cfd27d0ef224883',
	      'fileUpload' => false, // optional
	      'allowSignedRequest' => false, // optional, but should be set to false for non-canvas apps
	  );

	  $facebook = new Facebook($config);
	  $messageid=$_GET['messageid'];
	  $url="$messageid?fields=comments.limit(100)";
	  
  
  	$ret = $facebook->api($url);

	foreach ($ret['comments']['data'] as $comment){
	  	$_SESSION['message']=(string)$comment['message'];
	  	$time=date($comment['created_time']);
	  	$likes=$comment['like_count'];
		$message=addslashes($comment['message']);
		$time=$comment['created_time'];
		$id=$comment['id'];
		$sql="INSERT INTO facebook_input VALUES ('".generateId('fb')."','$message','$time',$likes,'$rid')";
		echo $sql;
		if (!mysqli_query($con,$sql))
		  {
		  die('Error: ' . mysqli_error($con));
		  }
		
		  echo "<option value=$id>$message</option>	";
		  
	   
  	}
	 $result = mysqli_query($con,"SELECT * FROM facebook_input where request_id='".$_SESSION['request_id']."';");
	//var_dump($result);
	// while($row = mysqli_fetch_array($result))
	  // {
	  // echo $row['text'] . " " . $row['request_id'];
	  // echo "<br>";
	  // }
	engine($result,'fb');
	header("Location: result.html");
	
  ?>