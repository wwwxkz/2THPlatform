<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

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