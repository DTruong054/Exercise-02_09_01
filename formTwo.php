<?php
    session_start();
    // if (isset($_POST['submit'])) {
    //     $_SESSION['session'] = TRUE;
    //     $cookie_name = "TheGreaterDepression";
    //     $cookie_value1 = $_POST['name'] . "<br>\n";
    //     $cookie_value2 = $_POST['contact'] . "<br>\n";
    //     $cookie_value3 = $_POST['company'] . "<br>\n";
    //     $_SESSION['name'] = $_POST['name'];
    //     $_SESSION['contact'] = $_POST['contact'];
    //     $_SESSION['company'] = $_POST['company'];
    //     echo "Name: $_SESSION['name']";
    //     echo "Contact: $_SESSION['contact']";
    //     echo "Company Info: $_SESSION['company']";
    //     setcookie($cookie_name, $cookie_value1, time() + (86400 * 30), "/"); // 86400 = 1 day
    //     setcookie($cookie_name, $cookie_value2, time() + (86400 * 30), "/"); // 86400 = 1 day
    //     setcookie($cookie_name, $cookie_value3, time() + (86400 * 30), "/"); // 86400 = 1 day
    // }
    if (isset($_POST['submit'])) {
        //On submit...
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['contact'] = $_POST['contact'];
        //Variables
        $name = $_SESSION['name'];
        $contact = $_SESSION['contact'];
        //Debug code
        echo "Name: $name<br>";
        echo "Contact: $contact<br>";
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