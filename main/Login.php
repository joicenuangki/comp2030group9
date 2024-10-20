<meta name="author" content="Nathan & Joice" >
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@900&display=swap" rel="stylesheet">

<style>
        h1 {
            color: black; 
            font-family: 'Source Sans Pro';
            font-size:60px !important;
        }

        h2 {
            color: black; 
            font-family: 'Source Sans Pro';
            font-size:30px !important;
        }

        body {
            background-image: url(Screenshot\ 2024-10-20\ 183808.png);
            background-size: 125%; 
            background-position: center; 
            background-repeat: no-repeat; 
            
        }

        ul {
            list-style-type: none; 
            padding: 500px; /* Space inside the box */
            width: 450px; /* Box size fits the content of the text */
            height: 400px;
            margin: 0 auto; /* Center the box horizontally */
            border: 2px white; /* Optional: Adds a border around the box */
            background-color: white; /* Change this to your desired color */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            border-radius: 15px; 


            display: flex; /* Enable Flexbox */
            flex-direction: column; /* Arrange items in a column */
            justify-content: center; /* Center items vertically */

            font-family: 'Source Sans Pro';
        }
    
    </style>

<?php

session_start();

if(isset($_SESSION['employeeID']) && isset($_SESSION['role'])) {
    header("Location: ../main");
    exit;
}


if(isset($_POST['employeeID']) && isset($_POST['password'])) {

    require "../inc/dbconn.inc.php";

    $sql = "SELECT EmployeeID, Role, Password FROM Employees WHERE EmployeeID = ?;";

    $statement = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($statement, 'i', $_POST['employeeID']);

    if (!mysqli_stmt_execute($statement)) {
        echo(mysqli_error($conn));
        exit;
    }
    $result = mysqli_stmt_get_result($statement);
    mysqli_stmt_close($statement);
    mysqli_close($conn);

    if($row = mysqli_fetch_assoc($result)) {
        if(password_verify($_POST['password'], $row['Password'])) {

            $_SESSION['employeeID'] = $row['EmployeeID'];
            $_SESSION['role'] = $row['Role'];

            header("Location: ../main");
            exit;
        }
    }   

    

}