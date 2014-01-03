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
			<div>
				Spice Analysis
			</div>
		<div style="text-align: center;">
			
		
			<?php
			session_start();
			try
			{
			    	
			    $ch = curl_init();
			    $id=$_POST['sesa'];
				$_SESSION['sesa']=$id;
				curl_setopt($ch, CURLOPT_URL,'https://spice.schneider-electric.com/a/users/find_by_login.xml?params[login]='.$id.'&client_key=tibco&auth_token=o1WCdbfst8IFWUBq5sXeM6ENokN9JTeYgar/tH1KKqE=');
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			    $output = curl_exec($ch);
				$xml = simplexml_load_string($output); 
				$userId=$xml->id;
				
				echo "<div class=\"top\">".$xml->{'first-name'}.", Please select from the following subjects</div><div class=\"inputform\">";
				
				curl_setopt($ch, CURLOPT_URL,'https://spice.schneider-electric.com/a/users/'.$userId.'/subscriptions.xml?client_key=tibco&auth_token=o1WCdbfst8IFWUBq5sXeM6ENokN9JTeYgar/tH1KKqE=&&params[user_id]='.$userId.'&params[inherited]=true&params[per_page]=20');
			 	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			    $output = curl_exec($ch);
				$xml = simplexml_load_string($output);
				
				
				echo "<form action='get_messages.php' method='post'>";
				echo "<select name='subject' style='width:290px; height:40px; '>";
				foreach ($xml->subject as $messages){
						 echo '<option value=\''.$messages->id.'\'>'.$messages->name.'</option>';
			  		 // foreach($messages->messages as $comment){
			  				 // var_dump($comment->message->content);
			  			// var_dump($comment->content);
				 }
				echo "</select><div><input type='submit' style='width:100px;height:35px;margin-top:10px;'/></div></form>";
				
				//print_r($xml->message[0]->content); 
				// $_SESSION['xmltext']=$xml;
			// 	
			// 	
					// foreach ($xml->message as $messages){
						// echo $messages->content;
			  		// // foreach($messages->messages as $comment){
			  				// // var_dump($comment->message->content);
			  			// // //var_dump($comment->content);
			//   	
			//   	 	
			// 		
				// }	 
			
				if (FALSE === $output)
				{
			    	echo "madard";
				    throw new Exception(curl_error($ch), curl_errno($ch));
				
				}
			    // ...process $content now
			} catch(Exception $e) {
				print "hello";
			    echo  $e->getMessage();
			
			}
			?>
</div>
</div>
</div>
<div class="footer">
	            <p>Copyright (c) Green Hornets</p>
	    </div>
		
</body>
</html>