<?php include_once '../index/index.php' ?>

<link rel="stylesheet" href="report.css">

<?php
    $data = $_GET;
    $url = "http://localhost/api/v1/report/get/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'] . "&id=" . $data['id'];
    $reports = json_decode(file_get_contents($url), true);
    $location = json_decode($reports['data'][0]['locations']);
    end($location);
    $key = key($location);
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
                    <td>Downloaded</td>
                    <td>" . formatBytes($reports['data'][0]['downloaded']) . "</td>
                </tr>
                <tr>
                    <td>Uploaded</td>
                    <td>" . formatBytes($reports['data'][0]['uploaded']) . "</td>
                </tr>
                <tr>
                    <td>Manufacturer</td>
                    <td>" . $reports['data'][0]['manufacturer'] . "</td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td>" . $reports['data'][0]['model'] . "</td>
                </tr>
                <tr>
                    <td>Mac</td>
                    <td>" . $reports['data'][0]['mac'] . "</td>
                </tr>
                <tr>
                    <td>Latitude</td>
                    <td>" . $location[$key]->lat . "</td>
                </tr>
                <tr>
                    <td>Longititude</td>
                    <td>" . $location[$key]->lon . "</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>" . $location[$key]->date . "</td>
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
                        <td><div><input class=\"input-text\" type=\"text\" name=\"name\" value=\"" . $reports['data'][0]['name'] . "\"></div></td>
                    </tr>
                    <tr>
                        <td>Tag</td>
                        <td><div><input class=\"input-text\" type=\"text\" name=\"tag\" value=\"" . $reports['data'][0]['tag'] ."\"></div></td>
                    </tr>
                    <tr>
                        <td>Groups</td>
                        <td><div><input class=\"input-text\" type=\"text\" name=\"groups\" value=\"" . $reports['data'][0]['groups'] . "\"></div></td>
                    </tr>
                    <tr>
                        <td>Telephone</td>
                        <td><div><input class=\"input-text\" type=\"text\" name=\"telephone\" value=\"" . $reports['data'][0]['telephone'] . "\"></div></td>
                    </tr>
                    <tr>
                        <form method=\"post\">
                            <td><button type=\"submit\" class=\"alert button\" name=\"cancel\" value=\"Cancelar\">Cancel</button></td>
                            <td><button type=\"submit\" class=\"button\" name=\"save\" value=\"Salvar\">Save</button></td>
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

        $url = "http://localhost/api/v1/report/update/?id=" . $data['id'] . "&name=" . $_POST['name'] . "&tag=" . $_POST['tag'] . "&groups=" . $_POST['groups']  . "&tel=" . $_POST['telephone'] . "&company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];

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
    function formatBytes($bytes, $precision = 2) { 
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow]; 
    }
?>
