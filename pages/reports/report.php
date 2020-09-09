<?php include_once '../index/index.php' ?>
<?php
    $data = $_GET;

    $url = "http://localhost/2THPlatform/api/v1/report/get/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
    $reports = json_decode(file_get_contents($url), true);

        $html = "
    <div class=\"row justify-content-around\">
        <table class=\"col-md-3 table table-bordered table-sm table-hover\">
            <thead class=\"thead-dark\">
                <tr>
                    <th scope=\"col\" colspan=\"2\">Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope=\"row\">ID</th>
                    <th>" . $data['id'] . "</th>
                </tr>
                <tr>
                    <th scope=\"row\">Mac</th>
                    <th>" . $reports['data'][$data['id']]['mac'] . "</th>
                </tr>
                <tr>
                    <th scope=\"row\">Latitude</th>
                    <th>" . $reports['data'][$data['id']]['lat'] . "</th>
                </tr>
                <tr>
                    <th scope=\"row\">Longititude</th>
                    <th>" . $reports['data'][$data['id']]['lon'] . "</th>
                </tr>
            </tbody>
        </table>
        <table class=\"col-md-5 table table-bordered table-sm\">
            <thead class=\"thead-dark\">
                <tr>
                <th scope=\"col\">Current</th>
                <th scope=\"col\">New</th>
                </tr>
            </thead>
            <tbody>
                <form method=\"post\">
                    <tr>
                        <th scope=\"row\">Name</th>
                        <td style=\"margin: 0; padding: 0;\"><div class=\"input-group input-group-sm\"><input style=\"border-radius:0; box-shadow: 0; border: 0;\" type=\"text\" name=\"name\" value=\"" . $reports['data'][$data['id']]['name'] . "\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\"></div></td>
                    </tr>
                    <tr>
                        <th scope=\"row\">Tag</th>
                        <td style=\"margin: 0; padding: 0;\"><div class=\"input-group input-group-sm\"><input style=\"border-radius:0; box-shadow: 0; border: 0;\" type=\"text\" name=\"tag\" value=\"" . $reports['data'][$data['id']]['tag'] ."\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\"></div></td>
                    </tr>
                    <tr>
                        <th scope=\"row\">Groups</th>
                        <td style=\"margin: 0; padding: 0;\"><div class=\"input-group input-group-sm\"><input style=\"border-radius:0; box-shadow: 0; border: 0;\" type=\"text\" name=\"groups\" value=\"" . $reports['data'][$data['id']]['groups'] . "\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\"></div></td>
                    </tr>
                    <tr>
                        <form method=\"post\">
                            <td style=\"margin: 0; padding: 0;\" scope=\"row\"><input name=\"cancel\" value=\"Cancelar\" type=\"submit\" class=\"btn-block\"/></td>
                            <td style=\"margin: 0; padding: 0;\"><input name=\"save\" value=\"Salvar\" type=\"submit\" class=\"btn-block\"/></td>
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
