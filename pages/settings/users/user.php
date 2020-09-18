<link rel="stylesheet" href="users/user.css">

<?php
    // Get user id and index to use in sql query
    $index = $_POST['index'];
    $id = $_POST['id'];
    // Get all users list and filter with id
    $url = "http://localhost/2THPlatform/api/v1/user/get/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'];
    $reports = json_decode(file_get_contents($url), true);
    $user = $reports['data'][$index];
    $html = "
    <div class=\"container\">
        <table>
            <thead>
                <tr>
                    <td colspan=\"2\">User</td>
                </tr>
            </thead>
            <tbody>
                <form method=\"post\">
                    <input type=\"hidden\" name=\"id\" value=\"" .  $id . "\"/>
                    <input type=\"hidden\" name=\"index\" value=\"" .  $index . "\"/>
                    <tr>
                        <td>ID</td>
                        <td>" . $id . "</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>" . $user['user'] . "</td>
                    </tr>
                    <tr>
                        <td>Theme</td>
                        <td>" . $user['theme'] . "</td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td>" . $user['type'] . "</td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><div><input class=\"input-text\" type=\"text\" name=\"password\" placeholder=\"New password\"></div></td>
                    </tr>
                    <tr>
                        <td><input class=\"button\" name=\"cancel\" value=\"Cancel\" type=\"submit\"/></td>
                        <td><input class=\"button\" name=\"update\" value=\"Save\" type=\"submit\"/></td> 
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
    ";
    echo $html;
?>
