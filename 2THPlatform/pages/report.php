<?php
    include_once 'scripts/conn.php';

    if(array_key_exists('save', $_POST)){
        $id = explode("_", $_POST["save"]);
        $id = $id[0];
    } else {
        $id = explode("_", $_POST["paginator"]);
        $id = $id[1]+1;
    }

    $sql = "SELECT * FROM `reports` WHERE `id`=$id";

    $sql = $conn->prepare($sql);
    $sql->execute();

    $reports = array();

    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $reports[] = $row;
    }

    if (!$reports) {
        throw new Exception("None report in reports");
    }

    $html = "
    <div class=\"row justify-content-around\">
        <table class=\"col-md-3 table table-bordered table-sm table-hover\">
            <thead class=\"thead-dark\">
                <tr>
                    <th scope=\"col\" colspan=\"2\">Dados</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope=\"row\">ID</th>
                    <th>" . $id . "</th>
                </tr>
                <tr>
                    <th scope=\"row\">Mac</th>
                    <th>" . $reports[0]['mac'] . "</th>
                </tr>
                <tr>
                    <th scope=\"row\">Latitude</th>
                    <th>" . $reports[0]['lat'] . "</th>
                </tr>
                <tr>
                    <th scope=\"row\">Longititude</th>
                    <th>" . $reports[0]['lon'] . "</th>
                </tr>
            </tbody>
        </table>
        <table class=\"col-md-5 table table-bordered table-sm\">
            <thead class=\"thead-dark\">
                <tr>
                <th scope=\"col\">Atual</th>
                <th scope=\"col\">Novo</th>
                </tr>
            </thead>
            <tbody>
                <form method=\"post\">
                    <tr>
                        <th scope=\"row\">Name</th>
                        <td style=\"margin: 0; padding: 0;\"><div class=\"input-group input-group-sm\"><input style=\"border-radius:0; box-shadow: 0; border: 0;\" type=\"text\" name=\"name\" value=\"" . $reports[0]['name'] . "\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\"></div></td>
                    </tr>
                    <tr>
                        <th scope=\"row\">Tag</th>
                        <td style=\"margin: 0; padding: 0;\"><div class=\"input-group input-group-sm\"><input style=\"border-radius:0; box-shadow: 0; border: 0;\" type=\"text\" name=\"tag\" value=\"" . $reports[0]['tag'] ."\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\"></div></td>
                    </tr>
                    <tr>
                        <th scope=\"row\">Groups</th>
                        <td style=\"margin: 0; padding: 0;\"><div class=\"input-group input-group-sm\"><input style=\"border-radius:0; box-shadow: 0; border: 0;\" type=\"text\" name=\"groups\" value=\"" . $reports[0]['groups'] . "\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\"></div></td>
                    </tr>
                    <tr>
                        <td style=\"margin: 0; padding: 0;\" scope=\"row\"><button type=\"button\" class=\"btn-block\">Cancelar</button></td>
                        <td style=\"margin: 0; padding: 0;\"><button name=\"save\" value=\"" . $id . "\" type=\"submit\" class=\"btn-block\">Salvar</button></td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
    ";
    
    echo $html;
?>
