<?php
/*Favorites... need to build  loop for these fields=books,movies,music,television
 * 
 */


 class Favorite{
 
        private $_favorite_array = array();
         
  
                 
        public function getFavorites($user_id){
              // get array of first 25 from facebook                
              $fb = Registry::getInstance()->get("fb");        
              $user_profile = $fb->api($user_id .'?fields=books,movies,music,television');
                 return $user_profile;
         }

        public function sortFavorites ($arr_of_favorites){
                // This function prints the facebook array into the lower level parts associated with the photo
                echo "<br>- Favorites : <br>"; 
                // Build loop for these types --- books,movies,music,television
                foreach ($arr_of_favorites["music"]["data"] as $value){
                	if(sizeof(($arr_of_favorites["music"]["data"])) > 1){
                         	
                                
                         $fav_id =  ($value["id"]);
                         $fav_title = ($value["name"]);
                         $created = ($value["created_time"]);
                         $category = ($value["category"]);

		                echo "*********** Title : $fav_title <br>";
                        echo "*********** Category: $category <br>";

                	}
                } 
        }
        public function insertDeceasedFavorites ($arr_of, $memorial_id){
                // okay so this one need the sort above to return that data
                // this one needs to stick it in the photo table with the associated memorial id
                echo " The array of sorted favorites will be added to $memorial_id<br>";
        }
 
                         

         public function getFavoriteVote($fav_id, $memorial_id){
                  // display the current vote for a photo_id
                  $db = Registry::getInstance()->get('db');        
                  $query = 'SELECT vote, memorial_id FROM favorite WHERE fav_id = "$post_id" AND memorial_id = "$memorial_id"';                
                  $current_vote = $db->raw_query($query);
                  echo "this is the current vote '$current_vote'";
          }
                    public function upFavoriteVote($post_id, $memorial_id, $vote){
                  // upvote or downvote to include in the memorial
                  $db = Registry::getInstance()->get('db');        
//                $update_this = "UPDATE `Vixen_test`.`favorite` SET vote = '$vote' WHERE memorial_id = '$memorial_id'";
//                $db->raw_query($update_this);
                echo "hey '$vote' was added to the vote count";
          }
                                  

        
  
 }
 
 
?>
