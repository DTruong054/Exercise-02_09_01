<?php
    if (isset($_POST['submit'])) {
        $_SESSION['session'] = TRUE;
        $cookie_name = "TheGreaterDepression";
        $cookie_value1 = $_POST['name'] . "<br>\n";
        $cookie_value2 = $_POST['contact'] . "<br>\n";
        $cookie_value3 = $_REQUEST['company'] . "<br>\n";
        echo "Name: $cookie_value1";
        echo "Contact: $cookie_value2";
        echo "Company Info: $cookie_value3";
        setcookie($cookie_name, $cookie_value1, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie($cookie_name, $cookie_value2, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie($cookie_name, $cookie_value3, time() + (86400 * 30), "/"); // 86400 = 1 day
        if(!isset($_COOKIE[$cookie_name])) {
            echo "Cookie named '" . $cookie_name . "' is not set!";
        } else {
            echo "Cookie '" . $cookie_name . "' is set!<br>";
            echo "Value is: " . $_COOKIE[$cookie_name];
        }
    }
?>
<!DOCTYPE html>
<html>
<style>
    html {
        box-sizing: border-box;
        height: 100%;
    }

    body {
        margin: 0;
        width: 100%;
        height: 100%;
        background-image: linear-gradient(#ff9966, #ff5e62);
        background-position: center;
        background-size: cover;
    }

    .middle{
        margin: 0 auto;
        text-align: center;
        background-image: linear-gradient(#808080 ,#696969, #808080	);
        width: 50%;
        height: 50%;
    }
    .placeholder{
        margin-top: 5%;
        width: 80%;
        height: 5em;
    }

    #submit{
        width: 20em;
        height: 50em;
    }
}
</style>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Second Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="middle">
    <form action="formThree.php" method="post">
        <p><input type="text" name="company" placeholder="User's company information" class="placeholder"></p>
        <input type="submit" value="&#8594;" name="submit" id="submit">
    </form>
    </div>
</body>
</html>