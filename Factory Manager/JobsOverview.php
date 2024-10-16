
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobs Overview</title> 
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factory Manager.css">
    <link rel="stylesheet" href="factorymanager2.css">
    

    <?php require "../inc/dbconn.inc.php";
     require_once "../inc/loggedin.inc.php"; 
    FactoryManagerCheck();
     ?>
</head>
<body>
    <header>
    <?php include_once '../inc/header.inc.php';?>
        <h1>Jobs Overview</h1>
        <div id="user-role"><?php DisplayInformation(); ?></div>
     </header>

    <main id="JobsOverview"> 
        
        <h2>Current Jobs:</h2>

        <table class="table">
            <thead class="">
                <th>Name</th>
                <th>Description</th>
                <th>Machine</th>
                <th>Worker(s)</th>
                <th>Priority</th>
                <th>Date</th>
                <th>Manager Assigned</th>
                <th>Edit Job</th>
            </thead>
            <tbody>
                <?php
                    


                    $result = $conn->query ("SELECT * FROM Jobs WHERE Completed = 0");


                    
                    
                    
                   
                    

                    while($row= $result->fetch_assoc()){
                        
                        $employeewithjob = [];

                        $jobID = $row['JobID'];
                        $employeenamesquery = "SELECT Employees.FName, Employees.LName 
                                                FROM `assigned to jobs` 
                                                INNER JOIN Employees ON `Assigned to Jobs`.ProductionOperatorID = Employees.EmployeeID
                                                WHERE `Assigned to Jobs`.JobID = $jobID";


                        $result_employees = $conn->query($employeenamesquery);
                        while ($employee_row = $result_employees->fetch_assoc()) {

                            $employeewithjob[] = $employee_row['FName'] . ' ' . $employee_row['LName'];
                        }

                        $allEmployeesAssigned = implode(', ', $employeewithjob);

                        $managerthatassigned = [];
                        
                        $managernamesquery = "SELECT Employees.FName, Employees.LName 
                                            FROM jobs
                                            INNER JOIN Employees ON jobs.FactoryManagerID = Employees.EmployeeID
                                            WHERE jobs.JobID = $jobID";
                        
                        
                        $result_managers = $conn->query($managernamesquery);
                        while($manager_row = $result_managers->fetch_assoc()){

                            $managerthatassigned[] = $manager_row['FName'] . ' ' . $manager_row['LName'];

                        }
                        $allManagersAssigned = implode(', ', $managerthatassigned);

                       

                    echo"<tr> 
                        <td>". $row["Name"] . "</td>
                        <td>". $row["Desc"] . "</td>
                        <td>". $row["MachineID"] . "</td>
                        <td>". $allEmployeesAssigned . "</td>
                        <td>". $row["Priority"] . "</td>
                        <td>". $row["AssignedDate"] . "</td>
                        <td>".  $allManagersAssigned . "</td>
                        <td>
                            <form method='POST' action='edit-job.php'>
                            <input type='hidden' name='JobID' id='JobID' value='" . $row['JobID'] . "'>
                            <input type='submit' name='action' value='Edit Or Delete'>
                            </form>
                                
                            
                        </td>
                
                        </tr>";
                    }
            ?>
            </tbody>

        </table>
       
        <a href="AddJob.php"><button class="jobsOverview-btn" id="AddJobs-btn">Add Jobs</button></a>
        <a href="job-history.php"><button class="jobsOverview-btn" id="history-btn">Job History</button></a>
        <a href="assign-roles.php"><button class="jobsOverview-btn" id="addrole-btn">Roles</button></a>
    
    </main>

</body>
</html>
