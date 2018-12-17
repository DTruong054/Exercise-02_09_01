<?php
//Starting session
    session_start();
    if (isset($_POST['submit'])) {
        //Once submit...
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['contact'] = $_POST['contact'];
        $name = $_SESSION['name'];
        $contact = $_SESSION['contact'];
    }
?>
<?php
    // session_unset();
    // session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
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
<?php
    if (isset($_POST['submit'])) {
        $cookie_name = "TheGreaterDepression";
        // $cookie_value1 = $_POST['name'] . "<br>\n";
        // $cookie_value2 = $_POST['contact'] . "<br>\n";
        // echo "$cookie_value1";
        // echo "$cookie_value2";
        // setcookie($cookie_name, $cookie_value1, time() + (86400 * 30), "/"); // 86400 = 1 day
        // setcookie($cookie_name, $cookie_value2, time() + (86400 * 30), "/"); // 86400 = 1 day
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        setcookie('name',$name,time() + (86400 * 7)); // 86400 = 1 day
        setcookie('contact',$contact,time() + (86400 * 7)); // 86400 = 1 day
        echo $_COOKIE['name'];
        echo $_COOKIE['contact'];
    }
?>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>First Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="middle">
    <form action="formTwo.php" method="post">
        <p><input type="text" name="name" placeholder="Name" class="placeholder" value="<?php if (isset($_SESSION['name'])) {echo "$name";}?>"></p>
        <p><input type="text" name="contact" placeholder="Contact" class="placeholder"></p>
        <input type="submit" value="&#8594;" name="submit" id="submit">
    </form>
    </div>
</html>
<?php
    
?>