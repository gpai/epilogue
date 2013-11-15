<?php
require_once "includes/config.php";

if (Login::isLoggedIn()): ?>

<h3>You</h3><?php
$user = $facebook->getUser();
?>
<img src="https://graph.facebook.com/<?php echo $user; ?>/picture">

      <h3>Your User Object (/me)</h3>
      <?php
      $user_profile = $facebook->api('/me');
      ?>
      <pre><?php print_r($user_profile); ?></pre>
<?php else: ?>
      <strong><em>You are not Connected.</em></strong>
<?php endif;



function sampleFunction() {
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

$var = input_from_facebook();
$array_column =  is_array ( mixed $var );//bool


$fb_array_name = from_facebook; //string to identify new column or add


function sampleParse_column() {
	global $facebook;
        global $user_profile;
	$result = string();
	$result = $facebook->api('/me');
	return $result;
if (!$array_column){
        echo $






$db_name = 'Vixen_test';
$col_name = 'exists';

$col = mysql_query("SELECT ".$col_name." FROM ".$db_name);


if (!$col){

    mysql_query("ALTER TABLE ".$db_name." ADD ".$col_name." DATETIME NOT NULL");

    echo $col_name.' has been added to the database';
} else {
    echo $col_name.' already exists';
}


function sampleFacebookFunction() {
	global $facebook;
	$result = array();
	$result = $facebook->api('/jedbrubaker/photos');
	return $result;
}

sampleFunction();
var_dump(sampleFacebookFunction());
