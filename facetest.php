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

  $config = array(
      'appId' => '1458974224329503',
      'secret' => 'eb702d38b46ac6600cfd27d0ef224883',
      'fileUpload' => false, // optional
      'allowSignedRequest' => false, // optional, but should be set to false for non-canvas apps
  );

  $facebook = new Facebook($config);
  if(isset($_GET['page'])){
  	  $page=$_GET['page'];
  			$_SESSION['page']=$page;
  }
  else {
  	$page=$_SESSION['page'];
  }
 // $api="".$page. "?fields=feed.limit(100).fields(message)";
  $ret = $facebook->api($page.'?fields=feed.limit(100).fields(message),name');
  $_SESSION['subject']=(string)$ret['name'];
  echo "<H2>".(string)$ret['name']."</H2>";
  echo "<div>
				<h3>Please select the Post</h3> 
			</div>";
  
  foreach ($ret['feed']['data'] as $value){
  	$id=$value['id'];
  	if(isset($value['message'])){
		$message=$value['message'];
	  echo "<table><tr><td><a href='getcomments.php?messageid=$id' style='color:#303030'> $message</a></td></tr>	";
	}

  }
  
  // foreach ($ret as $value) {
   // //	var_dump($value[0]);
	  // foreach ($value as $value1) {
   	// var_dump($value1['message']);
		  // var_dump($value1['id']);
 // // var_dump($ret);
  // }
 // var_dump($ret);
  //}
  ?>
 </table></div></div></body></html>