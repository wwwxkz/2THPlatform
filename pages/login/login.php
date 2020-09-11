<link rel="stylesheet" href="../login/login.css">

<div class="container">
	<form method="post">
		<input class="input-text" name="company" placeholder="Company" type="text"/>
		<input class="input-text" name="password" placeholder="Password" type="text"/>
		<input class="input-text" name="user" placeholder="User" type="text"/>
		<input class="button" name="signin" value="Sign In" type="submit"/>
	</form>
</div>

<?php
	include_once '../../scripts/redirect.php';
	if(array_key_exists('signin' ,$_POST)){
		$url = "http://localhost/2THPlatform/api/v1/report/login/?company=" . $_POST['company'] . "&password=" . $_POST['password'] . "&user=" . $_POST['user'];
		$return = json_decode(file_get_contents($url), true);
		if($return['data'] == 'admin' or $return['data'] == 'connector'){
			setcookie('company', $_POST['company']);
			setcookie('password', $_POST['password']);
			setcookie('user', $_POST['user']);
			redirect("../index/index");
		} else {
			echo $return['data'];
		}
	}
?>
