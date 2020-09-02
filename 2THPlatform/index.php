<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<title>2THPlatform</title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<a class="navbar-brand" href="#">Nome empresa</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		<li class="nav-item active">
			<a class="nav-link" href="#">Dashboard<span class="sr-only">(current)</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Reports</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Mapa</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Configurações
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<a class="dropdown-item" href="#">Action</a>
			<a class="dropdown-item" href="#">Another action</a>
			<div class="dropdown-divider"></div>
			<a class="dropdown-item" href="#">Something else here</a>
			</div>
		</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
		<input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
		<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
		</form>
	</div>
	</nav>

	<div class="container">
		<table class="table table-sm table-dark">
			<thead>
				<tr>
				<th scope="col">ID</th>
				<th scope="col">Nome</th>
				<th scope="col">Latitude</th>
				<th scope="col">Longitude</th>
				<th scope="col">Tag</th>
				<th scope="col">MAC</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$html = "";
					$url = 'http://localhost/2THPlatform/api/v1/report/get';
					$reports = json_decode(file_get_contents($url), true);
					foreach($reports['data'] as $index => $report){
						$html .= 
						"
						<tr>
							<th scope=\"row\">" . $index . "</th>
							<td>" . $reports['data'][$index]['name'] . "</td>
							<td>" . $reports['data'][$index]['lat'] . "</td>
							<td>" . $reports['data'][$index]['lon'] . "</td>
							<td>" . $reports['data'][$index]['tag'] . "</td>
							<td>" . $reports['data'][$index]['mac'] . "</td>
						</tr>
						";
					}
					echo $html;
				?>
			</tbody>
		</table>

	</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>