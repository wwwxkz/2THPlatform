<link rel="stylesheet" href="profile/profile.css">

<div class="profile">
	<form class="profile-form" method="post">
		<select name="theme" id="theme">
			<option value="dark">Dark</option>
			<option value="light">Light</option>
		</select>
		<button class="button" type="submit" name="save-theme">Save</button>
		<input class="input-text" type="text" name="password" placeholder="New password">
		<button class="button" type="submit" name="save-password">Password</button>
	</form>
</div>

<?php
	if(array_key_exists('save-password' ,$_POST)){
		// Verify if password input isnt blank or null
		if(!$_POST['password'] == "" and !$_POST['password'] == null){
			// Send current user data and new password to API
			$url = "http://localhost/api/v1/user/update/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'] . "&new-password=" . $_POST['password'] . "&id=" . $_COOKIE['id'];
			$return = json_decode(file_get_contents($url), true);
			echo $url;
			// Remove any cookie with obsolete data
			$_SERVER['HTTP_COOKIE'];
			if (isset($_SERVER['HTTP_COOKIE'])) {
			    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
			    foreach($cookies as $cookie) {
			        $parts = explode('=', $cookie);
			        $name = trim($parts[0]);
			        setcookie($name, '', time()-3600, '/');
			    }
			}
			// Redirect user to login page to get new cookies
			redirect("../login/login");
		}
	} 
	elseif(array_key_exists('save-theme' ,$_POST)){
		$url = "http://localhost/api/v1/user/update/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'] . "&new-theme=" . $_POST['theme'] . "&id=" . $_COOKIE['id'];
		$return = json_decode(file_get_contents($url), true);
		setcookie('theme', '', time()-3600, '/');
		setcookie('theme', $_POST['theme'], time()+3600, '/');
		redirect("settings");
	}
?>