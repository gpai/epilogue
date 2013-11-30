<?php
/*
 * Created on Nov 29, 2013
 * This will be the class that handles the up down voting
 */
 
class Vote{
		public function insertVote ($memorial_id, $item_id){
                  // when item is added to the db it is added to the table, it should be added here too
                  $db = Registry::getInstance()->get('db');        
                  $query = "INSERT INTO  `Vixen_test`.`vote` (`memorial_id` ,`item_id` ,`vote`)VALUES ('$memorial_id',  '$item_id',  '1');";                
                  $db->raw_query($query);
                  echo "this is to insert the item into the vote table ";
          }
 
 
          public function getVote($memorial_id, $item_id){
                  // display the current vote for a photo_id
                  $db = Registry::getInstance()->get('db');        
                  $query = 'SELECT vote FROM vote WHERE item_id = "$item_id" AND memorial_id = "$memorial_id"';                
                  $current_vote = $db->raw_query($query);
                  echo "this is the current vote '$current_vote'";
                  return $current_vote;
          }
          
          public function upVote($memorial_id, $item_id){
                  // upvote an item 
                $db = Registry::getInstance()->get('db'); 
                $vote = $this->getVote($memorial_id, $item_id);
                ++$vote;
                $update_this = "UPDATE `Vixen_test`.`vote` SET vote = '$vote' WHERE item_id = '$item_id' AND memorial_id = '$memorial_id'";
                $db->raw_query($update_this);
                 echo "hey '$vote' was added to the vote count";
          }
 
          public function downVote($memorial_id, $item_id){
                  //  downvote an item
                $db = Registry::getInstance()->get('db'); 
                $vote = $this->getVote($memorial_id, $item_id);
                --$vote;
                $update_this = "UPDATE `Vixen_test`.`vote` SET vote = '$vote' WHERE item_id = '$item_id' AND memorial_id = '$memorial_id'";
                $db->raw_query($update_this);
                 echo "hey '$vote' was removed from the vote count";
          } 
 
 
} 
