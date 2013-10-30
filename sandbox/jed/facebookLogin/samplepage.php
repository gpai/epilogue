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
      You are not Connected. Click <a href="login.php">here</a> to login.
<?php endif ?>

