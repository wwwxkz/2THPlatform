<form method="post">
	<select name="theme" id="theme">
	    <option value="dark">Dark</option>
	    <option value="light">Light</option>
	  </select>
	<input type="submit" name="save" value="save"/>
</form>

<?php
	if(array_key_exists('save' ,$_POST)){
		$settings = json_decode(file_get_contents('../../../../secure/companies.txt'), true);
		$settings['companies'][$_COOKIE['company']]['theme'] = $_POST['theme'];
		file_put_contents('../../../../secure/companies.txt', json_encode($settings));
	}
?>