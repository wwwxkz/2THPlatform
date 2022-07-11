<link rel="stylesheet" href="../login/login.css">

<div class="container">
	<form method="post">
		<input class="input-text" name="company" placeholder="Company" type="text"/>
		<input class="input-text" name="user" placeholder="User" type="text"/>
		<input class="input-text" name="password" placeholder="Password" type="text"/>
		<button class="button" name="signin" type="submit">Sign In</button>
	</form>
</div>

<?php
	include_once '../../scripts/redirect.php';
	if(array_key_exists('signin' ,$_POST)){
		$url = "http://localhost/api/v1/user/login/?company=" . $_POST['company'] . "&password=" . $_POST['password'] . "&user=" . $_POST['user'];
		$return = json_decode(file_get_contents($url), true);
		if($return){
			print_r($return);
			if($return['data']['type'] == 'admin' or $return['data']['type'] == 'connector'){
				setcookie('company', $_POST['company'], time()+3600, '/');
				setcookie('password', $_POST['password'], time()+3600, '/');
				setcookie('user', $_POST['user'], time()+3600, '/');
				setcookie('id', $return['data']['id'], time()+3600, '/');
				setcookie('type', $return['data']['type'], time()+3600, '/');
				setcookie('theme', $return['data']['theme'], time()+3600, '/');
				redirect("../index/index");
			} else {
				//Error
			}
		}
	}
?>
