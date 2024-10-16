
<?php 
    include_once '../inc/header.inc.php';
    require_once "../inc/loggedin.inc.php"; 
    FactoryManagerCheck(); 
    require "../inc/dbconn.inc.php";
    
?>

<?php

    $jobDesc = $_POST["jobDesc"];
    $priority = filter_input(INPUT_POST, "priority");



var_dump($jobDesc, $priority);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if 'action' is set in the POST data
        if (isset($_POST['action'])) {
            $action = $_POST['action'];}
        }
     else {
        die("How did you get here?");
    }


   
    $jobID = $_POST['current_job'];
    $jobName = $_POST["jobName"];
    $jobDesc = $_POST["jobDesc"];
    $priority = $_POST["priority"];
    $jobDate = $_POST["jobEditDate"];
    $MachineID = $_POST["machine"];

    if ($action === 'update') {



    


    $updateQuery = "UPDATE Jobs SET Name=?, `Desc`=?, MachineID=?, Priority=?, AssignedDate=? WHERE JobID = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssissi", $jobName, $jobDesc, $MachineID, $priority, $jobDate, $jobID);
    $stmt->execute();

    /* Asked AI Code for the updating of employees influenced by ai Statement was Hi, I have code which Im using a POST method to UPDATE existing tables. 
    the last part Im struggling to implement. I have a dynamic form that I can add or remove inputs which is tracked by a counter maxEmployees and on my javascript.
    I need to run a loop that will check all inputs from the dynamic form 
    ('employee_' . $i) and either update them into the table, INSERT them into the table or if they're no longer in the post statment DROP them from the table.
    Heres what I have so far

    currentAssignments = [];
    $currentQuery = "SELECT ProductionOperatorID FROM `Assigned to Jobs` WHERE JobID = ?";
    $stmt = $conn->prepare($currentQuery);
    $stmt->bind_param("i", $jobID);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $currentAssignments[] = $row['ProductionOperatorID'];
    }

    $newAssignments = [];
    for ($i = 1; $i <= 5; $i++) {
        if (isset($_POST["employee_$i"]) && !empty($_POST["employee_$i"])) {
            $newAssignments[] = $_POST["employee_$i"];
        }
    }

    
    CLAUDE AI

    RESPONSE:
    I understand your situation. You're trying to populate a dropdown list of employees, with the currently assigned employees for a specific job pre-selected. 
    Let's modify your code to achieve this. Here's how we can fix the loop: Here's what I've changed:

    I've removed the hardcoded part for employee_1 and replaced it with a dynamic loop.
    The loop generates a dropdown for each assigned employee, using the count of $chosenJobEmployees.
    Inside the loop, we iterate through all employees, checking if the current employee is in the $chosenJobEmployees array and if it matches the current position we're filling. If both conditions are true, we mark that option as selected.
    The selected attribute is added conditionally based on whether the employee is assigned to this job and in the correct position.
    I've kept the "Select an employee" option as the first choice in each dropdown.

    This approach should correctly populate your dropdowns with all employees, pre-selecting the ones assigned to this job in their correct positions.
    For your JavaScript file, you might want to update the addEmployee() function to start from the current count of employees rather than always starting from 1. Here's a suggestion for modifying jobjs.js:

    These changes should resolve your issue and correctly display and select the assigned employees for the job. The PHP script will generate the initial dropdowns with the correct selections, and the JavaScript will allow adding more employees as needed.
    Remember to update your validateEmployeeData() function to check all dynamically created dropdowns, not just the first five. You might want to use a loop similar to the one in the PHP script to check all employee dropdowns.
    Let me know if you need any clarification or have any questions about these changes!



    
    
    */
    $currentAssignments = [];
    $currentQuery = "SELECT ProductionOperatorID FROM `Assigned to Jobs` WHERE JobID = ?";
    $stmt = $conn->prepare($currentQuery);
    $stmt->bind_param("i", $jobID);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $currentAssignments[] = $row['ProductionOperatorID'];
    }


    $newAssignments = [];
    for ($i = 1; $i <= 5; $i++) {
        if (isset($_POST["employee_$i"]) && !empty($_POST["employee_$i"])) {
            $newAssignments[] = $_POST["employee_$i"];
        }
    }

    $insertQuery = "INSERT INTO `Assigned to Jobs` (JobID, ProductionOperatorID) VALUES (?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    foreach ($newAssignments as $employeeID) {
        if (!in_array($employeeID, $currentAssignments)) {
            $insertStmt->bind_param("ii", $jobID, $employeeID);
            $insertStmt->execute();
        }
}

}
elseif ($action === 'delete') {
    echo "Job ID to be deleted: " . $jobID . "<br>"; // Add this line for debugging
  
    $deleteAssignmentsQuery = "DELETE FROM `Assigned to Jobs` WHERE JobID = ?";
    $stmt = $conn->prepare($deleteAssignmentsQuery);
    $stmt->bind_param("i", $jobID);
  

  
    $deleteJobQuery = "DELETE FROM Jobs WHERE JobID = ?";
    $stmt = $conn->prepare($deleteJobQuery);
    $stmt->bind_param("i", $jobID);
  
 
  $stmt->execute();

  }
echo "Job and employees successfully inserted.";
?>

<!DOCTYPE html>
    <html lang="en">

    <head>  
    <html lang="en">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factory Manager.css">
    <link rel="stylesheet" href="factorymanager2.css">
        
        <h1>Congratulations Job has been posted</h1>

        <a href="AddJob.php"><button class="jobsOverview-btn" id="AddJobs-btn">Add Another Job</button></a>
        <a href="job-history.php"><button class="jobsOverview-btn" id="history-btn">Job History</button></a>
        <a href="JobsOverview.php"><button class="jobsOverview-btn" id="history-btn">Job Overview</button></a>



    </head>

    <body>


    </body>
    </html>

