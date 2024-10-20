<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "Login.php"; ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Joice & Nathan" />
    <link rel="stylesheet" href="../Styles/Style.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@900&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
<body id="login-body">
    <header>
        <h1>Welcome to the Smart Manufactoring Dashboard</h1>
    </header>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
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

        li {
        margin-bottom: 1px; /* Space between each list item */
        }

        label {
        font-size: 20px;
        display: block; /* Ensures the label takes up the full width */
        margin-bottom: 5px; /* Space between the label and input */
        }

        ::placeholder {
        font-family: 'Source Sans Pro';   
        font-size: 18px;
        }

        #login-error-p {
                font-family: 'Source Sans Pro', sans-serif; /* Set the desired font */
                color: red; /* Optional: Change text color to red for visibility */
                margin-top: 10px; /* Optional: Add some spacing above the message */
                font-size: 19px; /* Font size */
            }

        #sign-in {
                font-family: 'Source Sans Pro'; /* Font for the button */
                background-color: black; /* Button background color */
                font-size: 16px; /* Font size */
                color: white; /* Text color */
                width: 210px;
                border-radius: 10px; 
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                transition: background-color 0.3s ease;
            }

        #sign-in:hover {
            background-color: #444; /* Change this to your desired hover color */  
        } 

        input { 
        font-family: 'Source Sans Pro';  
        font-size: 16px; /* Font size */ 
        padding: 19px; /* Add some padding for better appearance */
        border: none; /* Basic border */
        border-radius: 2px;  /* Rounded corners */
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