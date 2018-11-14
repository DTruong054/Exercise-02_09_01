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
        $hostName = "10.106.15.140";
        $userName = "adminer";
        $password = "seven-which-26";
        $DBConnect = false;
        $DBName = "internships1";
        if (empty($_POST['email'])) {
            ++$errors;
            echo "<p>You need to enter an e-mail address.</p>\n";
        } else {
            $email = stripslashes($_POST['email']);
            $email = trim($_POST['email']);
            if (preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[w-]+)*(\.[A-Za-z]{2,})$/i", $email) == 0) {
                //Test if real email.
                +$errors;
                echo "<p>You need to enter a valid email address</p>";
                $email = "";
            }
        }
        
        if (empty($_POST['password'])) {
            //if user has no password
            ++$errors;
            echo "<p>You need to enter a password.</p>\n";
        } else {
            //Get rid of slashes and make sure no extra spaces
            $password = stripslashes($_POST['password']);
            $password = trim($_POST['password']);
        }
        if (empty($_POST['password2'])) {
            //Need to fillout confirmation password
            ++$errors;
            echo "<p>You need to enter a confirmation password.</p>\n";
        } else {
            //Make sure that passwords2 has no slashes or no spaces.
            $password2 = stripslashes($_POST['password2']);
            $password2 = trim($_POST['password2']);
        }

        if (!empty($password) && !empty($password2)) {
            if (strlen($password) < 6) {
                //Can't have less then 6 characters
                ++$errors;
                echo "<p>The password is too short.</p>";
                $password = "";
                $password2 = "";
            }

            if ($password <> $password2) {
                //Passwords need to match or else this...
                ++$errors;
                echo "<p>The password don't match.</p>";
                $password = "";
                $password2 = "";
            }
        }

        if ($errors == 0) {
            //Connect if no errors
            $DBConnect = mysqli_connect($DBConnect, $userName, $password);
            if (!$DBConnect) {
                ++$errors;
                echo "<p>Unable to connect to database server error code: " . mysqli_connect_error() . "</p>\n";
            } else {
                //Select the database
                $result = mysqli_select_db($DBConnect, $DBName);
                if (!$result) {
                    ++$errors;
                    echo "<p>Unable to select the database <strong>$DBName</strong> error code: " . mysqli_error() . "</p>\n";
                }
            }

            $tableName = "interns";
            if ($errors == 0) {
                $first = stripslashes($_POST['first']);
                $last = stripslashes($_POST['last']);
                $SQLString = "INSERT INTO $tableName" . "(first, last, email, password_md5)" . "VALUES('$first', '$last', '$email' '" .  md5($password) . "')";
                $queryResult = mysqli_query($DBConnect, $SQLString);
                if (!$queryResult) {
                    echo "<p>Unable to save your registration information error code: " . mysqli_error() . "</p>\n";
                }
            }

            if ($errors == 0) {
                echo "<p>Closing database connection <strong>$DBName</strong> connection.</p>\n";
                mysqli_close($DBConnect);
            } else{
                $internID = mysqli_insert_id($DBConnect);
            }
        }

        if ($errors > 0) {
            //If any errors
            echo "Please use your browser's back button to return to the form and fix errors indicated.";
        }
    ?>
</body>
</html>