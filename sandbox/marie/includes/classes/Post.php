<?php
/*
 * Created on Nov 16, 2013
 *
 * KISS it baby. Let's get the photo party started
 */

 class Post{
 
        private $_post_array = array();
         
  
                 
        public function getPosts($user_id){
              // get array of first 25 from facebook                
              $fb = Registry::getInstance()->get("fb");        
              $user_profile = $fb->api($user_id .'/posts');
                 return $user_profile;
         }

        public function sortPosts ($arr_of_posts){
                // This function prints the facebook array into the lower level parts associated with the photo
                foreach ($arr_of_posts["data"] as $value){
                         $post_id =  ($value["id"]);
                         $post = ($value["message"]);
                         $name_posted = ($value["from"]["name"]);
                         $id_posted = ($value["from"]["id"]);

                          if (is_array($value["tags"])){
                          	if(sizeof(($value["tags"]["data"])) > 1){
                          		  echo "<br>-In this post these people are tagged : <br>";
                                  foreach ($value["tags"]["data"] as $value){
                                          $tagged_user_id = ($value["id"]); 
                                          $tagged_user_name = ($value["name"]); 
                                          echo "$tagged_user_name has $tagged_user_id<br>";                                  
                                  }                          		
                          	}

                          }
                          
                          if (is_array($value["comments"])){
                          	if(sizeof(($value["comments"]["data"])) > 1){
                          		  echo "<br>-In this post these people mades comments : <br>";      	
                                  foreach ($value["comments"]["data"] as $value){
                                          $comment_id = ($value["id"]); 
                                          $comments_user_name = ($value["from"]["name"]); 
                                          $comments_user_id = ($value["from"]["id"]); 
                                          $comments_user_comment = ($value["message"]); 
                                          echo "Commenter Name : $comments_user_name <br> Commented : $comments_user_comment <br>";                                           		"By : $comments_user_name ID :  $comments_user_id<br>";                                   }
                          	}
                          }

                          if (is_array($value["likes"])){
                          	if(sizeof(($value["likes"]["data"])) > 1){
                          		  echo "<br>-These people liked this post : <br>";
                                  foreach ($value["likes"]["data"] as $value){
                                          $likes_user_id = ($value["id"]); 
                                          $likes_user_name = ($value["name"]); 
                                          echo "$likes_user_name has $likes_user_id<br>";  
                                  }                                
                            }
                          }
                          
                          if (is_array($value["shares"])){
                          	if(sizeof(($value["shares"]["data"])) > 1){
                          		  echo "<br>-These people shared this post : <br>";
                                  foreach ($value["shares"]["data"] as $value){
                                          $shares_user_id = ($value["id"]); 
                                          $shares_user_name = ($value["name"]); 
                                          echo "$shares_user_name has $shares_user_id<br>";                                  
                                  }
                          	}
                          }
                          echo "*********** Post ID : $post_id <br>";
                          echo "*********** The post: $post <br>";
                          echo "*********** Who posted : $name_posted <br>";
                } 
        }
        public function insertDeceasedPosts ($arr_of, $memorial_id){
                // okay so this one need the sort above to return that data
                // this one needs to stick it in the photo table with the associated memorial id
                echo " The array of sorted posts will be added to $memorial_id<br>";
        }
 
                         

         public function getPostVote($post_id, $memorial_id){
                  // display the current vote for a photo_id
                  $db = Registry::getInstance()->get('db');        
                  $query = 'SELECT vote, memorial_id FROM post WHERE post_id = "$post_id" AND memorial_id = "$memorial_id"';                
                  $current_vote = $db->raw_query($query);
                  echo "this is the current vote '$current_vote'";
          }
                    public function upPostVote($post_id, $memorial_id, $vote){
                  // upvote or downvote to include in the memorial
                  $db = Registry::getInstance()->get('db');        
//                $update_this = "UPDATE `Vixen_test`.`post` SET vote = '$vote' WHERE memorial_id = '$memorial_id'";
//                $db->raw_query($update_this);
                echo "hey '$vote' was added to the vote count";
          }
                                  

        
  
 }
 
 
