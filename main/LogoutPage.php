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
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700;900&display=swap" rel="stylesheet">
    <title>Logout</title>
</head>
<body>
    <header>
        <h1>You Have Been Signed Out!</h1>
        <h2>We hope you had a pleasant experience using the Smart Manufactoring Dashboard.<h2>
        <p></p>
        <a href="../main/LoginPage.php"><button>Return to Login</button></a>
    </header>
    <main>   
    </main>
</body>
<style>
        h1 {
        font-family: 'Source Sans Pro' !important;
        font-size:60px !important;
        }

        h2 {
            color: black; 
            font-family: 'Source Sans Pro';
            font-size:20px !important;
            font-weight: lighter; 
            width: 600px;
        }

        body {
            background-image: url(Screenshot\ 2024-10-20\ 183808.png);
            background-size: 125%; 
            background-position: center; 
            background-repeat: no-repeat;
            
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

        header {
            display: flex; /* Enable Flexbox */
            flex-direction: column; /* Arrange items in a column */
            justify-content: center; /* Center items vertically */
            align-items: center; /* Center items horizontally */
            padding: 700px; /* Adjust padding as needed */
            width: 1000px; /* Box size fits the content of the text */
            height: 400px;
            margin: 0 auto; /* Center the box horizontally */
            border: 2px solid white; /* Optional: Adds a border around the box */
            background-color: white; /* Change this to your desired color */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            border-radius: 15px;
        }

        button {
            font-family: 'Source Sans Pro' !important; /* Font for the button */
            background-color: black; /* Button background color */
            font-size: 16px; /* Font size */
            color: white; /* Text color */
            width: 210px;
            height: 70px;
            border-radius: 10px; 
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
            }

        button:hover {
            background-color: #444; /* Change this to your desired hover color */  
        } 

        p {
            font-family: 'Source Sans Pro' !important; 

        }
    </style>
</html>
