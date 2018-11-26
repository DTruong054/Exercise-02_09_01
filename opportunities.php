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
                    echo "<p>Invalid internID</p>\n";
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
        $tableName = "assigned_opportunities";
        if ($errors == 0){
            $SQLString = "SELECT COUNT(opportunitiesID) FROM $tableName HERE internID='$internID'" . 
                        " AND dateApproved IS NOT NULL";
            $queryResult = mysqli_query($DBConnect, $SQLString);
            if (mysqli_num_rows($result) > 0) {
                echo "<br>No syntax error\n";
                $row  = mysqli_fetch_row($result);
                $approvedOps = $row[0];
                mysqli_free_result($queryResult);
            }
            $selectedOps = array();
            $SQLString = "SELECT opportunityID FROM $tableName WHERE internID='$internID'";
            $queryResult = mysqli_query($DBConnect, $SQLString);
            if (mysqli_num_rows($result) > 0) {
                while (($row = mysqli_fetch_row($queryResult)) != false) {
                    $selectedOps[] = $row[0];
                }
                mysqli_free_result($queryResult);
            }
        }
        $assignedOps = array();
        $SQLString = "SELECT COUNT(opportunitiesID) FROM $tableName HERE internID='$internID'" . 
                    " AND dateApproved IS NOT NULL";
                    $queryResult = mysqli_query($DBConnect, $SQLString);
        if (mysqli_num_rows($result) > 0) {
            while (($row = mysqli_fetch_row($queryResult)) != false) {
                $assignedOps[] = $row[0];
                    }
                mysqli_free_result($queryResult);
            }
        $tableName = "opportunities";
        $opportunities = array();
        $SQLString = "SELECT oportunityID, company, city, startDate, endDate, position, description FROM $tableName";
        //debug
        echo "<br>" . mysqli_num_rows($queryResult) . "<br>\n";

        if (mysqli_num_rows($result) > 0) {
            while (($row = mysqli_fetch_assoc($queryResult)) != false) {
                $opportunities[] = $row[0];
            }
            mysqli_free_result($queryResult);
        }
        //debug 
        echo "<pre>";
        print_r($opportunities);
        echo "</pre>";
        echo "<table border='1' width='100%'>\n";
        echo "</table>";
        echo "<p><a href='internLogin.php'>Log Out</a></p>"
    ?>
</body>
</html>