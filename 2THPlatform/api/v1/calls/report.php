<?php

	class Report
	{
		public function get()
		{
			include_once '../../scripts/conn.php';

			$sql = "SELECT * FROM reports ORDER BY id ASC";
			$sql = $conn->prepare($sql);
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
            $data = $_GET;
            if(strlen($data['mac']) == 12) {
                include_once '../../scripts/conn.php';

                $sql = "SELECT * FROM `reports` WHERE `mac`=\"" . $data['mac'] . "\"";
                $sql = $conn->prepare($sql);
                $sql->execute();

                if ($sql->fetch(PDO::FETCH_ASSOC) == true){
                    echo 'Exist';
                    try {   
                        $sql = "UPDATE `reports` SET `lat`=" . $data['lat'] . ",`lon`=" . $data['lon'] . ",`date`='" . date("Y-m-d") . "' WHERE `mac`='" . $data['mac'] . "'";
                        $conn->exec($sql);
                        echo "Record updated successfully";
                    } catch(PDOException $e) {
                        echo $sql . "<br>" . $e->getMessage();
                    }
                } else {   
                    echo 'Does not exist';
                    try {
                        $sql = "INSERT INTO `reports`(`mac`, `lat`, `lon`, `date`) VALUES (\"" . $data['mac'] . "\"," . $data['lat'] . "," . $data['lon'] . ",'" . date("Y-m-d") . "')";
                        $conn->exec($sql);
                        echo "New report created successfully";
                    } catch(PDOException $e) {
                        echo $sql . "<br>" . $e->getMessage();
                    }
                }
                $conn = null;
                } else {
                    throw new Exception("This is not a MAC Address");
                }




        }
        public function update()
		{
            $data = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $id = $_GET['id'];
            print_r($data);
            
            include_once '../../scripts/conn.php';

            try {
                $sql = "UPDATE `reports` SET `name`=\"" . $data['name'] . "\",`tag`=\"" . $data['tag'] . "\",`groups`=\"" . $data['groups'] . "\" WHERE id = $id";   
                $conn->exec($sql);
            } catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }
	}