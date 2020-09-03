<table class="table table-bordered table-sm">
			<thead class="thead-dark">
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