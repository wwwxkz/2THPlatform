<?php include_once '../index/index.php' ?>

<table class="table table-bordered table-sm table-hover">
			<thead class="thead-dark">
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nome</th>
					<th scope="col">Latitude</th>
					<th scope="col">Longitude</th>
					<th scope="col">Tag</th>
					<th scope="col">MAC</th>
					<th scope="col">Edit</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$html = "";
					$url = "http://localhost/2THPlatform/api/v1/report/get/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
					$reports = json_decode(file_get_contents($url), true);
					foreach($reports['data'] as $index => $report){
						$html .= 
						"
						<tr>
							<th scope=\"row\">" . $index . "</th>
							<td>" . $report['name'] . "</td>
							<td>" . $report['lat'] . "</td>
							<td>" . $report['lon'] . "</td>
							<td>" . $report['tag'] . "</td>
							<td>" . $report['mac'] . "</td>
							<td style=\"margin: 0; padding: 0;\">
								<form method=\"post\">
									<input class=\"btn-block\" type=\"submit\" name=\"edit\" value=\"Edit " . $index . "\"/>
								</form>
							</td>
						</tr>
						";
					}
					echo $html;

					if(array_key_exists('edit' ,$_POST)){
						$id = explode(" ", $_POST['edit']);
						echo "<script type=\"text/javascript\">location.href = 'report.php/?id=" . $id[1] . "';</script>";
					}
				?>
			</tbody>
		</table>
