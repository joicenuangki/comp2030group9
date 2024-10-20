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
        <?php echo(isset($_POST['employeeID']) && isset($_POST['password']) ? "<p id='login-error-p'>Your Employee ID or Password is <b>Incorrect</b><br>Please Try Again or Contact an Administrator.</p>" : ""); ?>
        <form method="post">
        <ul>
            <li><label for='employeeID-field'>EmployeeID: </label> 
            <input type="text" name="employeeID" id="employeeID-field" placeholder="Type Employee ID Here" required autocomplete="off"></li>
            <br>
            <li><label for="password-field">Password: </label> 
            <input type="password" name="password" id="password-field" placeholder="Type Password Here" required autocomplete="off"></li>
            <p><p\>
            <input type="submit" value="Sign In" id ="sign-in">
        </ul>

        </form>
        <style>

    h1{
    font-family: 'Times New Roman', Times, serif; 
    font-size: 70px !important;
    text-align: center !important;
    }

        li {
        margin-bottom: 1px; 
        }

        label {
        font-size: 20px;
        display: block; 
        margin-bottom: 5px; 
        }

        ::placeholder {
        font-family: 'Source Sans Pro';   
        font-size: 18px;
        }

        #login-error-p {
                font-family: 'Source Sans Pro', sans-serif; 
                color: red; 
                margin-top: 10px; 
                font-size: 19px; 
            }

        #sign-in {
                font-family: 'Source Sans Pro'; 
                background-color: black; 
                font-size: 16px; 
                color: white; 
                width: 210px;
                border-radius: 10px; 
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                transition: background-color 0.3s ease;
            }

        #sign-in:hover {
            background-color: #444;
        } 

        input { 
        font-family: 'Source Sans Pro';  
        font-size: 16px; 
        padding: 19px; 
        border: none; 
        border-radius: 2px; 
        text-align: center;
        outline: none;
        }

        #login-body {
            font-family: 'Source Sans Pro';
        }

        #employeeID-field {
            font-family: 'Source Sans Pro';  
        }
    </style>   
    </main>
    <footer>
    </footer>    
</body>
</html>