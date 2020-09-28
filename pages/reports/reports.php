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
				<td>History</td>
				<td>Edit</td>
				<td>Delete</td>
			</tr>
		</thead>
		<tbody>
			<?php
				$html = "";
				$url = "http://localhost/api/v1/report/get/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
				$reports = json_decode(file_get_contents($url), true);
				if($reports){
					foreach($reports['data'] as $index => $report){
						// Get last report location
						$locations = json_decode($report['locations']);
						end($locations);
						$key = key($locations);
						$html .= 
						"
						<form method=\"post\">
							<tr>
								<td>" . $report['id'] . "</td>
								<td>" . $report['name'] . "</td>
								<td>" .	$locations[$key]->lat . "</td>
								<td>" . $locations[$key]->lon . "</td>
								<td>" . $report['tag'] . "</td>
								<td>" . $locations[$key]->date . "</td>
								<td>" . $report['mac'] . "</td>
								<td class=\"td-button\">
									<button class=\"info button\" type=\"submit\" name=\"history\"/>History</button>
								</td>
								<td class=\"td-button\">
									<button class=\"button\" type=\"submit\" name=\"edit\"/>Edit</button>
								</td>
								<td class=\"td-button\">
								 	<input type=\"hidden\" name=\"id\" value=\"" . $report['id'] . "\">
									<button class=\"alert button\" type=\"submit\" name=\"delete\">Delete</button>
								</td>
							</tr>
						</form>
						";
					}
				}
				echo $html;

				if(array_key_exists('edit' ,$_POST)){
					echo "<script type=\"text/javascript\">location.href = 'report.php?id=" . $_POST['id'] . "';</script>";
				}
				elseif(array_key_exists('history' ,$_POST)) {
					echo "<script type=\"text/javascript\">location.href = 'history.php?id=" . $_POST['id'] . "';</script>";
				}
				elseif(array_key_exists('delete' ,$_POST)){
			        $url = "http://localhost/api/v1/report/delete/?id=" . $_POST['id'] . "&company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
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
