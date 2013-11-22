<?php

//Helper functions for MySql all in one place, all are set to go to Vixen_test.
// I should fix that and pull it up here.
//  - sampleGet() = SELECT from tables in the
//  - sampleInsert() = INSERT
//  - sampleChange() = UPDATE
//  - InsertFriendList($facebook_user_id,$facebook_user_name) = Runs on log-in to display a list of FbFriends for the user to invite
//  - GetFacebookFriends() = 

$current_database = 'Vixen_test';

function sampleGet() {
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie');

	//test to see connection of database
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}

	// select Vixen_test database
	mysql_select_db('Vixen_test');
	$SQL = 'SELECT photo_id, photo_date, caption, comment_id, meaning_rank FROM photo';
	$result = mysql_query($SQL, $link);

	if(! $result){
		die('Could not get data: ' . mysql_error());
	}
	while($row = mysql_fetch_assoc($result )){
		echo "<br>Photo ID:{$row['photo_id']} <br>".
			 "Photo Date : {$row['photo_date']} <br> ".
			 "Caption : {$row['caption']} <br> ".
			 "Comment ID : {$row['comment_id']} <br> ".
			 "--------------------------------- <br>";
	}
}


function sampleInsert() {
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_test');

	//test to see connection of database
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}

	// select Vixen_test database
	mysql_select_db('Vixen_test');
	$insert_please = "INSERT INTO  `Vixen_test`.`photo` VALUES (
'0981',  'blah.com',  '3451',  '1231',  '2221',  '12341',  '',  '2013-10-03 15:24:46',  'Yeah, its a shame he lost his eyebrows, but it was a great bonfire!', NULL , NULL ,  '',  '0' )";
	echo "----------------test 1";
	mysql_query($insert_please, $link);

}

function InsertFriendList($facebook_user_id,$facebook_user_name) {
	global $epilogue_user_id;
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_test');
		if (!$link) {
			die('Could not connect: ' . mysql_error());
		}
	$insert_please = "INSERT INTO  `Vixen_test`.`user_friend_list` VALUES (
'$epilogue_user_id',  '$facebook_user_id', '$facebook_user_name', 'N', 0, 0)";
	mysql_query($insert_please, $link);
}



function sampleChange() {
        // This is the function to change things like the photo date, add a caption and such.
        // $info_to_change should end up being some sort of string list of the newly changed data (i.e. the new caption and new date)
        // $item_id should be the unique Facebook provided id reference to the photo or post etc
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_test');

	//test to see connection of database
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}

	// select Vixen_test database
	mysql_select_db('Vixen_test');

	// chose the table and then update some of  fields in it
        $info_to_change = '2012-02-15 15:24:46';
        $item_id = '0981';

	$update_this = "UPDATE `Vixen_test`.`photo` SET photo_date = '$info_to_change' WHERE photo_id = '$item_id' ";

	mysql_query($update_this, $link);

}

//function sampleInsert() {
//$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_test');

	//test to see connection of database
//	if (!$link) {
//		die('Could not connect: ' . mysql_error());
//	}

	// select Vixen_test database
//	mysql_select_db('Vixen_test');
//	$insert_please = "INSERT INTO  `Vixen_test`.`photo` VALUES (
//'0981', 'blah.com',  '3451',  '1231',  '2221',  '12341',  '',  '2013-10-03 15:24:46',  'Yeah, its a shame he lost his eyebrows, but it was a great bonfire!', NULL , NULL ,  '',  '0' )";
//	echo "----------------test 1";
//	mysql_query($insert_please, $link);
//}


function InsertFacebookFriends() {
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_test');
     global $facebook_user_id;
     global $facebook_user_name;
     global $user_profile;
     $epilogue_user_id = $user_profile["id"];


	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db('Vixen_test');
	$insert_please = "INSERT INTO  `Vixen_test`.`try_insert` VALUES (
'$facebook_user_id',  '$facebook_user_name', '$epilogue_user_id')";

	mysql_query($insert_please, $link);

}


function GetFacebookFriends() {
	$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie');

	//test to see connection of database
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}

	// select Vixen_test database
	mysql_select_db('Vixen_test');
	$SQL = 'SELECT * FROM user_friend_list';
	$result = mysql_query($SQL, $link);

	if(! $result){
		die('Could not get data: ' . mysql_error());
	}
	
	while($row = mysql_fetch_assoc($result )){
		echo "<br>Facebook ID : {$row['facebook_user_id']} <br>".
			 "Facebook Name : {$row['facebook_name']} <br> ".
			 "Epilogue ID : {$row['epilogue_user_id']} <br> ".
			 "--------------------------------- <br>";
			 }
}

//function UpdateDeceased($deceased_facebook_user_id){//$link = mysql_connect('mysql2.speedypuppy.net:3306', 'Vixen_VixGrace', 'cutie', 'Vixen_test');
//	$update_this = "UPDATE 'Vixen_test'.`user_friend_list` SET deceased =  '1' WHERE facebook_user_id = '$deceased_facebook_user_id' ";
	//test to see connection of database
//	if (!$link) {
//		die('Could not connect: ' . mysql_error());
//	}

	// select Vixen_test database
//	mysql_select_db('Vixen_test');
//	$result = mysql_query($update_this, $link);
//}

?>