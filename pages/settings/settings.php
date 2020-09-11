<?php include_once '../index/index.php' ?>

<link rel="stylesheet" href="../settings/settings.css">

<div class="container">
	<form method="post">
		<select name="theme" id="theme">
    		<option value="dark">Dark</option>
    		<option value="light">Light</option>
  		</select>
		<input type="text" name="password" placeholder="New password">
		<input type="submit" name="save" value="password"/>
	</form>
</div>

<?php
	if(array_key_exists('save' ,$_POST)){
		$settings = json_decode(file_get_contents('../../../../secure/companies.txt'), true);
		if(isset($_POST['password'])){
			$settings['companies'][$_COOKIE['company']]['api_admin_password'] = $_POST['password'];
		}
		$settings['companies'][$_COOKIE['company']]['theme'] = $_POST['theme'];
		file_put_contents('../../../../secure/companies.txt', json_encode($settings));
		unset($_COOKIE['company']); 
		unset($_COOKIE['password']); 
		unset($_COOKIE['user']);
		redirect("../login/login");
	}
?>