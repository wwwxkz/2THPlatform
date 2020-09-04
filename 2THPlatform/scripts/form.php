<?php
            function changePage($page) {
				if (strpos($page, 'Edit') !== false) {
					$page = 'report';
				}
                $page = 'pages/'. $page . '.php';
                include $page;
            }

            if(array_key_exists('paginator',$_POST)){
				changePage($_POST["paginator"]);
			} elseif (array_key_exists('save',$_POST)) {
                foreach($_POST as $index => $string){
                    $_POST[$index] = str_replace(' ', '+', $string);
                }

                $url = "http://localhost/2THPlatform/api/v1/report/update/?id=" . $_POST['save'] . "&name=" . $_POST['name'] . "&tag=" . $_POST['tag'] . "&groups=" . $_POST['groups'];
            
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                $result = curl_exec($ch);
                curl_close($ch);

                changePage('Edit_'.$_POST['save']);

                echo "<script>alert('Atualizado')</script>";
			}
?>