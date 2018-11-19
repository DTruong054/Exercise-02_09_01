<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Verify Intern Logins</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h1>Collage Internships</h1>
    <h2>Verify Intern Login</h2>
    <?php
        $errors = 0;
        $hostName = "localhost";
        $username = "adminer";
        $passwd = "seven-which-26";
        $DBConnect = false;
        $DBName = "internships1";
        if ($errors == 0) {
            $DBConnect = mysqli_connect($hostName, $username, $passwd);
            if (!$DBConnect) {
                ++$errors;
                echo "<p>Unable to connect to the databse server error code: " . mysqli_connect_error() . "</p>\n";
            } else {
                $result = mysqli_select_db($DBConnect, $DBName);
                if (!$result) {
                    ++$errors;
                    echo "<p>Unable to select the database <strong>$DBName</strong> error code: " . mysqli_error($DBConnect) . "</p>\n";
                }
            }
        }
        $tableName = "intern";
        if ($errors == 0) {
            // $SQLString = "SELECT internID, first, last FROM $tableName WHERE email='" . stripslashes($_POST['email']) . "'AND password_md5='" . md5(stripslashes($_POST['password'])) . "'";
            $SQLString = "SELECT internID, first, last" . 
                        " FROM  $tableName" . 
                        " WHERE email='" . stripslashes($_POST['email']) . 
                        "' AND password_md5='" . 
                        md5(stripslashes($_POST['password'])) . "'";
            $queryResult = mysqli_query($DBConnect, $SQLString);
            if (mysqli_num_rows($queryResult) == 0) {
                ++$errors;
                echo "<p>The email/password combination entered was invalid</p>";
            } else {
                $row = mysqli_fetch_assoc($queryResult);
                $internID = $row['internID'];
                $internName = $row['first'] . " " . $row['last'];
                mysqli_free_result($queryResult);
                echo "<p>Welcome back, $internName!</p>\n";
            }
        }
        if ($DBConnect) {
            echo "<p>Closing database <strong>$DBName</strong> connection</p>\n";
            mysqli_close($DBConnect);
            echo "<form action='opportunities.php' method='post'>";
            echo "<input type='hidden' name'internID' value='$internID'>\n";
            echo "<input type='submit' name='submit' value='View Opportunities'>";
            echo "</form>";
            
        }
        if ($errors > 0) {
            echo "Please use your browser's back button to return to the form and fix errors indicated.";
        }
    ?>
</body>
</html>