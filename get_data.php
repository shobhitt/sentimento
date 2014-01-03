<?php

session_start();

$con=mysqli_connect("ec2-23-21-211-172.compute-1.amazonaws.com","sentdb","sentdb","sentimento");
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$request_id=$_SESSION['request_id'];
$type=$_SESSION['type'];

if($type==='excel'){
	$result = mysqli_query($con,"SELECT * FROM excel_output where request_id='".$_SESSION['request_id']."';");	
	$positive=0;
	$negative=0;
	$neutral=0;
	while($row = mysqli_fetch_array($result))
	{
		  	if($row['sentiment']==2){
		  		$positive=$positive+1;
		  	}elseif($row['sentiment']==0){
		  		$negative=$negative+1;
		  	}else{
		  		$neutral=$neutral+1;
		  	}
	}
}elseif($type==='twitter'){
	$result = mysqli_query($con,"SELECT * FROM twitter_output where request_id='".$_SESSION['request_id']."';");	
	$positive=0;
	$negative=0;
	$neutral=0;
	while($row = mysqli_fetch_array($result))
	{
		  	if($row['sentiment']==2){
		  		$positive=$positive+1+$row['retweet_count'];
		  	}elseif($row['sentiment']==0){
		  		$negative=$negative+1+$row['retweet_count'];
		  	}else{
		  		$neutral=$neutral+1+$row['retweet_count'];
		  	}
	}
}elseif($type==='fb'){
		
	$result = mysqli_query($con,"SELECT * FROM facebook_output where request_id='".$_SESSION['request_id']."';");	
	$positive=0;
	$negative=0;
	$neutral=0;
	while($row = mysqli_fetch_array($result))
	{
		  	if($row['sentiment']==2){
		  		$positive=$positive+1+$row['like_count'];
		  	}elseif($row['sentiment']==0){
		  		$negative=$negative+1+$row['like_count'];
		  	}else{
		  		$neutral=$neutral+1+$row['like_count'];
		  	}
	}
}else{
	$result = mysqli_query($con,"SELECT * FROM spice_output where request_id='".$_SESSION['request_id']."';");	
	$positive=0;
	$negative=0;
	$neutral=0;
	while($row = mysqli_fetch_array($result))
	{		
		  	if($row['sentiment']==2){
		  		$positive=$positive+1+$row['like_count'];
		  	}elseif($row['sentiment']==0){
		  		$negative=$negative+1+$row['like_count'];
		  	}else{
		  		$neutral=$neutral+1+$row['like_count'];
		  	}
	}
}

//	$data=array();
	// $data={"cols"=> [
        // {"id":"","label":"Topping","pattern":"","type":"string"},
        // {"id":"","label":"Slices","pattern":"","type":"number"}
      // ],
  // "rows": [
        // {"c":[{"v":"Mushrooms","f":null},{"v":3,"f":null}]},
        // {"c":[{"v":"Onions","f":null},{"v":1,"f":null}]},
        // {"c":[{"v":"Olives","f":null},{"v":1,"f":null}]},
        // {"c":[{"v":"Zucchini","f":null},{"v":1,"f":null}]},
        // {"c":[{"v":"Pepperoni","f":null},{"v":2,"f":null}]}
      // ]};
// }
	$col1=array("id"=>"","label"=>"Sentiment","pattern"=>"","type"=>"string");
	$col2=array("id"=>"","label"=>"Number","pattern"=>"","type"=>"number");
	
	$row1=array("c"=>array(array("v"=>"Neutral","f"=>null),array("v"=>$neutral,"f"=>null)));
	$row2=array("c"=>array(array("v"=>"Positive","f"=>null),array("v"=>$positive,"f"=>null)));
	$row3=array("c"=>array(array("v"=>"Negative","f"=>null),array("v"=>$negative,"f"=>null)));

	$cols=array($col1,$col2);
	$rows=array($row1,$row2,$row3);
	$data=array("cols"=>$cols,"rows"=>$rows);
	mysqli_close($con);
	
	echo json_encode($data);
	//vardump(data);

?>