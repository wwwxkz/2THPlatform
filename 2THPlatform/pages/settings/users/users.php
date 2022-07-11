<link rel="stylesheet" href="users/users.css">

<div class="users">
	<table>
		<thead>
			<tr>
				<td>ID</td>
				<td>Name</td>
				<td>Theme</td>
				<td>Type</td>
				<td>Edit</td>
				<td>Delete</td>
			</tr>
		</thead>
		<tbody>
			<?php
				$html = "";
				$url = "http://localhost/api/v1/user/get/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
				$reports = json_decode(file_get_contents($url), true);
				foreach($reports['data'] as $index => $report){
					$html .= 
					"
					<tr>
						<form method=\"post\">
							<td style=\"text-align:center;\">" . $report['id'] . "</td>
							<td>" . $report['user'] . "</td>
							<td>" . $report['theme'] . "</td>
							<td>" . $report['type'] . "</td>
							<td style=\"margin: 0; padding: 0;\">
								<input class=\"button\" type=\"submit\" name=\"edit\" value=\"Edit\"/>
							</td>
							<td style=\"margin: 0; padding: 0;\">
								<input class=\"alert button\" type=\"submit\" name=\"delete\" value=\"Delete\"/>
							</td>
							<input type=\"hidden\" name=\"id\" value=\"" .  $report['id'] . "\"/>
						</form>
					</tr>
					";
				}
				echo $html;
			?>
		</tbody>
	</table>
</div>