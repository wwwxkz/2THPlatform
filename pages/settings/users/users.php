<link rel="stylesheet" href="users/users.css">

<table>
	<thead>
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>Theme</td>
			<td>Type</td>
			<td>Edit</td>
		</tr>
	</thead>
	<tbody>
		<?php
			$html = "";
			$url = "http://localhost/2THPlatform/api/v1/user/get/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&name=" . $_COOKIE['user'];
			$reports = json_decode(file_get_contents($url), true);
			foreach($reports['data'] as $index => $report){
				$html .= 
				"
				<tr>
					<form method=\"post\">
						<input type=\"hidden\" name=\"id\" value=\"" .  $report['id'] . "\"/>
						<input type=\"hidden\" name=\"index\" value=\"" .  $index . "\"/>
						<td>" . $report['id'] . "</td>
						<td>" . $report['name'] . "</td>
						<td>" . $report['theme'] . "</td>
						<td>" . $report['type'] . "</td>
						<td style=\"margin: 0; padding: 0;\">
							<input type=\"submit\" name=\"edit\" value=\"Edit\"/>
						</td>
					</form>
				</tr>
				";
			}
			echo $html;
		?>
	</tbody>
</table>