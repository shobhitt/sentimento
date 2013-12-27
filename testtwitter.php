<?php
	require_once('TwitterAPIExchange.php');
    require_once('engine.php');
    $settings = array(
	    'oauth_access_token' => "86331448-LW6zu086VLfB3HHNtFDGZhYyF2nhrhaC02kFw2viT",
	    'oauth_access_token_secret' => "bWtRlRzLiRunVavkBM1X6rFcatvZ03VWhH6DdfFbf859a",
	    'consumer_key' => "AP4m24euK8Z8RjaVuc3CTg",
	    'consumer_secret' => "md6PN6SxSpgQ1HWrFgN12TprF3wIhCYnBzxOGXU"
	);
	
	session_start();
	$_SESSION['request_id']=generateId('rq');
	$_SESSION['type']='twitter';
	
	$con=mysqli_connect("localhost","root","","sentimento");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
else{
	echo "connected";
}
	$search=$_GET['search'];
	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$getfield = '?q='.$search.'&result_type=mixed&count=100';
	$requestMethod = 'GET';
	$twitter = new TwitterAPIExchange($settings);
	
	$data=json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(),true);
//	$data=$twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
//	var_dump($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest());    
//	var_dump($data['statuses']);
	foreach ($data['statuses'] as $tweets){
  		$time=date_parse(($tweets['created_at']));
		$date=mktime($time['hour'],$time['minute'],$time['second'],$time['month'],$time['day'],$time['year']);
		//var_dump($time);
		$ndate=date('Y-m-d H:i:s',$date);
		$retweet=$tweets['retweet_count'];
		$text=addslashes($tweets['text']);
		$id=$tweets['id_str'];
		$id=$_SESSION['request_id'];
		
		$sql="INSERT INTO twitter_input VALUES ('".generateId('twitter')."','$text','$ndate',$retweet,'$id')";
		echo $sql;
		if (!mysqli_query($con,$sql))
		  {
		  die('Error: ' . mysqli_error($con));
		  }	
		  
		
	}	 
	$result = mysqli_query($con,"SELECT * FROM twitter_input;");
	//var_dump($result);
	// while($row = mysqli_fetch_array($result))
	  // {
	  // echo $row['text'] . " " . $row['request_id'];
	  // echo "<br>";
	  // }
	engine($result,'twitter');
	header("Location: result.html");
	 
?>