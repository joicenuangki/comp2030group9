<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "Login.php"; ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Joice & Nathan" />
    <link rel="stylesheet" href="../Styles/Style.css">
    <title>Login</title>
</head>
<body id="login-body">
    <header>
        <h1>Welcome to the Smart Manufactoring Dashboard</h1>
    </header>
    <main>
        <h2>Sign In to Start</h2>
        <?php echo(isset($_POST['employeeID']) && isset($_POST['password']) ? "<p id='login-error-p'>Your Employee Id or Password is <b>Incorect</b><br>Please Try Again or Contact an Administrator</p>" : ""); ?>
        <form method="post">
        <ul>
            <li><label for='employeeID-field'>EmployeeID: </label> <input type="text" name="employeeID" id="employeeID-field" placeholder="Type Employee ID Here" required autocomplete="off"></li>
            <br>
            <li><label for="password-field">Password: </label> <input type="password" name="password" id="password-field" placeholder="Type Password Here" required autocomplete="off"></li>
        </ul>
        <input type="submit" value="Sign In">
        </form>
        
    </main>
    <footer>
    </footer>    
</body>
</html>