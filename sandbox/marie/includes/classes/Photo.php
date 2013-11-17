<?php
/*
 * Created on Nov 16, 2013
 *
 * KISS it baby. Let's get the photo party started
 */

 class Photo{
 
 	private $_whosphoto;
  	$db = Registry::getInstance()->get('db');	
  	
 	public function __construct($_whosphoto){
 		$this->whosphoto = $whosphoto;
 	}
 		
 	public function getPhotos(){
 		print "Hello $this->name!"; 		
 	}
 			

  	
 }
 
 
?>
