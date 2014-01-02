<?php
session_start();
try
{
    $ch = curl_init();
    // Now set some options (most are optional)
 	//var_dump($ch);
    // Set URL to download
    $id=$_POST['sesa'];
	$_SESSION['sesa']=$id;
	var_dump($id);
    curl_setopt($ch, CURLOPT_URL,'https://spice.schneider-electric.com/a/users/find_by_login.xml?params[login]='.$id.'&client_key=tibco&auth_token=o1WCdbfst8IFWUBq5sXeM6ENokN9JTeYgar/tH1KKqE=');
 //	curl_setopt($ch, CURLOPT_URL,'http://google.com/');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 
    // Set a referer
    //curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
 
    // User agent
    //curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
 
    // Include header in result? (0 = yes, 1 = no)
    //curl_setopt($ch, CURLOPT_HEADER, 0);
 
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	
 
    // Timeout in seconds
    //curl_setopt($ch, CURLOPT_TIMEOUT, 10);
 
 
    // Download the given URL, and return output
    $output = curl_exec($ch);
 
    // Close the cURL resource, and free system resources
    //curl_close($ch);
	
	$xml = simplexml_load_string($output); 
	$userId=$xml->id;
	
	//http://tibbr-host/a/users/user-id/subscriptions.xml
	
	
	curl_setopt($ch, CURLOPT_URL,'https://spice.schneider-electric.com/a/users/'.$userId.'/subscriptions.xml?client_key=tibco&auth_token=o1WCdbfst8IFWUBq5sXeM6ENokN9JTeYgar/tH1KKqE=&&params[user_id]='.$userId.'&params[inherited]=true&params[per_page]=20');
 	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $output = curl_exec($ch);
	$xml = simplexml_load_string($output);
	//var_dump($xml);
	echo "<form action='get_messages.php' method='post'>";
	echo "<select name='subject'>";
	foreach ($xml->subject as $messages){
			 echo '<option value=\''.$messages->id.'\'>'.$messages->name.'</option>';
  		 // foreach($messages->messages as $comment){
  				 // var_dump($comment->message->content);
  			// var_dump($comment->content);
	 }
	echo "</select><input type='submit'/></form>";
	
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