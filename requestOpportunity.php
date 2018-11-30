<?php
    session_start();
    $body = "";
    $errors = 0;
    // $internID = 0;
    // if (isset($_GET['internID'])) {
    //     $internID = $_GET['internID'];
    // } else{
    //     ++$errors;
    //     $body .= "<p> You have not logged in or registered" . " Please return to the " . "<a href=internLogin.php>Registration / Login Page</a></p>";
    // }
    if (!isset($_SESSION['internID'])) {
        $body .= "<p> You have not logged in or registered" . " Please return to the " . "<a href=internLogin.php?" . "PHPSESSID=" . session_id() .">Registration / Login Page</a></p>";
    } 

    if ($errors == 0) {
        if (isset($_GET['opportunityID'])) {
            $opportunityID = $_GET['opportunityID'];
        } else{
            ++$errors;
            $body .= "<p> You have not selected and opportunity" . " Please return to the " . "<a href=opportunities.php?" . "PHPSESSID=" . session_id() .">Available opportunities</a></p>";
        }
    }
    $hostname = "localhost";
    $username = "adminer";
    $passwd = "seven-which-26";
    $DBConnect = false;
    $DBName = "internships1";
    if ($errors == 0) {
        $DBConnect = mysqli_connect($hostname, $username, $passwd);
        if (!$DBConnect) {
            ++$errors;
            $body .= "<p>Unable to connect to database server, error code: " . mysqli_connect_error() . "</p>\n";
            }
        else {
            $result = mysqli_select_db($DBConnect, $DBName);
        }
    }
    $displayDate = date("l, F j, Y, g:i A");
    $body .= "$displayDate<br>";
    echo "<br>";
    $dbDate = date("Y-m-d H:i:s");
    $body .= "$dbDate<br>";
    if ($errors == 0) {
        $tableName = "assigned_opportunities";
        $SQLString = "INSERT INTO $tableName " . "(opportunityID, internID, dateSelected)" . "VALUES($opportunityID, " . $_SESSION['internID'] . ", '$dbDate')";
        $queryResults = mysqli_query($DBConnect, $SQLString);
        if (!$queryResults) {
            ++$errors;
            // $body .= "<p>Oi, GEY BOI U FKED UP. Error code: 69 : <strong>Too gey</strong></p>";
            $body .= "<p>Unable to execute the query, Error Code: " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>\n";
        } else {
            $body .= "<p>Your results for opportunity # $opportunityID have been entered on $displayDate.</p>\n";
        }
        
    }
    if ($DBConnect) {
        $body .= "closing database \"$DBName\" connection.</p>\n";
        mysqli_close($DBConnect);
    }
    if ($_SESSION['internID'] > 0) {
        $body .= "<p>Return to the <a href='opportunities.php?PHPSESSID= " . session_id(). "'>Availible Opportunities</a> page.</p>";
    } else {
        $body .= "<p>Please <a href'internLogin.php'>register or login</a> to use this page</p>";
    }
    if ($errors == 0) {
        echo "Setting cookies\n";
        setcookie("LastRequestDate", urlencode($displayDate), time()+60*60*24*7);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Request Opportunity</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>Collage Internships</h1>
    <h2>Opportunity Requested</h2>
    <?php
        echo "$body";
    ?>
</body>
</html>