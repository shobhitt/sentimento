<?php
try
{
    $ch = curl_init();
    // Now set some options (most are optional)
 	//var_dump($ch);
    // Set URL to download
    curl_setopt($ch, CURLOPT_URL,'http://spice.schneider-electric.com/a/users/1234/subject_messages.xml?params[subject_id]=123&&client_key=tibco&auth_token=o1WCdbfst8IFWUBq5sXeM6ENokN9JTeYgar/tH1KKqE=');
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
	//print_r($xml->message[0]->content); 
	$_SESSION['xmltext']=$xml;
	
	
		foreach ($xml->message as $messages){
			echo $messages->content;
  		// foreach($messages->messages as $comment){
  				// var_dump($comment->message->content);
  			// //var_dump($comment->content);
  	
  	 	
		
	}	 
    //var_dump( $output);
	
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