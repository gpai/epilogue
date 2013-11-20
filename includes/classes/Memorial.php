<?php
/*
 * Created on Nov 16, 2013 To change the template for this generated file go to Window - Preferences - PHPeclipse - PHP - Code Templates
 */

class Memorial {
	
	
	public function listMemorialId($epilogue_user_id) {
		// JED: First things first, let's get some objects!
		$db = Registry::getInstance()->get('db');
		// End Jed
		
		print "This will return an array of the memorials of this user id : '$epilogue_user_id'";

		$query = "SELECT memorial_id, deceased_name, epilogue_user_id FROM memorial_id WHERE epilogue_user_id = '$epilogue_user_id' ";
		$result = $db->fetchAll($query); 
		return $result;


 	}
 }

?>
