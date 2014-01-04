<html>
	<title>
			Sentimento
		</title>
		<style>
			.maincontent{
				width:980px;
				margin: auto;
			}
			
			.footer {
			   position:fixed;
			   left:0px;
			   bottom:0px;
			   height:50px;
			   width:100%;
			   color:#303030;
			   font-size:15px;
			   padding:0px;
			   background:#dedede;
			   text-align: center;
			   font-family:"Arial Rounded MT Bold" ;
			}

			body{
				margin: 0px;
				padding: 0px;
			}
			
			.header{
				height: 40px;
				background: #222222;
				font-size: 25px;
				font-family: Helvetica;
				color:#aaaaaa;
				/*padding-top: 40px;*/
				width: 100%;
				padding-left: 20%;
				padding-top: 10px;
			}
			.icon{
				margin: 10px;
				padding: 10px;
				display: inline-block;
			}
			.option{
				margin:auto;
				width: 415px;
			}
			.databox{
				width: 400px;
				padding: 20px;
				margin: auto;
				border: solid #aaaaaa 1px;
				box-shadow: 2px 2px 2px 2px #f5f5f5;
				margin-top: 100px;
				
			}
			.top{
				padding: 20px;
				font-size: 30px;
				font-family: Verdana;
				text-align: center;
				padding-top: 50px;
				
			}
			
			a{
				text-decoration: none;
				color:#aaaaaa;
			}
			.options{
				font-size: 17px;
				padding-left: 500px;
				float: right;
				margin-top: -21px;
				padding-right: 50px;
			}
			
			table{
				border: 1px solid #ffffff;
				width:100%;
				
			}
			tr{
				margin: 2px;
				background: #eeeeee;
				padding: 10px;
			}
			td{
				padding:10px;
			}
		</style>
	</head>
	<body>
		
		<div class="header">
			<div style="width: 960px;float: left;">
			<div  >
				<a href="home.html">Sentimento</a>
			</div >
			<div  class="options">
				<a href="home.html">Spice</a> | <a href="home.html">Facebook</a> | <a href="home.html">Twitter</a> | <a href="home.html">Excel</a>
			</div>
			</div>
		</div>
		<div class="maincontent">
			<div style="margin:auto;font-family: Arial, Helvetica, sans-serif;font-size: 30px;padding: 10px;text-align: center">
				Facebook Analysis
			</div>
			
		<div style="text-align: center;">
<?php
	require_once("facebook.php");
	require_once('engine.php');
	session_start();
	
	//$con=mysqli_connect("localhost","root","","sentimento");
	$con=mysqli_connect("ec2-23-21-211-172.compute-1.amazonaws.com","sentdb","sentdb","sentimento");
	
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
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
	  $url="$messageid?fields=comments.limit(100),message";
	  
  
  	$ret = $facebook->api($url);
		$_SESSION['message']=(string)$ret['message'];
		if (isset($ret['comments'])){
		foreach ($ret['comments']['data'] as $comment){
	  	
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
	   
  	}
	 $result = mysqli_query($con,"SELECT * FROM facebook_input where request_id='".$_SESSION['request_id']."';");
	 
	 if(mysqli_affected_rows( $con )!=0){
		mysqli_close($con);
		engine($result,'fb');
		header("Location: http://sentimento.cloudcontrolled.com/result.php");
	}else{
		echo "The post does not have any comments";
	}
	//var_dump($result);
	// while($row = mysqli_fetch_array($result))
	  // {
	  // echo $row['text'] . " " . $row['request_id'];
	  // echo "<br>";
	  // }
	  $page=$_SESSION['page'];
	echo "<div>
	<a href='facetest.php?page=".$page."'>Choose Another Message</a>
</div>";
	
  ?>
  
  </div></div></body></html>
