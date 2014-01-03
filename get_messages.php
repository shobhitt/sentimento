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
				color:#777777;
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
				/*padding: 10px;*/
				
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;				
				
			}
			tr{
				margin: 2px;
				background: #eeeeee;
				padding: 10px;
				font-size: 15px;
			}
			td{
				padding:10px;
			}
			.row0{
				background:#ffffff;
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
			<div style="width:100%;text-align: center;">
				<p style="font-size: 25px;">Spice Analysis</p>
			</div>
			<div style="width:100%;text-align: center;">
				<p style="font-size: 20px;">Select the post</p>
			</div>
		<div style="text-align: center;">
			<table >
				

<?php
	session_start();
	
	$ch = curl_init();
    $id=$_POST['subject'];
	$userId=$_SESSION['sesa'];

	curl_setopt($ch, CURLOPT_URL,'http://spice.schneider-electric.com/a/users/'.$userId.'/subject_messages.xml?params[subject_id]='.$id.'&client_key=tibco&auth_token=o1WCdbfst8IFWUBq5sXeM6ENokN9JTeYgar/tH1KKqE=');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $output = curl_exec($ch);
	$xml = simplexml_load_string($output); 
	$_SESSION['xml']=$output;
	
	
	//echo "<form action='get_comments.php' method='post'>";
	//echo " <select name='message'>";
	$i=0;
	foreach ($xml->message as $messages){
		//echo "<option value='".$messages->id.'\'>'.$messages->content.'</option>';
		 // foreach($messages->messages as $comment){
			 // var_dump($comment->message->content);
			// var_dump($comment->content);
		//}
		$a=$i%2;
		$i=$i+1;
		echo "<tr class='row$a'><td><a href='get_comments.php?message=$messages->id' style='color:#777777;'>$messages->content</a></td></tr>";
	}	 
	//echo "</select><input type='submit'></form>";
	

?>
</table>
</div></div></body></html>