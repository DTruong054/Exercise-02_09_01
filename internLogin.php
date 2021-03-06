<?php
    session_start();
    $_SESSION = array();
    session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Intern Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h1>College Internships</h1>
    <h2>Register / login</h2>
    <p>New interns, please complete the top form to register as a user. Returning users please complete the second form to login</p>

    <h3>New Intern Registration</h3>
    <form action="registerIntern.php?PHPSESSID=<?php echo session_id(); ?>" method="post">
        <!-- Register new users -->
        <p>Enter your name: First<input type="text" name="first">Last:<input type="text" name="last"></p>
        <p>Enter your email address:<input type="text" name="email"></p>
        <p>Enter a password for your account:<input type="password" name="password"></p>
        <p>Confirm your password<input type="password" name="password2"></p>
        <p><em>(Passwords are case-sensitive and must be at least 6 charaters long.)</em></p>
        <input type="reset" name="reset" value="Reset Registration Form">
        <input  type="submit" name="register" value="Register">
    </form>

    <h3>Returning Intern Logins</h3>
    <form action="verifyLogin.php?PHPSESSID=<?php echo session_id(); ?>" method="post">
        <!-- Returning users -->
        <p>Enter your email address:<input type="text" name="email"></p>
        <p>Enter your password for your account:<input type="password" name="password"></p>
        <p><em>(Passwords are case-sensitive and must be at least 6 charaters long.)</em></p>
        <input type="reset" name="reset" value="Reset Login">
        <input type="submit" name="register" value="Login">
    </form>
</body>
</html>