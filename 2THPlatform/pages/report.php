<?php
    //Ler url e pegar mac

    //if (isset($_REQUEST)) {
    //    echo $_REQUEST;
    //}
    //$url = explode('/', $request['url']);

    $con = new PDO('mysql: host=locahost; dbname=company;','root','');

    //$sql = "SELECT * FROM `reports` WHERE `mac`='" . $data[0] . "'";
    $sql = "SELECT * FROM `reports` WHERE `mac`='0088144D4CFB'";

    $sql = $con->prepare($sql);
    $sql->execute();

    $results = array();

    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        $results[] = $row;
    }

    if (!$results) {
        throw new Exception("None report in reports");
    }

    $html = "
<div class=\"container\">
    <p class=\"text-left\">Editando Report: 55:44:33:22:11</p>

    <table class=\"table table-striped table-dark\">
    <thead>
        <tr>
        <th scope=\"col\">Atual</th>
        <th scope=\"col\">Novo</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope=\"row\">" . $results[0]['name'] . "</th>
            <td><div class=\"input-group input-group-sm\"><input type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\"></div></td>
        </tr>
        <tr>
            <th scope=\"row\">" . $results[0]['tag'] . "</th>
            <td><div class=\"input-group input-group-sm\"><input type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\"></div></td>
        </tr>
        <tr>
            <th scope=\"row\">" . $results[0]['groups'] . "</th>
            <td><div class=\"input-group input-group-sm\"><input type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\"></div></td>
        </tr>
        <tr>
            <th scope=\"row\"><button type=\"button\" class=\"btn btn-secondary btn-lg btn-block\">Cancelar</button></th>
            <td><button type=\"button\" class=\"btn btn-primary btn-lg btn-block\">Salvar</button></td>
        </tr>
    </tbody>
    </table>
</div>
    ";

    echo $html;
?>