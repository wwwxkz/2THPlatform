<?php include_once '../index/index.php' ?>

<link rel="stylesheet" href="../settings/settings.css">

<?php
	$setting = 'profile/profile.php';
	if(array_key_exists('setting' ,$_POST)){
		$page = strtolower($_POST['setting']);
		$setting = $page . '/' . $page . '.php';
	}
	if(array_key_exists('edit' ,$_POST)){
		$setting = 'users/user.php';
	}
  if(array_key_exists('delete' ,$_POST)){
    $url = "http://localhost/2THPlatform/api/v1/user/delete/?id=" . $_POST['id'] . "&company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    $setting = 'users/users.php';
  }
  if(array_key_exists('update' ,$_POST)){
    foreach($_POST as $index => $string){
      $_POST[$index] = str_replace(' ', '+', $string);
    }
    $url = "http://localhost/2THPlatform/api/v1/user/update/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
    if(array_key_exists('password', $_POST)){
      $url .= "&new-password=" . $_POST['password']; 
    }
    $url .= "&id=" . $_POST['id'];      
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    if($_POST['user'] == $_COOKIE['user']) {
      redirect('../login/login');
    } else {
      $setting = 'users/users.php';
    }
  }
  elseif(array_key_exists('cancel' ,$_POST)){
    $setting = 'users/users.php';
  }
?>

<div class="sidebar-container">
	<div class="sidebar">
		<form method="post">
			<input name="setting" type="submit" value="Profile"/>
			<input name="setting" type="submit" value="Users"/>
		</form>
	</div>
	<div class="container">
		<?php require_once $setting ?>
	</div>
</div>