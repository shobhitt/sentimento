<?php
	require_once("facebook.php");

  $config = array(
      'appId' => '1458974224329503',
      'secret' => 'eb702d38b46ac6600cfd27d0ef224883',
      'fileUpload' => false, // optional
      'allowSignedRequest' => false, // optional, but should be set to false for non-canvas apps
  );

  $facebook = new Facebook($config);
  $page=$_GET['page'];
 // $api="".$page. "?fields=feed.limit(100).fields(message)";
  echo $page;
  $ret = $facebook->api($page.'?fields=feed.limit(100).fields(message)');
  //var_dump($ret['feed']['data']);
  echo "
  <form action='getcomments.php'>
  <select name='messageid'>";
  foreach ($ret['feed']['data'] as $value){
  	//var_dump($value['id']);
  	$id=$value['id'];
	$message=$value['message'];
	
	  echo "<option value=$id>$message</option>	";
	   
  }
  echo "</select>
  <input type='submit'>
  </form>"
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