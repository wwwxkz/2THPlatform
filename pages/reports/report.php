<?php include_once '../index/index.php' ?>

<link rel="stylesheet" href="report.css">

<?php
    $data = $_GET;

    $url = "http://localhost/2THPlatform/api/v1/report/get/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
    $reports = json_decode(file_get_contents($url), true);

    $html = "
    <div class=\"container\">
        <table>
            <thead>
                <tr>
                    <td colspan=\"2\">Data</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>" . $data['id'] . "</td>
                </tr>
                <tr>
                    <td>Mac</td>
                    <td>" . $reports['data'][$data['id']]['mac'] . "</td>
                </tr>
                <tr>
                    <td>Latitude</td>
                    <td>" . $reports['data'][$data['id']]['lat'] . "</td>
                </tr>
                <tr>
                    <td>Longititude</td>
                    <td>" . $reports['data'][$data['id']]['lon'] . "</td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                <td>Current</td>
                <td>New</td>
                </tr>
            </thead>
            <tbody>
                <form method=\"post\">
                    <tr>
                        <td>Name</td>
                        <td><div><input class=\"input-text\" type=\"text\" name=\"name\" value=\"" . $reports['data'][$data['id']]['name'] . "\"></div></td>
                    </tr>
                    <tr>
                        <td>Tag</td>
                        <td><div><input class=\"input-text\" type=\"text\" name=\"tag\" value=\"" . $reports['data'][$data['id']]['tag'] ."\"></div></td>
                    </tr>
                    <tr>
                        <td>Groups</td>
                        <td><div><input class=\"input-text\" type=\"text\" name=\"groups\" value=\"" . $reports['data'][$data['id']]['groups'] . "\"></div></td>
                    </tr>
                    <tr>
                        <form method=\"post\">
                            <td><input class=\"button\" name=\"cancel\" value=\"Cancelar\" type=\"submit\"/></td>
                            <td><input class=\"button\" name=\"save\" value=\"Salvar\" type=\"submit\"/></td>
                        </form>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
    ";
    
    echo $html;

    if(array_key_exists('save' ,$_POST)){
        // Remove spaces from the string
        foreach($_POST as $index => $string){
            $_POST[$index] = str_replace(' ', '+', $string);
        }

        $url = "http://localhost/2THPlatform/api/v1/report/update/?id=" . ($data['id'] + 1) . "&name=" . $_POST['name'] . "&tag=" . $_POST['tag'] . "&groups=" . $_POST['groups'] . "&company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        redirect("reports");
    }
    elseif(array_key_exists('cancel' ,$_POST)){
        redirect("reports");
    }

?>
