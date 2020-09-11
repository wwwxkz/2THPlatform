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
		if(!$_POST['password'] == "" and !$_POST['password'] == null){
			$settings['companies'][$_COOKIE['company']]['api_admin_password'] = $_POST['password'];
		}
		$settings['companies'][$_COOKIE['company']]['theme'] = $_POST['theme'];
		file_put_contents('../../../../secure/companies.txt', json_encode($settings));

		$_SERVER['HTTP_COOKIE'];
		if (isset($_SERVER['HTTP_COOKIE'])) {
		    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		    foreach($cookies as $cookie) {
		        $parts = explode('=', $cookie);
		        $name = trim($parts[0]);
		        setcookie($name, '', time()-3600, '/');
		    }
		}

		redirect("../login/login");
	}
?>