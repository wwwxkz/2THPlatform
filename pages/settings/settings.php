<?php include_once '../index/index.php' ?>

<link rel="stylesheet" href="../settings/settings.css">

<?php
	$setting = 'platform/platform.php';
	if(array_key_exists('setting' ,$_POST)){
		$page = strtolower($_POST['setting']);
		$setting = $page . '/' . $page . '.php';
	}
?>

<div class="sidebar-container">
	<div class="sidebar">
		<form method="post">
			<input name="setting" type="submit" value="Platform"/>
			<input name="setting" type="submit" value="Profile"/>
			<input name="setting" type="submit" value="Users"/>
		</form>
	</div>
	<div class="container">
		<?php require_once $setting ?>
	</div>
</div>