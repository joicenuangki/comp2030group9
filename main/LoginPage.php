<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Joice" />
    <link rel="stylesheet" href="../Styles/Style.css">
    <title>Login</title>
    <style>
        body {
            align-items: center;
            text-align: center;
            margin-top: 10%;

            ul {
                padding: 0px;
            }

            li {
                list-style: none;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Smart Manufactoring Dashboard</h1>
    </header>
    <main>
        <h2>Sign In to Start</h2>
        <form action="../main/Login.php" method="post">
        <ul>
            <li><label for='employeeID-field'>EmployeeID: </label> <input type="text" name="employeeID" id="employeeID-field" placeholder="Type Employee ID Here" required></li>
            <br>
            <li><label for="password-field">Password: </label> <input type="password" name="password" id="password-field" placeholder="Type Password Here" required></li>
        </ul>
        <input type="submit" value="Sign In">
        </form>
        
    </main>
    <footer>
    </footer>    
</body>
</html>