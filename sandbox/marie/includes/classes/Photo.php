<?php
/*
 * Created on Nov 16, 2013
 *
 * KISS it baby. Let's get the photo party started
 */

 class Photo{
 
 	private $whosphoto;
  	$db = Registry::getInstance()->get('db');	
  	
 	public function __construct($whosphoto){
 		$this->whosphoto = $whosphoto;
 	}
 		
 	public function getPhotos($user){
 		// get a photo from facebook
 		$user = $facebook->getUser();
 		print "Get photos for this guy --> $this->whosphoto!"; 		
 	}
 	
 	public function getDeceasedPhotos($deceased_facebook_user_id){
 		// get all the deceased's photos from facebook - one time dealio?
 		$deceased_user_profile = $facebook->api('$deceased_facebook_user_id');
 		print "Get photos for this guy --> $deceased_facebook_user_id";
 	}		

  	public function votePhoto($photo_id, $memorial_id, $vote){
  		// update or downvote a photo to include in the memorial
  		// right now it should just display the current vote for a photo_id
  		$query = 'SELECT vote, memorial_id FROM photo WHERE photo_id = "$photo_id" AND memorial_id = "$memorial_id"';		
  		$current_vote = $db->raw_query($query);
  		print_r(array_values($current_vote));
		  		
//		$update_this = "UPDATE `Vixen_test`.`photo` SET vote = '$status' WHERE facebook_user_id = '$invite_this_friend' AND epilogue_user_id = '$epilogue_user_id' AND memorial_id = '$memorial_id'";
//		$db->raw_query($update_this);
	
  		
  		
  		
  		
  	}
 }
 
 
?>
