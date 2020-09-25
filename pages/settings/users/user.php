<link rel="stylesheet" href="users/user.css">

<?php
    // Get user id to use in sql query
    $id = $_POST['id'];
    // Get all users list and filter with id
    $url = "http://localhost/api/v1/user/get/?company=" . $_COOKIE['company'] . "&password=" . $_COOKIE['password'] . "&user=" . $_COOKIE['user'] . "&id=" . $id;
    $reports = json_decode(file_get_contents($url), true);
    $user = $reports['data'][0];
    $html = "
    <div class=\"user\">
        <table>
            <thead>
                <tr>
                    <td colspan=\"2\">User</td>
                </tr>
            </thead>
            <tbody>
                <form method=\"post\">
                    <input type=\"hidden\" name=\"id\" value=\"" .  $id . "\"/>
                    <input type=\"hidden\" name=\"user\" value=\"" .  $user['user'] . "\"/>
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
                        <td><input class=\"alert button\" name=\"cancel\" value=\"Cancel\" type=\"submit\"/></td>
                        <td><input class=\"button\" name=\"update\" value=\"Save\" type=\"submit\"/></td> 
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
    ";
    echo $html;
?>
