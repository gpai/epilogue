<?php
/*
 * Created on Nov 27, 2013
 *
 *This class is has the tools for the post death stories
 *
 *
 */
 
 class Story{ 	
	
	// FYI genre = 'solo' (for the individual memories) OR 'etal' (for the collaboratve)
	
 	public function insertStory ($story_title,$text_of_story,$author_name,$author_fb_id,$genre,$memorial_id){
 		// takes user form input and stores it 
 		$db = Registry::getInstance()->get('db'); 
 		$query = "INSERT INTO  `Vixen_test`.`story` (`story_title` ,`story` ,`author_name` ,`author_fb_id` ,'genre', 'memorial_id')VALUES (
													'$story_title',  '$text_of_story',  '$author_name',  '$author_fb_id', '$genre', '$memorial_id')";                
        $db->raw_query($query);				
 	 		
 	}
 	
 	 public function getStory ($memorial_id){
 		// takes memorial id and returns stories from db 
 		$db = Registry::getInstance()->get('db');      
        $query = 'SELECT story_title ,story ,author ,author_id ,genre ,memorial_id FROM story WHERE memorial_id = "$memorial_id"';                
        $stories = $db->fetchAll($query);
        return $stories;
 	 }
 	
  	 public function updateStory ($story_id,$story_title,$text_of_story,$author_name,$author_fb_id,$memorial_id){
 		// takes memorial id and returns stories from db 
        $db = Registry::getInstance()->get('db');        
        $update_this = "UPDATE `Vixen_test`.`story` SET story_title = '$story_title', story = '$text_of_story', author_name = '$author_name', author_fb_id = `$author_fb_id'  WHERE story_id = '$story_id' AND memorial_id = '$memorial_id'";
        $db->raw_query($update_this);

 	 }	
 	
 	
 	
 	
 	
 	
 	
 	
 	
 	
 }
 
 
 
?>
