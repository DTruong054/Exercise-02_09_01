<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Final Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php
    //Setting sessions
        $_SESSION['seminars'] = $_POST['seminars'];
        $name = $_SESSION['name'];
        $contact = $_SESSION['contact'];
        $company = $_SESSION['company'];
        $seminars = $_SESSION['seminars'];
        //Display all info
        echo "Name: $name<br>";
        echo "Contact: $contact<br>";
        echo "Company Info: $company<br>";
        echo "Seminars: $seminars";
        echo "<p><a href='formOne.php'>Change Name/Contact</a></p>";
        echo "<p><a href='formTwo.php'>Change CompanyInfo</a></p>";
        echo "<p><a href='formThree.php'>Change Seminars</a></p>";
    ?>
</body>
</html>