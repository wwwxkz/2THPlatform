<?php include_once '../index/index.php' ?>


<form method="post">
	<input type="text" name="company" placeholder="New company name">
	<input type="submit" name="save" value="company"/>
</form>

<form method="post">
	<input type="text" name="password" placeholder="New password">
	<input type="submit" name="save" value="password"/>
</form>

<?php

	if(array_key_exists('save' ,$_POST)){
		$settings = json_decode(file_get_contents('../../../../secure/companies.txt'), true);
		if(isset($_POST['company'])){
			//$settings['companies'][$_COOKIE['company']] = $_POST['company'];
		}
		elseif(isset($_POST['password'])){
			$settings['companies'][$_COOKIE['company']]['api_admin_password'] = $_POST['password'];
		}
		file_put_contents('../../../../secure/companies.txt', json_encode($settings));
		// Go back to login and update the cookies
	}
?>