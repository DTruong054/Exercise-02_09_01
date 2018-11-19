<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Avalible Opportunities</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Collage Internships</h1>
    <h2>Avalible Opportunities</h2>
    <?php
        if (isset($_REQUEST['internID'])) {
            $internID = $_REQUEST['internID'];
        } else {
            $internID = -1;
        }
        //Debug
        echo "\$internID: $internID\n";

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

        $tableName = "interns";
        if ($errors == 0) {

            $SQLString = "SELECT * FROM $tableName WHERE internID='$internID'";
            $queryResult = mysqli_query($DBConnect, $SQLString);
            if (!$queryResult) {
                ++$errors;
                echo "<p>Unable to execute. Error code: " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>\n";
            } else {
                if (mysqli_num_rows($queryResult) == 0) {
                    ++$errors;
                    // echo "<p>Invalid internID</p>\n";
                }
            }
        }
        if ($errors == 0) {
            $row = mysqli_fetch_assoc($queryResult);
            $internName = $row['first'] . " " . $row['last'];
        } else {
            $internName = "";
        }
        //DEBUG
        echo "internName $internName";

        if ($DBConnect) {
            echo "<p>Closing database <strong>$DBName</strong> connection</p>\n";
            mysqli_close($DBConnect);
        }
    ?>
</body>
</html>