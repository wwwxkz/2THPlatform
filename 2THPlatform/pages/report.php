<?php
    include_once 'scripts/conn.php';

    $id = explode("_", $_POST["test"]);
    $id = $id[1]+1;

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
    <table class=\"table table-bordered table-sm\">
    <thead class=\"thead-dark\">
        <tr>
        <th scope=\"col\">Atual</th>
        <th scope=\"col\">Novo</th>
        </tr>
    </thead>
    <tbody>
        <form method=\"post\" action=\"http://localhost/2THPlatform/api/v1/report/update/?id=$id\">
            <tr>
                <th scope=\"row\">Name</th>
                <td><div class=\"input-group input-group-sm\"><input type=\"text\" name=\"name\" value=\"" . $reports[0]['name'] . "\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\"></div></td>
            </tr>
            <tr>
                <th scope=\"row\">Tag</th>
                <td><div class=\"input-group input-group-sm\"><input type=\"text\" name=\"tag\" value=\"" . $reports[0]['tag'] ."\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\"></div></td>
            </tr>
            <tr>
                <th scope=\"row\">Groups</th>
                <td><div class=\"input-group input-group-sm\"><input type=\"text\" name=\"groups\" value=\"" . $reports[0]['groups'] . "\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\"></div></td>
            </tr>
            <tr>
                <th scope=\"row\"><button type=\"button\" class=\"btn btn-secondary btn-lg btn-block\">Cancelar</button></th>
                <td><button type=\"submit\" class=\"btn btn-primary btn-lg btn-block\">Salvar</button></td>
            </tr>
        </form>
    </tbody>
    </table>
    ";
    echo $html;
?>
