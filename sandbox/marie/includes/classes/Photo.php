<?php
/*
 * Created on Nov 16, 2013
 *
 * KISS it baby. Let's get the photo party started
 */
include includes/config.php;
 
 class Photo{
 
 	private $_name;
  	
 	public function __construct($name){
 		$this->name = $name;
 	}
 		
 	public function sayHello(){
 		print "Hello $this->name!"; 		
 	}
 			

  	
 }
 
 
?>
