<html>
<head>
<script type="text/javascript">
<!--
window.location = "result.php"
//-->
</script>
</head>
<body>
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
	
	//$con=mysqli_connect("localhost","root","","sentimento");
	$con=mysqli_connect("ec2-23-21-211-172.compute-1.amazonaws.com","sentdb","sentdb","sentimento");
// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
	else{
		echo "connected";
	}
	$search=$_GET['search'];
	$_SESSION['search']=$search;
	$url = 'https://api.twitter.com/1.1/search/tweets.json';
	$getfield = '?q='.$search.'&result_type=mixed&count=100';
	$requestMethod = 'GET';
	$twitter = new TwitterAPIExchange($settings);
	
	$data=json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(),true);
	var_dump($data);
	//$data=$twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
//	var_dump($data);
	//	$data=$twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
//	var_dump($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest());    
//	var_dump($data['statuses']);
// 
// <?php
	// require_once('TwitterAPIExchange.php');
    // require_once('engine.php');
//     
    // $settings = array(
	    // 'oauth_access_token' => "86331448-WCeaAkt8BjFHB8JtsBUC6tU0BCA2QOTecTqZHNIvE",
	    // 'oauth_access_token_secret' => "rlQfdv7N22uIOy9cpFpq9L9YDaxnKVoh8YT62JDlce779",
	    // 'consumer_key' => "UyvaO6JWsmNkwreIW1TXKQ",
	    // 'consumer_secret' => "vlVoxISvqf1WT5vKapSuXDmfh4iSOpVDbqjAJGvFXD0"
	// );
// 	
	// session_start();
	// $_SESSION['request_id']=generateId('rq');
	// $_SESSION['type']='twitter';
// 	
	// $con=mysqli_connect("localhost","root","","sentimento");
// 
	// // Check connection
	// if (mysqli_connect_errno())
	  // {
	  // echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  // }
// 	
	// $search=$_GET['search'];
	// $_SESSION['search']=$_GET['search'];
	// $url = 'https://api.twitter.com/1.1/search/tweets.json';
	// $getfield = '?q='.$search.'&result_type=mixed&count=100';
	// var_dump($getfield);
	// $requestMethod = 'GET';
	// $twitter = new TwitterAPIExchange($settings);
// 	
	// //$data=json_decode($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest(),true);
	// $data=($twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest());
	// var_dump($data);
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
	$result = mysqli_query($con,"SELECT * FROM twitter_input where request_id='".$_SESSION['request_id']."';");
	mysqli_close($con);
	engine($result,'twitter');
	
//	header("Location: http://sentimento.cloudcontrolled.com/result.php");
	 
?>
</body>
</html>
