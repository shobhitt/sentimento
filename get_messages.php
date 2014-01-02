<?php
	session_start();
	
	$ch = curl_init();
    $id=$_POST['subject'];
	$userId=$_SESSION['sesa'];
	var_dump($id);
	var_dump($userId);
	
	//http://spice.schneider-electric.com/a/users/'.$userId.'/subject_messages.xml?params[subject_id]='.$id.'&client_key=tibco&auth_token=o1WCdbfst8IFWUBq5sXeM6ENokN9JTeYgar/tH1KKqE=');
	
   // curl_setopt($ch, CURLOPT_URL,'http://spice.schneider-electric.com/a/users/'.$userId.'/subject_messages.xml?params[subject_id]='.$id.'&client_key=tibco&auth_token=o1WCdbfst8IFWUBq5sXeM6ENokN9JTeYgar/tH1KKqE=');
	curl_setopt($ch, CURLOPT_URL,'http://spice.schneider-electric.com/a/users/'.$userId.'/subject_messages.xml?params[subject_id]='.$id.'&client_key=tibco&auth_token=o1WCdbfst8IFWUBq5sXeM6ENokN9JTeYgar/tH1KKqE=');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $output = curl_exec($ch);
	var_dump($output);
	$xml = simplexml_load_string($output); 
	$_SESSION['xml']=$output;
	echo "<form action='get_comments.php' method='post'>";
	echo " <select name='message'>";
		foreach ($xml->message as $messages){
			echo "<option value='".$messages->id.'\'>'.$messages->content.'</option>';
  			 // foreach($messages->messages as $comment){
  				 // var_dump($comment->message->content);
  				// var_dump($comment->content);
			//}
		}	 
	echo "</select><input type='submit'></form>";


?>