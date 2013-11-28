<?php
/*
 * Created on Nov 27, 2013
 *
 *This class is has the tools for the post death stories
 *
 *
 */
 
 class Story{ 	
	
 	public function insertStory ($story_title,$text_of_story,$author_name,$author_fb_id,$genre,$memorial_id){
 		// takes user form input and stores it 
 		$db = Registry::getInstance()->get('db'); 
 		$query = "INSERT INTO  `Vixen_test`.`story` (`story_title` ,`story` ,`author` ,`author_id` ,'genre', 'memorial_id')VALUES (
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
 	
 	
 	
 	
 	
 	
 	
 	
 	
 	
 	
 	
 }
 
 
 
?>
