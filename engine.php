<?php
	include 'sentiment.class.php';
	
	
   function engine($data,$method){
		 $sentiment = new Sentiment(); 
		$con=mysqli_connect("mysqlsdb.co8hm2var4k9.eu-west-1.rds.amazonaws.com","dep2kkpyk4s","7isEkD3bRUFa","dep2kkpyk4s");
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
			  	echo mysqli_error($con);
			  die('Error: ' . mysqli_error($con));
			  }
			  
				
	  }
		//var_dump($data);
		mysqli_close($con);
   }


	function generateId($type){
		$id=0;
		$random_id_length = 10; 

//generate a random id encrypt it and store it in $rnd_id 
$rnd_id = crypt(uniqid(rand(),1)); 

//to remove any slashes that might have come 
$rnd_id = strip_tags(stripslashes($rnd_id)); 

//Removing any . or / and reversing the string 
$rnd_id = str_replace(".","",$rnd_id); 
$rnd_id = strrev(str_replace("/","",$rnd_id)); 

//finally I take the first 10 characters from the $rnd_id 
$rnd_id = substr($rnd_id,0,$random_id_length); 	
		if($type==='fb'){
			$id='fb'.$rnd_id;
		}elseif($type==='twitter'){
			$id='tw'.$rnd_id;
		}elseif($type==='excel'){
			$id='ex'.$rnd_id;
		}elseif($type==='sp'){
			$id='sp'.$rnd_id;
		}else{
			$id='rq'.$rnd_id;
		}
		
		return $id;
	}
		
?>