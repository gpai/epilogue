<?php
/*
 * Created on Nov 16, 2013
 *
 * KISS it baby. Let's get the photo party started
 */

 class Photo{
 
 	private $whosphoto;


//	public function __construct($whosphoto){
//		$this->whosphoto = $whosphoto;
// 	}
 		
 	public function getPhotos($user_id){
 		// get a photo from facebook	
 		
 		
 		
 		$fb = Registry::getInstance()->get("fb");	
      	$user_profile = $fb->api($user_id .'/photos');
		print_r(array_values($user_profile));
 		return $user_profile;
 	}
 	
 	public function getDeceasedPhotos($deceased_facebook_user_id){
 		// get all the deceased's photos from facebook - one time dealio?
 		$deceased_user_profile = $facebook->api('$deceased_facebook_user_id');
 		print "Get photos for this guy --> $deceased_facebook_user_id";
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
