<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        session_start();
        if(isset($_SESSION['employeeID']) && isset($_SESSION['role'])) {
            header("Location: ../main");
            exit;
        } 
    ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Joice & Nathan" />
    <link rel="stylesheet" href="../Styles/Style.css">
    <title>Logout</title>
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
        <h1>You Have Been Signed Out!</h1>
        <p>We hope you had a pleasant experience using the Smart Manufactoring Dashboard</p>
    </header>
    <main>
        <a href="../main/LoginPage.php"><button>Return to Login</button></a>
    </main>
</body>
</html>