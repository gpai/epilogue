<?php
/*
 * Created on Nov 19, 2013
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */


 class Video{
 
         private $_video_array = array();
         
         
         public function getVideo($user_id){
                 // get array of first 25 from facebook                
                 $fb = Registry::getInstance()->get("fb");        
              $user_profile = $fb->api($user_id .'/photos');
                 return $user_profile;
         }

        public function sortVideos ($arr_of){
                // This function prints the facebook array into the lower level parts associated with the photo
                foreach ($arr_of["data"] as $value){
                         $photo_id =  ($value["id"]);
                          $caption = ($value["name"]);
                          $photo_url = ($value["source"]);

                          if (is_array($value["tags"])){
                          	if(sizeof(($value["tags"]["data"])) > 1){
                          		  echo "<br>-In this photo these people are tagged : <br>";
                                  foreach ($value["tags"]["data"] as $value){
                                          $tagged_user_id = ($value["id"]); 
                                          $tagged_user_name = ($value["name"]); 
                                          echo "$tagged_user_name has $tagged_user_id<br>";                                  
                                  }                          		
                          	}

                          }
                          
                          if (is_array($value["comments"])){
                          	if(sizeof(($value["comments"]["data"])) > 1){
                          		  echo "<br>-In this photo these people mades comments : <br>";      	
                                  foreach ($value["comments"]["data"] as $value){
                                          $comment_id = ($value["id"]); 
                                          $comments_user_name = ($value["from"]["name"]); 
                                          $comments_user_id = ($value["from"]["id"]); 
                                          $comments_user_comment = ($value["message"]); 
                                          echo "Comment ID : $comment_id Commented : $comments_user_comment <br>";                                           		"By : $comments_user_name ID :  $comments_user_id<br>";                                   }
                          	}
                          }

                          if (is_array($value["likes"])){
                          	if(sizeof(($value["likes"]["data"])) > 1){
                          		  echo "<br>-These people liked this photo : <br>";
                                  foreach ($value["likes"]["data"] as $value){
                                          $likes_user_id = ($value["id"]); 
                                          $likes_user_name = ($value["name"]); 
                                          echo "$likes_user_name has $likes_user_id<br>";  
                                  }                                
                            }
                          }
                          
                          if (is_array($value["shares"])){
                          	if(sizeof(($value["shares"]["data"])) > 1){
                          		  echo "<br>-These people shared this photo : <br>";
                                  foreach ($value["shares"]["data"] as $value){
                                          $shares_user_id = ($value["id"]); 
                                          $shares_user_name = ($value["name"]); 
                                          echo "$shares_user_name has $shares_user_id<br>";                                  
                                  }
                          	}
                          }
                          echo "*********** The photo id : $photo_id <br>";
                          echo "*********** The caption $caption <br>";
                          echo "*********** The url $photo_url <br>";
                } 
        }
        public function insertDeceasedVideos ($arr_of, $memorial_id){
                // okay so this one need the sort above to return that data
                // this one needs to stick it in the photo table with the associated memorial id
                echo " The array of sorted photos will be added to $memorial_id<br>";
        }
 
         

         
         public function getDeceasedVideos($deceased_facebook_user_id){
                 // get all the deceased's photos from facebook - one time dealio?
                 $fb = Registry::getInstance()->get("fb");        
              $deceased_video  = $fb->api($deceased_facebook_user_id .'/photos');
                 print "Get photos for this guy --> $deceased_facebook_user_id";
                 return $deceased_video;
         }                

        function displayVideos($arr_of, $indent='') {
            if ($arr_of) {
                foreach ($arr_of as $value) {
                    if (is_array($value)) {
                        $this->displayPhotos($value, $indent . '--');
                    } 
                            else {
                                echo "the array looks like  $indent $value <br>";
                            }
                     }
            }
        }


          public function getVideoVote($video_id, $memorial_id){
                  // display the current vote for a photo_id
                  $db = Registry::getInstance()->get('db');        
                  $query = 'SELECT vote, memorial_id FROM video WHERE video_id = "$video_id" AND memorial_id = "$memorial_id"';                
                  $current_vote = $db->raw_query($query);
                  echo "this is the current vote '$current_vote'";
          }
                    public function upVideoVote($video_id, $memorial_id, $vote){
                  // upvote or downvote a photo to include in the memorial
                  $db = Registry::getInstance()->get('db');        
                $update_this = "UPDATE `Vixen_test`.`video` SET vote = '$status' WHERE video_id = $video_id AND memorial_id = '$memorial_id'";
                $db->raw_query($update_this);
                  echo "hey '$vote' was added to the vote count";
          }
  
  	 	public function downloadVideo($video_url){
  	 		// at the moment this jsut displays the image... I need to make it download
			echo " <img src=$video_url>";
			//file_put_contents("/images/deceased", fopen("$video_url", 'r'));

		}
        
  
 }
 
 
 
 
 
