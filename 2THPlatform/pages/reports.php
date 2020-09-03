<table class="table table-bordered table-sm">
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
					$url = 'http://localhost/2THPlatform/api/v1/report/get';
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
									<input style=\"width: 100%;\" type=\"submit\" name=\"test\" value=\"Edit_" . $index . "\"/>
								</form>
							</td>
						</tr>
						";
					}
					echo $html;
				?>
			</tbody>
		</table>
