
<?php include_once '../inc/header.inc.php';
    require_once "../inc/loggedin.inc.php"; 
    FactoryManagerCheck(); 
    require "../inc/dbconn.inc.php";
    
    ?>

<?php
    

    
$newSpec = $_POST["Specialization"];
$employee = $_POST["EmployeeID"];


$updateQuery = "UPDATE specialization SET Specialization=? WHERE ProductionOperatorID = ?";
$stmt = $conn->prepare($updateQuery);
$stmt->bind_param("si", $newSpec, $employee);
$stmt->execute();


echo "Job and employees successfully inserted.";
    ?>


<!DOCTYPE html>
    <html lang="en">

    <head>  
    <html lang="en">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factory Manager.css">
    <link rel="stylesheet" href="factorymanager2.css">
        
        <h1>ROLE UPDATED</h1>

        <a href="assign-roles.php"><button class="jobsOverview-btn" id="roles-btn">Back to Roles</button></a>
        <a href="JobsOverview.php"><button class="jobsOverview-btn">Edit Or Delete Jobs</button></a>
        


    </head>

    <body>


    </body>
    </html>

