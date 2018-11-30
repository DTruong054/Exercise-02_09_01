<?php 
        session_start();
        $body = "";
        $errors = 0; 
        $email = "";
        $hostname = "localhost";
        $username = "adminer";
        $passwd = "seven-which-26";
        $DBConnect = false;
        $DBName = "internships1";
        if (empty($_POST['email'])) {
            ++$errors;
            $body .= "<p>You need to enter an e-mail address</p>\n";
        }
        else {
            $email = stripslashes($_POST['email']);
            if (preg_match("/^[\w-]+(\.[\w-]+)*@[\w-]+(\.[w-]+)*(\.[A-Za-z]{2,})$/i", $email) == 0) {
                ++$errors;
                $body .= "<p>You need to enter a valid e-mail address</p>\n";
                $email = "";
            }
        }
        if (empty($_POST['password'])) {
            ++$errors;
            $body .= "<p>You need to enter a password</p>\n";
        }
        else {
                $password = stripslashes($_POST['password']);
        }
       if (empty($_POST['password2'])) {
            ++$errors;
            $body .= "<p>You need to enter a confirmation password</p>\n";
        }
        else {
                $password2 = stripslashes($_POST['password2']);
        }
        if (!empty($password) && !empty($password2)) {
            if (strlen($password) < 6) {
                ++$errors;
                $body .= "<p>The password is too short.</p>\n";
                $password = "";
                $password2 = "";
            }
            if ($password <> $password2) {
                ++$errors;
                $body .= "<p>The passwords do not match.</p>\n";
                $password = "";
                $password2 = "";
            }
        }
        if ($errors == 0) {
            $DBConnect = mysqli_connect($hostname, $username, $passwd);
            if (!$DBConnect) {
                ++$errors;
                $body .= "<p>Unable to connect to database server, error code: " . mysqli_connect_error() . "</p>\n";
            }
            else {
                $result = mysqli_select_db($DBConnect, $DBName);
                if (!$result) {
                    ++$errors;
                    $body .= "<p>Unable to select the database \"$DBName\", error code: " . mysqli_error($DBConnect) . "</p>\n";
                }
            }
            $TableName = "interns";
            if ($errors == 0) {
                $SQLstring = "SELECT count(*) FROM $TableName" . " WHERE email='$email'";
                $queryResult = mysqli_query($DBConnect, $SQLstring);
                if ($queryResult) {
                    $row = mysqli_fetch_row($queryResult);
                    if ($row[0] > 0) {
                        ++$errors;
                        $body .= "<p>The email address entered (" . htmlentities($email) . ") is already registered.</p>\n";
                    }
                }
            }
            if ($errors == 0) {
                $first = stripslashes($_POST['first']);
                $last = stripslashes($_POST['last']);
                $SQLstring = "INSERT INTO $TableName" . 
                    " (first, last, email, password_md5)" . 
                    " VALUES('$first', '$last', '$email', " . 
                    "'" . md5($password). "')";
                $queryResult = mysqli_query($DBConnect, $SQLstring);
                if (!$queryResult) {
                    ++$errors;
                    $body .= "<p>Unable to save your registration information, error code: " . mysqli_error($DBConnect) . "</p>\n";
                }
                else {
                    // $internID = mysqli_insert_id($DBConnect);
                    $_SESSION['internID'] = mysqli_insert_id();
                }   
            }
        }
        if ($errors == 0) {
            $internName = $first . " " . $last;
            $body .= "<p>Thank you $internName. ";
            $body .= "Your new intern ID is <strong>$_SESSION[internID]</strong>.</p>\n";
        }
        if ($DBConnect) {
            setcookie("internID", "$internID");
            $body .= "closing database \"$DBName\" connection.</p>\n";
            $body .= "<p><a href='opportunities.php?'PHPSESSID=" .  session_id() . ">View Available Opportunities</a></p>";
            mysqli_close($DBConnect);
            // $body .= "<form action='opportunities.php' method='POST'>\n";
            // $body .= "<input type='hidden' name='internID' value='$internID'>\n";
            // $body .= "<input type='submit' name='submit' value='View Available Opportunities'>\n";
            // $body .= "</form>";
        }
        if ($errors > 0) {
            $body .= "<p>Please use your browsers BACK button to return to the form and fix the errors indicated</p>";
        }
    ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Internship Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <h1>College Intership</h1>
    <h2>Intern Registration</h2>
    <?php
        echo "$body";
    ?>
</body>

</html>