<?php include_once '../index/index.php' ?>

<link rel="stylesheet" href="../reports/reports.css">

<div class="container">
	<table>
		<thead>
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Latitude</td>
				<td>Longitude</td>
				<td>Tag</td>
				<td>Date</td>
				<td>MAC</td>
				<td>Edit</td>
				<td>Delete</td>
			</tr>
		</thead>
		<tbody>
			<?php
				$html = "";
				$url = "http://localhost/2THPlatform/api/v1/report/get/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
				$reports = json_decode(file_get_contents($url), true);
				if($reports){
					foreach($reports['data'] as $index => $report){
						$html .= 
						"
						<form method=\"post\">
							<tr>
								<td>" . $report['id'] . "</td>
								<td>" . $report['name'] . "</td>
								<td>" . $report['lat'] . "</td>
								<td>" . $report['lon'] . "</td>
								<td>" . $report['tag'] . "</td>
								<td>" . $report['date'] . "</td>
								<td>" . $report['mac'] . "</td>
								<td style=\"margin: 0; padding: 0;\">
									<input type=\"submit\" name=\"edit\" value=\"Edit " . $index . "\"/>
								</td>
								<td style=\"margin: 0; padding: 0;\">
								 	<input type=\"hidden\" name=\"id\" value=\"" . $report['id'] . "\">
									<input type=\"submit\" name=\"delete\" value=\"Delete " . $index . "\"/>
								</td>
							</tr>
						</form>
						";
					}
				}
				echo $html;

				if(array_key_exists('edit' ,$_POST)){
					$id = explode(" ", $_POST['edit']);
					echo "<script type=\"text/javascript\">location.href = 'report.php?id=" . ($id[1]+1) . "';</script>";
				}
				elseif(array_key_exists('delete' ,$_POST)){
			        $url = "http://localhost/2THPlatform/api/v1/report/delete/?id=" . $_POST['id'] . "&company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
			        $ch = curl_init();
			        curl_setopt($ch, CURLOPT_URL, $url);
			        curl_setopt($ch, CURLOPT_POST, 1);
			        $result = curl_exec($ch);
			        curl_close($ch);
			        // Return user to the same page to reload records
			        redirect("reports");
				}
			?>
		</tbody>
	</table>
</div>
