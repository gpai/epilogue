<?php
/*
 * Created on Nov 16, 2013
 *
 * KISS it baby. Let's get the photo party started
 */

 class Photo{
 
 	private $_photo_array = array();
 	
	public function addItem($obj, $key = null){
		if ($key){
			if(isset($this->_photo_array[$key])){
				throw new KeyInUseException("Key\"$key\" already exists");
				} 	else {$this->_photo_array[$key] = $obj;				
					}
			}	
			else {$this->_photo_array[] = $obj;
			}		
	}
	
	public function keys(){
		return array_keys($this->_photo_array);	
	}
	
	public function exists($key){
		return (isset($this->_photo_array[$key]));
	}
	
	public function removeItem($key){
		
	}
	
	public function length(){
		return sizeof($this->_photo_array);
			
	}


//	public function __construct($whosphoto){
//		$this->whosphoto = $whosphoto;
// 	}
 		
 	public function getPhotos($user_id){
 		// get array of first 25 from facebook		
 		$fb = Registry::getInstance()->get("fb");	
      	$user_profile = $fb->api($user_id .'/photos');
 		return $user_profile;
 	}

	public function sortPhotos ($arr_of_photos){
		foreach ($arr_of_photos["data"] as $value){
 			$photo_id =  ($value["id"]);
  			$caption = ($value["name"]);
  			$photo_url = ($value["source"]);
  			echo "<br>-In this photo these people are tagged : <br>";
  			if (is_array($value["tags"])){
  				foreach ($value["tags"]["data"] as $value){
  					$tagged_user_id = ($value["id"]); 
  					$tagged_user_name = ($value["name"]); 
  					echo "$tagged_user_name has $tagged_user_id<br>";  				
  				}
  			}
  			echo "<br>-In this photo these people mades comments : <br>";
  			if (is_array($value["comments"])){
  				foreach ($value["comments"]["data"] as $value){
  					$comments_user_id = ($value["id"]); 
  					$comments_user_name = ($value["name"]); 
  					echo "$comments_user_name has $comments_user_id<br>";  				
  				}
  			}
  			echo "<br>-These people liked this photo : <br>";
  			if (is_array($value["likes"])){
  				foreach ($value["likes"]["data"] as $value){
  					$likes_user_id = ($value["id"]); 
  					$likes_user_name = ($value["name"]); 
  					echo "$likes_user_name has $likes_user_id<br>";  				
  				}
  			}
  			echo "<br>-These people shared this photo : <br>";
  			if (is_array($value["shares"])){
  				foreach ($value["shares"]["data"] as $value){
  					$shares_user_id = ($value["id"]); 
  					$shares_user_name = ($value["name"]); 
  					echo "$shares_user_name has $shares_user_id<br>";  				
  				}
  			}
  			echo "*********** The photo id : $photo_id <br>";
  			echo "*********** The caption $caption <br>";
  			echo "*********** The url $photo_url <br>";
		} 
	}

 
 	
// 	function sortPhotoArray($arr_of_photos){
//    	$output = null;
//    	if (is_array($arrayIn)){
//        	foreach ($arrayIn as $key=>$val){
//            	if (is_array($val)){
//               	$output->{$key} = arrayFilter($val);
//            	} 
//            	else {
//                	$output->{$key} = $this->sanitize($val);
//            	}
//        	}
//    	} 
//    	else {
//        	$output->{$key} = $this->sanitize($val);
//    	}
//    return $output;
//	}


//	function sanitize($val)
//	{
		
    //insert your preferred data filter here
//    	return addslashes('filtered: '.$val);
//	}


 	
 	public function getDeceasedPhotos($deceased_facebook_user_id){
 		// get all the deceased's photos from facebook - one time dealio?
 		$fb = Registry::getInstance()->get("fb");	
      	$deceased_user_photo  = $fb->api($deceased_facebook_user_id .'/photos');
 		print "Get photos for this guy --> $deceased_facebook_user_id";
 		return $deceased_user_photo;
 	}		

	function displayPhotos($arr_of_photos, $indent='') {
    	if ($arr_of_photos) {
        	foreach ($arr_of_photos as $value) {
            	if (is_array($value)) {
                	$this->displayPhotos($value, $indent . '--');
            	} 
            		else {
	                	echo "the array looks like  $indent $value <br>";
            		}
     		}
    	}
	}


  	public function getPhotoVote($photo_id, $memorial_id){
  		// display the current vote for a photo_id
  		$db = Registry::getInstance()->get('db');	
  		$query = 'SELECT vote, memorial_id FROM photo WHERE photo_id = "$photo_id" AND memorial_id = "$memorial_id"';		
  		$current_vote = $db->raw_query($query);
  		echo "this is the current vote '$current_vote'";
  	}
  	  	public function upPhotoVote($photo_id, $memorial_id, $vote){
  		// upvote or downvote a photo to include in the memorial
  		$db = Registry::getInstance()->get('db');	
		$update_this = "UPDATE `Vixen_test`.`photo` SET vote = '$status' WHERE facebook_user_id = '$invite_this_friend' AND memorial_id = '$memorial_id'";
		$db->raw_query($update_this);
  		echo "hey '$vote' was added to the vote count";
  	}
		  		

	
  
 }
 
 
?>
