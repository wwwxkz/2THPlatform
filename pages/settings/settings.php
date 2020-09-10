<?php include_once '../index/index.php' ?>

<form method="post">
	<input type="text" name="password" placeholder="New password">
	<input type="submit" name="save" value="password"/>
</form>

<?php
	if(array_key_exists('save' ,$_POST)){
		$settings = json_decode(file_get_contents('../../../../secure/companies.txt'), true);
		if(isset($_POST['password'])){
			$settings['companies'][$_COOKIE['company']]['api_admin_password'] = $_POST['password'];
		}
		file_put_contents('../../../../secure/companies.txt', json_encode($settings));
		unset($_COOKIE['company']); 
		unset($_COOKIE['password']); 
		unset($_COOKIE['user']);
		redirect("../login/login");
	}
?>