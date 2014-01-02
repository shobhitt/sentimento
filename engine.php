<?php
	include 'sentiment.class.php';
	
	
   function engine($data,$method){
		 	echo "indide";
		 $sentiment = new Sentiment(); 
		// foreach( $data as $text)  		
		// $scores = $sentiment->score($text);
		$con=mysqli_connect("localhost","root","","sentimento");
		if (mysqli_connect_errno())
		  {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  }
		else{
			echo "connected";
		}
		while($row = mysqli_fetch_array($data))
	  	{
		  	$scores = $sentiment->score($row['text']);
			//var_dump($scores);
			$res= key($scores);
			$type=0;
			if($res==='neg'){
				$type=0;	
			}
			elseif ($res==='neu') {
				$type=1;
			}
			elseif ($res==='pos') {
				$type=2;
			}
			$time=date_parse(($row['created_on']));
			$date=mktime($time['hour'],$time['minute'],$time['second'],$time['month'],$time['day'],$time['year']);
			$ndate=date('Y-m-d H:i:s',$date);
			if($method==='twitter'){
				$sql="INSERT INTO twitter_output VALUES ('".$row['id']."','".addslashes($row['text'])."','".$ndate."',".$row['retweet_count'].",'".$row['request_id']."',".$type.")";
			}
			elseif ($method==='fb') {
				$sql="INSERT INTO facebook_output VALUES ('".$row['id']."','".addslashes($row['text'])."','".$ndate."',".$row['like_count'].",'".$row['request_id']."',".$type.")";	
			}elseif($method==='spice'){
				$sql="INSERT INTO spice_output VALUES ('".$row['id']."','".addslashes($row['text'])."','".$ndate."',".$row['like_count'].",'".$row['request_id']."',".$type.")";
			}elseif($method==='excel'){
				$sql="INSERT INTO excel_output VALUES ('".$row['id']."','".addslashes($row['text'])."','".$ndate."','".$row['request_id']."',".$type.")";
			}
			
			echo $sql;
			if (!mysqli_query($con,$sql))
			  {
			  die('Error: ' . mysqli_error($con));
			  }
			  
				
	  }
		//var_dump($data);
		
   }


	function generateId($type){
		$id=0;	
		if($type==='fb'){
			$id='fb'.uniqid();
		}elseif($type==='twitter'){
			$id='tw'.uniqid();
		}elseif($type==='excel'){
			$id='ex'.uniqid();
		}elseif($type==='sp'){
			$id='sp'.uniqid();
		}else{
			$id='rq'.uniqid();
		}
		
		return $id;
	}
	
?>