
<?php 
    require_once "../inc/loggedin.inc.php"; 
    FactoryManagerCheck(); 
    require "../inc/dbconn.inc.php";
    
    ?>

<?php
    

    $specQuery = "SELECT * FROM `specialization`";
    $spec = $conn->query($specQuery); 

    $employees = $conn->query("SELECT e.FName, e.LName, e.EmployeeID, s.Specialization 
        FROM employees e
        INNER JOIN specialization s ON e.EmployeeID = s.ProductionOperatorID
        WHERE e.Role = 'Production Operator'");

    $specs = $conn->query("SELECT * FROM specialization");
    
    $specializations = [];
    while ($row2 = $specs->fetch_assoc()) {
    $specializations[] = $row2['Specialization'];
    }


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Roles</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Styles/Style.css">
        <link rel="stylesheet" href="../Styles/Factory Manager.css">
        <meta name="author" content="Elijah" />
        <title>Assign Roles</title> 
    </head>


    <body>
        <header>
            <?php include_once '../inc/header.inc.php';?>
            <h1>Assign Roles</h1>
            <div id="user-role"><?php DisplayInformation(); ?></div>
        </header>
        
        <table class="table">
            <thead>
                <th>Production Operator Name</th>
                <th>Specialization</th>
                <th>Change Role</th>
                <th>Confirm Change</th>
           
            </thead>
            <tbody>
                <?php


while($row = $employees->fetch_assoc()) {
    echo "
        <form method='POST' action='process-assignrole.php'>
        <tr class='role'>
            <td>" . $row['FName'] . " " . $row['LName'] . "</td>
            <td>" . $row['Specialization'] . "</td>
            
            <td>
            <select id='Specialization' name='Specialization'>
                <option value='None'>None</option>
                <option value='Machine Loader'>Machine Loader</option>
                <option value='Robot Overseer'>Robot Overseer</option>
                <option value='CNC Machine Overseer'>CNC Machine Overseer</option>
                <option value='3D Printer Overseer'>3D Printer Overseer</option>
                <option value='Guided Vehicle Overseer'>Guided Vehicle Overseer</option>
                <option value='Maintenance'>Maintenance</option>
                <option value='Assembily Line Overseer'>Assembily Line Overseer</option>
                <option value='Conveyor Overseer'>Conveyor Overseer</option>                   
            </select>
            
            ";


    echo "      
            </td>
            
            <td><input class='change-btn' type='submit' name='action' value='Change'></td>
            <input type='hidden' name='EmployeeID' id='EmployeeID' value='" . $row['EmployeeID'] . "'>
        </tr>
        </form>";
    
    // Reset the result set pointer for the $specs query so it can be reused in the next loop

}
                    
            ?>





            </tbody>
    

        </form>

    </body>
</html>