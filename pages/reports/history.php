<?php include_once '../index/index.php' ?>

<link rel="stylesheet" href="history.css">

<div class="container">
	<table>
		<thead>
			<tr>
			    <td>Date</td>
			    <td>Lat</td>
			    <td>Lon</td>
			</tr>
		</thead>
		<tbody>
			<?php
				$html = "";
			    $data = $_GET;
			    $url = "http://localhost/api/v1/report/get/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'] . "&id=" . $data['id'];
			    $reports = json_decode(file_get_contents($url), true);
			    $locations = json_decode($reports['data'][0]['locations']);
			    foreach ($locations as $key => $location) {
				    $html .= "<tr>
				            	<td>" . $location->date . "</td>
					            <td>" . $location->lat . "</td>
					            <td>" . $location->lon . "</td>
					        </tr>";
			    }
			    echo $html;
			?>
		</tbody>
	</table>
</div>
   