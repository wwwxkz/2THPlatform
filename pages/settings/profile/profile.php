<form method="post">
	<input type="text" name="password" placeholder="New password">
	<input type="submit" name="save" value="password"/>
</form>

<?php
	if(array_key_exists('save' ,$_POST)){
		$settings = json_decode(file_get_contents('../../../../secure/companies.txt'), true);
		if(!$_POST['password'] == "" and !$_POST['password'] == null){
			$settings['companies'][$_COOKIE['company']]['api_admin_password'] = $_POST['password'];
		}
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