<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Internship Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Collage Internship</h1>
    <h2>Intern Registration</h2>
    <?php
        //Track errors
        $errors = 0;
        $email = "";
        if (empty($_POST['email'])) {
            ++$errors;
            echo "<p>You need to enter an e-mail address.</p>\n";
        } else {
            $email = stripslashes($_POST['email']);
            $email = trim($_POST['email']);
            if (preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[w-]+)*(\.[A-Za-z]{2,})$/i", $email) == 0) {
                +$errors;
                echo "<p>You need to enter a valid email address</p>";
                $email = "";
            }
        }
        
        if (empty($_POST['password'])) {
            ++$errors;
            echo "<p>You need to enter a password.</p>\n";
        } else {
            $password = stripslashes($_POST['password']);
            $password = trim($_POST['password']);
        }
        if (empty($_POST['password2'])) {
            ++$errors;
            echo "<p>You need to enter a confirmation password.</p>\n";
        } else {
            $password2 = stripslashes($_POST['password2']);
            $password2 = trim($_POST['password2']);
        }

        if (!empty($password) && !empty($password2)) {
            if (strlen($password) < 6) {
                ++$errors;
                echo "<p>The password is too short.</p>";
                $password = "";
                $password2 = "";
            }

            if ($password <> $password2) {
                ++$errors;
                echo "<p>The password don't match.</p>";
                $password = "";
                $password2 = "";
            }
        }
        if ($errors > 0) {
            echo "Please use your browser's back button to return to the form and fix errors indicated.";
        }
    ?>
</body>
</html>