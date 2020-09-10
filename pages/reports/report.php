<?php include_once '../index/index.php' ?>

<link rel="stylesheet" href="../reports/report.css">

<?php
    $data = $_GET;

    $url = "http://localhost/2THPlatform/api/v1/report/get/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
    $reports = json_decode(file_get_contents($url), true);

        $html = "
    <div>
        <table>
            <thead>
                <tr>
                    <th colspan=\"2\">Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>" . $data['id'] . "</th>
                </tr>
                <tr>
                    <th>Mac</th>
                    <th>" . $reports['data'][$data['id']]['mac'] . "</th>
                </tr>
                <tr>
                    <th>Latitude</th>
                    <th>" . $reports['data'][$data['id']]['lat'] . "</th>
                </tr>
                <tr>
                    <th>Longititude</th>
                    <th>" . $reports['data'][$data['id']]['lon'] . "</th>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                <th>Current</th>
                <th>New</th>
                </tr>
            </thead>
            <tbody>
                <form method=\"post\">
                    <tr>
                        <th>Name</th>
                        <td style=\"margin: 0; padding: 0;\"><div><input style=\"border-radius:0; box-shadow: 0; border: 0;\" type=\"text\" name=\"name\" value=\"" . $reports['data'][$data['id']]['name'] . "\"></div></td>
                    </tr>
                    <tr>
                        <th>Tag</th>
                        <td style=\"margin: 0; padding: 0;\"><div><input style=\"border-radius:0; box-shadow: 0; border: 0;\" type=\"text\" name=\"tag\" value=\"" . $reports['data'][$data['id']]['tag'] ."\"></div></td>
                    </tr>
                    <tr>
                        <th>Groups</th>
                        <td style=\"margin: 0; padding: 0;\"><div><input style=\"border-radius:0; box-shadow: 0; border: 0;\" type=\"text\" name=\"groups\" value=\"" . $reports['data'][$data['id']]['groups'] . "\"></div></td>
                    </tr>
                    <tr>
                        <form method=\"post\">
                            <td style=\"margin: 0; padding: 0;\"><input name=\"cancel\" value=\"Cancelar\" type=\"submit\"/></td>
                            <td style=\"margin: 0; padding: 0;\"><input name=\"save\" value=\"Salvar\" type=\"submit\"/></td>
                        </form>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
    ";
    
    echo $html;

    if(array_key_exists('save' ,$_POST)){
        foreach($_POST as $index => $string){
            $_POST[$index] = str_replace(' ', '+', $string);
        }

        $url = "http://localhost/2THPlatform/api/v1/report/update/?id=" . ($data['id'] + 1) . "&name=" . $_POST['name'] . "&tag=" . $_POST['tag'] . "&groups=" . $_POST['groups'] . "&company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
            
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        echo "<script>alert('Updated')</script>";

    }
    elseif(array_key_exists('cancel' ,$_POST)){
        echo "<script type=\"text/javascript\">location.href = '../reports.php';</script>";
    }

?>
