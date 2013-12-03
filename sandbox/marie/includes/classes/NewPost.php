<?php
/*
 * Created on Nov 27, 2013
 *
 * Copy of the Phot class to modify for the  Post class 
 * ?><pre><?php print_r($array_of)?> </pre><?php
 */


 class newPost{

//		private $memorial_id; 

  //  	function setMemorialParameter($memorial_id) {
    //    	$this->memorial_id = $memorial_id;
    	//}    
        
         public function getPostArray($user_id, $memorial_id, $next_call=''){
                 // get array of first 25 from facebook                
              $fb = Registry::getInstance()->get("fb");  
//              echo "<br>****************  ????  *********************<br>";



              $call_for = $user_id.'/statuses?limit=100'.$next_call;
 //             echo "call for : $call_for";
 //             echo "<br>**************** *** *********************<br>";
              $array_of = $fb->api($call_for);
              //print_r($array_of, TRUE);
              //var_dump($array_of);                             

              $this->insertFacebookStatusUpdateInfo ($array_of, $memorial_id);
              
                //echo "<br>---------- getPostArray -----<br>";
 //             if (!$array_of[paging]["next"]==NULL){

//              	$next_call = $this->getNext($array_of);	
//              	echo "next call --- $next_call";
//              	$this->getPostArray($user_id,$memorial_id, $next_call);
              	            	
//              }              
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
		

 
        public function insertFacebookStatusUpdateInfo ($array_of, $memorial_id){
                // This function inserts the facebook photo array info into tables in the database tied to memorial id
                $db = Registry::getInstance()->get('db'); 
                $status_id =  "";
                $status_update = "";
                $status_updated_time = "";
                

                $c = NULL;
				$t = NULL;
				$l = NULL;		
				$s = NULL;
                
                foreach ($array_of["data"] as $value){
          		
                         $status_id =  ($value["id"]);
                         //if (isset( $value["name"] )){ $caption = ($value["name"]);}
                         $status_update = ($value["message"]);
                         //if (isset( $value["created_time"])){$photo_create_date = ($value["created_time"]);}
                         

                         if (is_array($value["tags"])){                        	
                          	if(sizeof(($value["tags"]["data"])) >= 1){
                          		$t = sizeof($value["tags"]["data"]);
                          		  //echo "<br>-----In this photo these people are tagged : <br>";
                                  foreach ($value["tags"]["data"] as $value1){
                                          $tagged_user_id = ($value1["id"]); 
                                          $tagged_user_name = ($value1["name"]); 
//                                          echo "$tagged_user_name has $tagged_user_id<br>"; 
                                          $query1 = "INSERT INTO  `Vixen_test`.`tags` (`memorial_id` ,`tagged_name` ,`tagged_fb_id` ,`tagged_item_id`)VALUES (
													'$memorial_id',  '$tagged_user_name',  '$tagged_user_id',  '$status_id')";                
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
                                          $time_of_comment = ($value2["created_time"]); 
                                        echo "the loooong comment $comments_user_comment";        
                                          $the_comment = mysqli_real_escape_string($db, $comments_user_comment); //$this->real_escape_string($caption);                          	
      									 if (sizeof($the_comment) <1){
      									 	$the_comment = "comment failed to come through";
      									 }
                                                                                                    
                                          $query2 = "INSERT INTO  `Vixen_test`.`comments` (`comment_id` ,`comment` ,`comment_type` ,`commenter_fb_id` ,`commenter_name` ,`memorial_id` ,`commented_item_id`,`time_of_comment`)VALUES (
													NULL ,  '$the_comment',  'post',  '$comments_user_id',  '$comments_user_name',  '$memorial_id',  '$status_id', '$time_of_comment')";                
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
													'$memorial_id',  '$likes_user_name',  '$likes_user_id',  '$status_id')";                
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
													'$memorial_id',  '$shares_user_name',  '$shares_user_id',  '$status_id')";                
                  						  //echo "this is shares ---  Q4 --- $query4";
                  						  $db->raw_query($query4); 
                  						  
                  						  
                                 }
                          	}
                          } 
                         
						  $total_meaning = $t+$l+$c+$s;
                     	  $the_status_update = mysqli_real_escape_string($db, $status_update); //$this->real_escape_string($caption);                          	
                               
						  $test = "INSERT INTO `Vixen_test`.`post` (`post_id`, `post`, `comment_id`, `like_id`, `share_id`, `tag_id`, `meaning_rank`, `to_be_approved`, `memorial_id`, `vote`, `post_create_date`) VALUES (" .
						  		"'$status_id', '$the_status_update', '$c', '$l', '$s', '$t', '$total_meaning', '0', '$memorial_id', '1', '$status_updated_time');";
						  $db->raw_query($test); 
                      
        		}
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
 
 

        
  
 }
 
 
 
 
 
