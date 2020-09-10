<?php include_once '../index/index.php' ?>

<link rel="stylesheet" href="../reports/reports.css">

<div class="container">
	<table>
		<thead>
			<tr>
				<td>ID</td>
				<td>Nome</td>
				<td>Latitude</td>
				<td>Longitude</td>
				<td>Tag</td>
				<td>MAC</td>
				<td>Edit</td>
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
						<td>" . $index . "</td>
						<td>" . $report['name'] . "</td>
						<td>" . $report['lat'] . "</td>
						<td>" . $report['lon'] . "</td>
						<td>" . $report['tag'] . "</td>
						<td>" . $report['mac'] . "</td>
						<td style=\"margin: 0; padding: 0;\">
							<form method=\"post\">
								<input type=\"submit\" name=\"edit\" value=\"Edit " . $index . "\"/>
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
</div>
