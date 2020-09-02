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
            // DEBUG: Show parameters
            echo "Mac: " . $data[0] . "\n";
            echo "Lat: " . $data[1] . "\n";
            echo "Lon: " . $data[2] . "\n";

            if(strlen($data[0]) == 12) {
                $con = new PDO('mysql: host=locahost; dbname=company;','root','');

                $sql = "SELECT * FROM `reports` WHERE `mac`='" . $data[0] . "'";
                $sql = $con->prepare($sql);
                $sql->execute();

                if ($sql->fetch(PDO::FETCH_ASSOC) == true){
                    echo 'Exist';  
                    try {   
                        $sql = "UPDATE `reports` SET `lat`=" . $data[1] . ",`lon`=" . $data[2] . ",`date`=" . date("Y-m-d") . " WHERE `mac`='" . $data[0] . "'";
                        $con->exec($sql);
                        echo "Record updated successfully";
                    } catch(PDOException $e) {
                        echo $sql . "<br>" . $e->getMessage();
                    }
                } else {   
                    echo 'Does not exist';
                    try {
                        $sql = "INSERT INTO `reports`(`mac`, `lat`, `lon`, `date`) VALUES (" . $data[0] . "," . $data[1] . "," . $data[2] . "," . date("Y-m-d") . ")";
                        $con->exec($sql);
                        echo "New report created successfully";
                    } catch(PDOException $e) {
                        echo $sql . "<br>" . $e->getMessage();
                    }
                }
                $con = null;
            } else {
                throw new Exception("This is not a MAC Address");
            }

		}
	}