<?php

if (empty($_POST) === false) {
	$required_fields = array('email', 'password');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'You must type in an email and your password';
			break 1;
		}
	}
	
	if(md5($_POST['password']) != $user_data['password']){
		
		$errors[] = 'Invalid password';		
	}
	
	if (empty($errors) === true) {
		if ((empty($_POST['email']) === false) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false)) {
			$errors[] = 'A valid email address is required';
		}
		if ((empty($_POST['email']) === false) && (email_exists_outsideuser($_POST['email'], $user_data['user_id']) === true)) {
			$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use';
		}
	}
}

?>
<h1>Confirm Email</h1>

<?php
if (isset($_GET['s']) === true && empty($_GET['s']) === true) {
	echo 'Awesome, check your email and click the link to finish the process';
} else {
	
	
	if (empty($_POST) === false && empty($errors) === true) {
				
		register_email_only($_POST['email'], $session_user_id);
		header('Location: confirmemail.php?s');
		exit();
					
	}else if (empty($errors) === false) {
	
		echo output_errors($errors);
	}
	

?>

<form action="" method="post">
	<ul>
		<li>
			Email:<br>
			<input type="text" name="email">
		</li>
		<li>
			Password:<br>
			<input type="password" name="password">
		</li>
		<li>
			<input type="submit" value="Register">
		</li>
	</ul>
</form>

<?php

}

?>