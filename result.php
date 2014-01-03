<html>
	<head>
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
				padding: 10px;
				border: 1px solid #ffffff;
				
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
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
   		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	    <script type="text/javascript">
	    
	    // Load the Visualization API and the piechart package.
	    google.load('visualization', '1', {'packages':['corechart']});
	      
	    // Set a callback to run when the Google Visualization API is loaded.
	    google.setOnLoadCallback(drawChart);
	    google.setOnLoadCallback(drawNewChart);
	      
	    function drawChart() {
	      var jsonData = $.ajax({
	          url: "get_data.php",
	          dataType:"json",
	          async: false
	          }).responseText;
	          
	      // Create our data table out of JSON data loaded from server.
	      var data = new google.visualization.DataTable(jsonData);
	
	      // Instantiate and draw our chart, passing in some options.
	      var chart = new google.visualization.PieChart(document.getElementById('toresult'));
	      chart.draw(data, {width: 400, height: 240});
	    }
	    
	    
	    function drawNewChart() {
	      var jsonData = $.ajax({
	          url: "get_data.php",
	          dataType:"json",
	          async: false
	          }).responseText;
	          
	      // Create our data table out of JSON data loaded from server.
	      var data = new google.visualization.DataTable(jsonData);
	
	      // Instantiate and draw our chart, passing in some options.
	      var chart = new google.visualization.PieChart(document.getElementById('timeline'));
	      chart.draw(data, {width: 400, height: 240});
	    }
	
	    </script>
   
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
				<?php 
				session_start();
				if($_SESSION['type']='spice'){
					echo $_SESSION['type'].$_SESSION['message'];
				}
				elseif($_SESSION['type']='fb'){	
					echo $_SESSION['type'];
				}elseif($_SESSION['type']='excel'){
					echo $_SESSION['type'];
				}
				else{
					echo $_SESSION['type'];				}
				?> Analysis
				
			</div>
		<div style="text-align: center;">
		<div id="toresult">
			
		</div>
		<div id="timeline">
			
		</div>
		</div>
		<div class="footer">
	            <p>Copyright (c) Green Hornets</p>
	    </div>

	</body>
</html>