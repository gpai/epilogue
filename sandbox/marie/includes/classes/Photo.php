<?php
/*
 * Created on Nov 16, 2013
 *
 * KISS it baby. Let's get the photo party started
 */

 class Photo{
 
        public function length(){
                return sizeof($this->_photo_array);
                        
        }

                 
         public function getPhotos($user_id, $next_call=''){
                 // get array of first 25 from facebook                
              $fb = Registry::getInstance()->get("fb");  
              echo "<br>********************************<br>";
              echo $user_id.'/photos?limit=100';
              $call = $user_id.'/photos?limit=100'.$next_call;
              var_dump($call);
              echo "<br>********************************<br>";
              $user_profile = $fb->api($call);
              echo "<br>---------- below this line --?????----<br>";
              
              print_r($user_profile);

         }
    
 
        public function sortPhotos ($arr_of_photos){
                // This function prints the facebook array into the lower level parts associated with the photo
                foreach ($arr_of_photos["data"] as $value){
                		
                         $photo_id =  ($value["id"]);
                          $caption = ($value["name"]);
                          $photo_url = ($value["source"]);

                          if (is_array($value["tags"])){
                          	if(sizeof(($value["tags"]["data"])) > 1){
                          		  echo "<br>-In this photo these people are tagged : <br>";
                                  foreach ($value["tags"]["data"] as $value1){
                                          $tagged_user_id = ($value1["id"]); 
                                          $tagged_user_name = ($value1["name"]); 
                                          echo "$tagged_user_name has $tagged_user_id<br>";                                  
                                  }                          		
                          	}

                          }
                          
                          if (is_array($value["comments"])){
                          	if(sizeof(($value["comments"]["data"])) > 1){
                          		  echo "<br>-In this photo these people mades comments : <br>";      	
                                  foreach ($value["comments"]["data"] as $value2){
                                          $comment_id = ($value2["id"]); 
                                          $comments_user_name = ($value2["from"]["name"]); 
                                          $comments_user_id = ($value2["from"]["id"]); 
                                          $comments_user_comment = ($value2["message"]); 
                                          echo "Comment ID : $comment_id Commented : $comments_user_comment <br>";                                           		"By : $comments_user_name ID :  $comments_user_id<br>";                                   }
                          	}
                          }

                          if (is_array($value["likes"])){
                          	if(sizeof(($value["likes"]["data"])) > 1){
                          		  echo "<br>-These people liked this photo : <br>";
                                  foreach ($value["likes"]["data"] as $value3){
                                          $likes_user_id = ($value3["id"]); 
                                          $likes_user_name = ($value3["name"]); 
                                          echo "$likes_user_name has $likes_user_id<br>";  
                                  }                                
                            }
                          }
                          
                          if (is_array($value["shares"])){
                          	if(sizeof(($value["shares"]["data"])) > 1){
  	                        		  echo "<br>-These people shared this photo : <br>";
                                  foreach ($value["shares"]["data"] as $value4){
                                          $shares_user_id = ($value4["id"]); 
                                          $shares_user_name = ($value4["name"]); 
                                          echo "$shares_user_name has $shares_user_id<br>";                                  
                                  }
                          	}
                          }
                          echo "*********** The photo id : $photo_id <br>";
                          echo "*********** The caption $caption <br>";
                          echo "*********** The url $photo_url <br>";
                } 
        }

        public function insertDeceasedPhotos ($arr_of_sorted_photos, $memorial_id){
                // okay so this one need the sort above to return that data
                // this one needs to stick it in the photo table with the associated memorial id
                echo " The array of sorted photos will be added to $memorial_id<br>";
        }
         
         public function getDeceasedPhotos($deceased_facebook_user_id){
         	// get all the deceased's photos from facebook - one time dealio?
            	$fb = Registry::getInstance()->get("fb");        
              	$deceased_user_photo  = $fb->api($deceased_facebook_user_id .'/photos');
                 print "Get photos for this guy --> $deceased_facebook_user_id";
                 return $deceased_user_photo;
         }
         

        public function downloadDeceasedPhotos ($url_to_download){
        	// take the $url and save it to the images/deceased folder
        	$url = $url_to_download;
			$img = $this->basenamePhotoUrl($url);
			echo "<br> url = $url and the destination file name is $img <br>";
			file_put_contents($img, file_get_contents($url));
		}

		
 		public function basenamePhotoUrl($url){
 			// strips out the $url to just the file name & extension and tacks it on to the destination folder
			$parts = explode("?",$url); 
			//break the string up around the "?" character in $parts
			$url = $parts['0']; 
			//grab the first part 
			return "/Users/sarahhuffman/working_epilogue/sandbox/marie/images/deceased/".basename($url);
		}


        public function deceasedPhotosFromFacebookToFolder($deceased_facebook_user_id){
        	echo "pretty please-----<br>";

        	
        	// all the pieces to get all the deceased photos from facebook into the images folders
        	$array_of_photos = $this->getDeceasedPhotos($deceased_facebook_user_id);
        	foreach ($array_of_photos["data"] as $value){
			     $photo_url = ($value["source"]);
			     $this->downloadDeceasedPhotos($photo_url);
        	}	
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
  
  	 	public function downloadPhoto($photo_url){
  	 		// at the moment this jsut displays the image... I need to make it download
			echo " <img src=$photo_url>";
			file_put_contents("/images/deceased", fopen("$photo_url", 'r'));

		}
        
  
 }
 
 
 
 
 
