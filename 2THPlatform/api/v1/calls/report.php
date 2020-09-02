<?php

	class Report
	{
		public function get()
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
        public function send($parameters)
		{
            $data = explode('_', $parameters);
            echo "Mac: " . $data[0] . "\n";
            echo "Lat: " . $data[1] . "\n";
            echo "Lon: " . $data[2] . "\n";

            // Send to database
			//$con = new PDO('mysql: host=locahost; dbname=company;','root','');

			//$sql = "SELECT * FROM reports ORDER BY id ASC"; // Create new position in database related to macadress
			//$sql = $con->prepare($sql);
			//$sql->execute();
		}
	}