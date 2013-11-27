<?php
/*
 * Created on Nov 16, 2013
 *
 * KISS it baby. Let's get the photo party started
 */

 class Photo{

		private $memorial_id; 

    	function setMemorialParameter($memorial_id) {
        	$this->memorial_id = $memorial_id;
    	}    
         
         public function getPhotoArray($user_id, $next_call=''){
                 // get array of first 25 from facebook                
              $fb = Registry::getInstance()->get("fb");  
              echo "<br>****************** !!!! **************<br>";
              //echo $user_id.'/photos?limit=25';
              $call_for_photos = $user_id.'/photos?limit=100'.$next_call;
              var_dump($call_for_photos);
              echo "<br>***************** !!!! ***************<br>";
              $array_of = $fb->api($call_for_photos);
              $this->deceasedPhotosFromFacebookToFolder($array_of);
              $this->insertFacebookPhotoInfo($array_of, $this->memorial_id);
              
                //echo "<br>---------- getPhotoArray -----<br>";
              if (!$array_of[paging]["next"]==NULL){
              	$next_call = $this->getNext($array_of);	
              	echo "next call --- $next_call";
              	$this->getPhotoArray($user_id, $next_call);              	
              }              
         }

		public function getNext($array_of){
			// filters the array from facebook and returns the pagination string for the next call or '' if there are no more
			if (!$array_of[paging]["next"]==NULL){
				$the_paging = $array_of[paging]["next"];	
				$parts = explode("&",$the_paging); 
			//break the string up around the "?" character in $parts
				$next_call = $parts['1']; 

				return "&".$next_call;
			} else return False;
			
		}
		

 
        public function insertFacebookPhotoInfo ($arr_of_photos, $memorial_id){
                // This function inserts the facebook photo array info into tables in the database tied to memorial id
                $db = Registry::getInstance()->get('db'); 
                $photo_id =  "";
                $caption = "";
                $photo_url ="";
                $photo_create_date = "";
                $fb_user_id_of_photo = "";
                
                foreach ($arr_of_photos["data"] as $value){
          		
                         $photo_id =  ($value["id"]);
                         if (isset( $value["name"] )){ $caption = ($value["name"]);}
                         $photo_url = ($value["source"]);
                         if (isset( $value["created_time"])){$photo_create_date = ($value["created_time"]);}
                         $fb_user_id_of_photo = ($value["from"]["id"]);

                         if (is_array($value["tags"])){                        	
                          	if(sizeof(($value["tags"]["data"])) >= 1){
                          		$t = sizeof($value["tags"]["data"]);
                          		  //echo "<br>-----In this photo these people are tagged : <br>";
                                  foreach ($value["tags"]["data"] as $value1){
                                          $tagged_user_id = ($value1["id"]); 
                                          $tagged_user_name = ($value1["name"]); 
//                                          echo "$tagged_user_name has $tagged_user_id<br>"; 
                                          $query1 = "INSERT INTO  `Vixen_test`.`tags` (`memorial_id` ,`tagged_name` ,`tagged_fb_id` ,`tagged_item_id`)VALUES (
													'$memorial_id',  '$tagged_user_name',  '$tagged_user_id',  '$photo_id')";                
                  						  //echo "this is q1 $query1";
                  						  $db->raw_query($query1);				
                                  }                          		
                          	}
                          }
                          
                          if (is_array($value["comments"])){
                          	if(sizeof(($value["comments"]["data"])) >= 1){
                          		$c = sizeof($value["comments"]["data"]);
                          		//echo "this is c $c";
                          		  //echo "<br>------In this photo these people mades comments : <br>";      	
                                  foreach ($value["comments"]["data"] as $value2){
                                          $comment_id = ($value2["id"]); 
                                          $comments_user_name = ($value2["from"]["name"]); 
                                          $comments_user_id = ($value2["from"]["id"]); 
                                          $comments_user_comment = ($value2["message"]); 
                                                                                                    
                                          $query2 = "INSERT INTO  `Vixen_test`.`comments` (`comment_id` ,`comment` ,`comment_type` ,`commenter_fb_id` ,`commenter_name` ,`memorial_id` ,`commented_item_id`)VALUES (
													NULL ,  '$comments_user_comment',  'photo',  '$comments_user_id',  '$comments_user_name',  '$memorial_id',  '$photo_id')";                
                  						  //echo "this is Q2 -- $query2";
                  						  $db->raw_query($query2);
  								}
                          	}
                          }

                          if (is_array($value["likes"])){                         	
                          	if(sizeof(($value["likes"]["data"])) >= 1){
                          		 $l = sizeof($value["likes"]["data"]);
                          		  //echo "<br>-----These people liked this photo : <br>";
                                  foreach ($value["likes"]["data"] as $value3){
                                          $likes_user_id = ($value3["id"]); 
                                          $likes_user_name = ($value3["name"]); 
                                          $query3 = "INSERT INTO  `Vixen_test`.`likes` (`memorial_id` ,`like_name` ,`like_fb_id` ,`liked_item_id`)VALUES (
													'$memorial_id',  '$likes_user_name',  '$likes_user_id',  '$photo_id')";                
                  						  //echo "this is Q3 $query3";
                  						  $db->raw_query($query3); 
                                  }                                
                            }
                          }
                          
                          if (is_array($value["shares"])){                        	
                          	if(sizeof(($value["shares"]["data"])) >= 1){
                          		$s = sizeof ($value["shares"]["data"]);
  	                        	//echo "<br>-----These people shared this photo : <br>";
                                foreach ($value["shares"]["data"] as $value4){
                                          $shares_user_id = ($value4["id"]); 
                                          $shares_user_name = ($value4["name"]); 
                                          $query4 = "INSERT INTO  `Vixen_test`.`shares` (`memorial_id` ,`sharer_name` ,`sharer_fb_id` ,`shared_item_id`)VALUES (
													'$memorial_id',  '$shares_user_name',  '$shares_user_id',  '$photo_id')";                
                  						  //echo "this is shares ---  Q4 --- $query4";
                  						  $db->raw_query($query4); 
                  						  
                  						  
                                 }
                          	}
                          } 
                          
                          $photo_file_name = $this->basenamePhotoFilename($photo_url);
                          
						  $test = "INSERT INTO `Vixen_test`.`photo` (`photo_id`, `url`, `comment_id`, `like_id`, `share_id`, `tag_id`, `meaning_rank`, `photo_date`, `caption`, `album_id`, `album_name`, `to_be_approved`, `memorial_id`, `vote`, `photo_create_date`, `photo_user_id`) VALUES ('$photo_id', '$photo_file_name', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '$memorial_id', '1', '$photo_create_date', '$fb_user_id_of_photo');";
						  $db->raw_query($test); 
                      
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

 		public function basenamePhotoFilename($url){
 			// strips out the $url (http: and ?) to just the file name & extension to use as a reference
			if (strpos($url,'?') !== false){
				$parts = explode("?",$url); 
				$url = $parts['0']; 
			}
			return basename($url);
		}

        public function deceasedPhotosFromFacebookToFolder($array_of_photos){
        	// all the pieces to get all the deceased photos from facebook into the images folders
        	//$array_of_photos = $this->getDeceasedPhotos($deceased_facebook_user_id);
        	foreach ($array_of_photos["data"] as $value){
			     $photo_url = ($value["source"]);
			     $this->downloadDeceasedPhotos($photo_url);
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
 
 
 
  
//  	 	public function downloadPhoto($photo_url){
  	 		// at the moment this jsut displays the image... I need to make it download
//			echo " <img src=$photo_url>";
//			file_put_contents("/images/deceased", fopen("$photo_url", 'r'));

//		}
        
  
 }
 
 
 
 
 
