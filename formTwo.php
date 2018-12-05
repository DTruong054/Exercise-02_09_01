<?php
    if (isset($_POST['submit'])) {
        $cookie_name = "TheGreaterDepression";
        $cookie_value1 = $_POST['name'] . "<br>\n";
        $cookie_value2 = $_POST['contact'] . "<br>\n";
        echo "$cookie_value1";
        echo "$cookie_value2";
        setcookie($cookie_name, $cookie_value1, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie($cookie_name, $cookie_value2, time() + (86400 * 30), "/"); // 86400 = 1 day
        if ( !session_id() ) {
            session_start();
        }
        $_SESSION['contact'] = $_POST['contact'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Second Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <form action="formThree" method="post">
        <p>User's company informtion <input type="text" name="company"></p>
    </form>
</body>
</html>