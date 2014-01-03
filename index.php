<html>
	<head>
		<title>
			Sentimento
		</title>
		<style>
		
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
					
			.header{
				text-align: center;
				width: 100%;
			}
			.maincontent{
				width:980px;
				margin: auto;
				
			}
			body{
				margin: 0px;
				padding: 0px;
			}
			.header{
				height: 200px;
				background: #222222;
				font-size: 40px;
				font-family: Helvetica;
				color:#aaaaaa;
				padding-top: 40px;
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
		</style>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<script>
			function showinput(type)
			{
				if (type=='fb')
				{
					$(".databox").hide();
					$(".datainput_tw").hide();
					$(".datainput_ex").hide();
					$(".datainput_sp").hide();
					$(".datainput_fb").show();
								
				}
				else
				{
					if (type=='tw')
					{
						$(".databox").hide();
						$(".datainput_fb").hide();
						$(".datainput_ex").hide();
						$(".datainput_sp").hide();
						$(".datainput_tw").show();
					}
					else
					{
						if (type=='ex')
						{
							$(".databox").hide();
							$(".datainput_fb").hide();
							$(".datainput_tw").hide();
							$(".datainput_sp").hide();
							$(".datainput_ex").show();
						}
						else
						{
							$(".databox").hide();
							$(".datainput_fb").hide();
							$(".datainput_tw").hide();
							$(".datainput_ex").hide();
							$(".datainput_sp").show();
						}
						
					}
					
				}
			}
		</script>
	</head>
	<body>
		
		<div class="header">
			<H1>
				Sentimento
			</H1>
		</div>
		<div class="maincontent">
			<div class="option">
				<div class='icon' onclick="showinput('fb')" style=" cursor:hand">
					<img src="facebook.png" />
				</div>
				<div class='icon' onclick="showinput('tw')" style=" cursor:hand">
					<img src="twitter.png" />
				</div>
				<div class='icon' onclick="showinput('ex')" style=" cursor:hand">
					<img src="excel.jpg" />
				</div>
				<div class='icon' onclick="showinput('sp')" style=" cursor:hand">
					<img src="spice.jpg" />
				</div>
			</div>
			<div class="datainput_fb databox" style="display: none; ">
				 <div style="text-align: center;font-family:Verdana; padding: 10px;">
					Facebook
				</div> 
				<form  action="facetest.php">
					<div style="text-align: center;padding: 10px;">
						<input type="text" name="page" placeholder="Enter Name/Id of Subject " style="width: 300px;height: 30px;text-align: center;">
					</div>
					<div style="text-align: center;padding: 10px;">
						<input type="submit" style="background: #222222;color:#aaaaaa;font-family:Helvetica;width: 100px;height: 30px;font-size: 16px;" />
					</div>
				</form>
			</div>
			<div class="datainput_tw databox" style="display: none">
				<div style="text-align: center;font-family:Verdana; padding: 10px;">
					Twitter
				</div> 
				<form action="testtwitter.php">
					<div style="text-align: center;padding: 10px;">
						<input type="text" name="search" placeholder="Enter Search " style="width: 300px;height: 30px;text-align: center;">
					</div>
					<div style="text-align: center;padding: 10px;">
						<input type="submit" style="background: #222222;color:#aaaaaa;font-family:Helvetica;width: 100px;height: 30px;font-size: 16px;" />
					</div>
				</form>
			</div>
			<div class="datainput_ex databox" style="display: none">
				<div style="text-align: center;font-family:Verdana; padding: 10px;">
					Excel 
				</div> 
				<form action="upload_file.php" method="post" enctype="multipart/form-data" >
					<div style="text-align: center;padding: 10px;">
						<input type="file" name="file" value="Upload a File" placeholder="Upload a File "  style="width: 300px;height: 30px;text-align: center;">
					</div>
					<div style="text-align: center;padding: 10px;">
						<input type="submit" style="background: #222222;color:#aaaaaa;font-family:Helvetica;width: 100px;height: 30px;font-size: 16px;" />
					</div>
				</form>
			</div>
			<div class="datainput_sp databox" style="display: none">
				<div style="text-align: center;font-family:Verdana; padding: 10px;">
					Spice
				</div> 
				<form action="testcurl.php" method="post">
					<div style="text-align: center;padding: 10px;">
						<input type="text" name="sesa" placeholder="Enter Your SESA " style="width: 300px;height: 30px;text-align: center;">
					</div>
					<div style="text-align: center;padding: 10px;">
						<input type="submit" style="background: #222222;color:#aaaaaa;font-family:Helvetica;width: 100px;height: 30px;font-size: 16px;" />
					</div>
				</form>
			</div>
			<div class="databox" >
				<div style="text-align: center;font-family:Verdana; padding: 10px;">
					Click Icons to get Started.
				</div> 
				
			</div>
		</div>
		<div class="footer">
	            <p>Copyright (c) Green Hornets</p>
	    </div>
		
	</body>
</html>