<?php

	class Reports
	{
		public function show()
		{
			$con = new PDO('mysql: host=locahost; dbname=company;','root','');

			$sql = "SELECT * FROM reports ORDER BY id ASC";
			$sql = $con->prepare($sql);
			$sql->execute();

			$results = array();

			while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
				$results[] = $row;
			}

			if (!$results) {
				throw new Exception("None report in reports");
			}
			
			return $results;
		}
	}