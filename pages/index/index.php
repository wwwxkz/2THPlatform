<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<?php
		echo "<link rel=\"stylesheet\" href=\"../" . $_COOKIE['theme'] . ".css\">";
	?>
	<link rel="stylesheet" href="../index/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>2THPlatform</title>
</head>
<body>
	<div class="topnav" id="myTopnav">
		<form method="post">
			<input name="page" type="button" value="2TH Platform"/>
			<input name="page" type="submit" value="Reports"/>
			<input name="page" type="submit" value="Map"/>
			<input name="page" type="submit" value="Settings"/>
			<a type="submit" class="icon" onclick="mobileNav()">
				<i class="fa fa-bars"></i>
			</a>
		</form>
	</div>

	<?php
		include_once '../../scripts/redirect.php';

		if(array_key_exists('page' ,$_POST)){
			redirect('../' . $_POST['page'] . '/' . $_POST['page']);
		}
	?>

	<script>
		function mobileNav() {
		  var x = document.getElementById("myTopnav");
		  if (x.className === "topnav") {
		    x.className += " responsive";
		  } else {
		    x.className = "topnav";
		  }
		}
	</script>

</body>
</html>


