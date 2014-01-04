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
				Spice Analysis
			</div>
			
		<div style="text-align: center;">
<?php
	require_once('engine.php');
	
    session_start();
	$_SESSION['request_id']=generateId('rq');
	$_SESSION['type']='spice';
	//$con=mysqli_connect("localhost","root","","sentimento");
	$con=mysqli_connect("ec2-23-21-211-172.compute-1.amazonaws.com","sentdb","sentdb","sentimento");
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
		
		header("Location: result.php");
	}else{
		echo "The message does not have any comments";
	}
	
	
	
?>
<div>
	<a href="get_messages.php">Choose Another Message</a>
</div>
</div></div>

	<div class="footer">
	            <p>Copyright (c) Green Hornets</p>
	    </div>
</body></html>