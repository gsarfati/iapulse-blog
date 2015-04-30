<?php
/*
Template Name: Custom Wordpress Login
*/
global $user_ID;

if (!$user_ID) {

	if($_POST){
		//We shall SQL escape all inputs
		$username = $wpdb->escape($_REQUEST['username']);
		$password = $wpdb->escape($_REQUEST['password']);
		$remember = $wpdb->escape($_REQUEST['rememberme']);
	
		if($remember) $remember = "true";
		else $remember = "false";
		$login_data = array();
		$login_data['user_login'] = $username;
		$login_data['user_password'] = $password;
		$login_data['remember'] = $remember;
		$user_verify = wp_signon( $login_data, false ); 
		//wp_signon is a wordpress function which authenticates a user. It accepts user info parameters as an array.
		
		if ( is_wp_error($user_verify) ) 
		{
		   echo "<span class='error'>Invalid username or password. Please try again!</span>";
		   exit();
		 } else 
		 {	
			echo "<script type='text/javascript'>window.location='". get_bloginfo('url') ."'</script>";
			exit();
		  }
	} else { 

get_header();

?>
<!-- <script src="http://code.jquery.com/jquery-1.4.4.js"></script> --> <!-- Release the comments if you are not using jQuery already in your theme -->
<center>
<div id="container">
<div id="content">
<?php the_title(); ?>
<div id="result"></div> <!-- To hold validation results -->
<form id="wp_login_form" action="" method="post">

<label>Username</label><br />
<input type="text" name="username" class="text" value="" /><br />
<label>Password</label><br />
<input type="password" name="password" class="text" value="" /> <br />
<label>
<input name="rememberme" type="checkbox" value="forever" />Remember me</label>
<input type="submit" id="submitbtn" name="submit" value="Login" />

</form>
<div id="container">
<div id="content">
<?php the_title(); ?>
<div id="result"></div> <!-- To hold validation results -->
<form id="wp_login_form" action="" method="post">

<label>Username</label><br />
<input type="text" name="username" class="text" value="" /><br />
<label>Password</label><br />
<input type="password" name="password" class="text" value="" /> <br />
<label>
<input name="rememberme" type="checkbox" value="forever" />Remember me</label>
<input type="submit" id="submitbtn" name="submit" value="Login" />

</form>
</center>
<script type="text/javascript">  						
$("#submitbtn").click(function() {

$('#result').html('<img src="<?php bloginfo('template_url'); ?>/images/loader.gif" class="loader" />').fadeIn();
var input_data = $('#wp_login_form').serialize();
$.ajax({
type: "POST",
url:  "<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>",
data: input_data,
success: function(msg){
$('.loader').remove();
$('<div>').html(msg).appendTo('div#result').hide().fadeIn('slow');
}
});
return false;

});
</script>

</div>
</div>
<?php

get_footer();
	}
}
else {
	echo "<script type='text/javascript'>window.location='". get_bloginfo('url') ."'</script>";
}
?>
