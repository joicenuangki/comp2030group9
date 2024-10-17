
<?php 
    require_once "../inc/loggedin.inc.php"; 
    FactoryManagerCheck(); 
    require "../inc/dbconn.inc.php";
    

    $jobDesc = $_POST["jobDesc"];
    $priority = filter_input(INPUT_POST, "priority");



var_dump($jobDesc, $priority);




$jobName = $_POST["jobName"];
$jobDesc = $_POST["jobDesc"];
$priority = $_POST["priority"];
$jobDate = $_POST["jobDate"];
$MachineID = $_POST["machine"];



$job_sql = "INSERT INTO jobs (`Desc`, Priority, `Name`, AssignedDate, MachineID, FactoryManagerID ) VALUES (?, ?, ?, ?, ?, ?)";
$job_stmt = mysqli_prepare($conn, $job_sql);
mysqli_stmt_bind_param($job_stmt, "ssssis", $jobDesc, $priority, $jobName, $jobDate, $MachineID, $_SESSION['employeeID']);
mysqli_stmt_execute($job_stmt);



$job_id = mysqli_insert_id($conn);
$jobworkers_sql = "INSERT INTO `assigned to jobs` (JobID, ProductionOperatorID) VALUES (?, ?)"; 
$jobworkers_stmt = mysqli_prepare($conn, $jobworkers_sql); 


$employeeFields = array_filter(array_keys($_POST), function($key) {
    return $key === 'employee_1' || strpos($key, 'employee_') === 0; 
});



if (empty($employeeFields)) {
    
    //echo "NO EMPLOYEE FIELDS FOUND IN FORM SUBMISSION<br>";
} else {
    foreach ($employeeFields as $field) {
        $employeeID = $_POST[$field];
        //echo "PROCESSING FIELD: " . $field . " WITH VALUE: " . $employeeID . "<br>";
        
        if (!empty($employeeID) && $employeeID !== "Select an employee") {
            $jobworkers_sql = "INSERT INTO `assigned to jobs` (JobID, ProductionOperatorID) VALUES (?, ?)";
            $jobworkers_stmt = mysqli_prepare($conn, $jobworkers_sql);
            
            if ($jobworkers_stmt) {
                mysqli_stmt_bind_param($jobworkers_stmt, "ii", $job_id, $employeeID);
                
                if (mysqli_stmt_execute($jobworkers_stmt)) {
                    //echo "EMPLOYEE " . $employeeID . " ASSIGNED TO JOB " . $job_id . "<br>";
                } else {
                    //echo "ERROR ASSIGNING EMPLOYEE " . $employeeID . ": " . mysqli_stmt_error($jobworkers_stmt) . "<br>";
                }
                
                mysqli_stmt_close($jobworkers_stmt);
            } else {
                //echo "ERROR PREPARING STATEMENT: " . mysqli_error($conn) . "<br>";
            }
        } else {
            //echo "EMPLOYEE FIELD " . $field . " IS EMPTY OR NOT SELECTED<br>";
            break;
        }
    }
}

/* ASKED AI Why isnt my code working Im getting this error "Fatal error: Uncaught mysqli_sql_exception: Duplicate entry '25-1' for key 'PRIMARY' in C:\xampp\htdocs\www\Own-Work\process-job.php:58 Stack trace: #0 C:\xampp\htdocs\www\Own-Work\process-job.php(58): mysqli_stmt_execute(Object(mysqli_stmt)) #1 {main} thrown in C:\xampp\htdocs\www\Own-Work\process-job.php on line 58"
 Code wasn't iterating through due to incorrect naming conventions of field. Loop has been heavily this has been heavily assisted by AI 

 CLAUDE.AI RESPONSE
 The error you're encountering is due to a duplicate primary key violation in the "Assigned to Jobs" table. This is happening because you're trying to insert a record with a primary key combination that already exists in the table. Let's break down the issue and provide some solutions:

Table naming: First, there's an issue with your table name "Assigned to Jobs". SQL doesn't allow spaces in table names without proper quoting. You should rename this table to something like "AssignedToJobs" (without spaces).
Primary key constraint: The table "Assigned to Jobs" has a composite primary key (JobID, ProductionOperatorID). The error suggests you're trying to insert a duplicate combination of these values.
Prepared statement: Your prepared statement for inserting into this table is defined outside the loop, which is correct. However, you're not binding the parameters or executing the statement inside the loop.

Here's how you can modify your PHP code to fix these issues:

 PROMPT:
 Why isnt my code working Im getting this error "Fatal error: Uncaught mysqli_sql_exception:
  Duplicate entry '25-1' for key 'PRIMARY' in C:\xampp\htdocs\www\Own-Work\process-job.php:58
  Stack trace: #0 C:\xampp\htdocs\www\Own-Work\process-job.php(58): mysqli_stmt_execute(Object(mysqli_stmt)) 
  #1 {main} thrown in C:\xampp\htdocs\www\Own-Work\process-job.php on line 58"

 ORIGONAL CODE:
  
$job_id = mysqli_insert_id($conn);
$jobworkers_sql = "INSERT INTO assigned to jobs (JobID, ProductionOperatorID) VALUES (?, ?)"; //For some reason not working in the loop?
$jobworkers_stmt = mysqli_prepare($conn, $jobworkers_sql); 

  
  for ($i = 1; $i <= 5; $i++) {

    if(isset($_POST['employee_' . $i])){
        $employeeCheck = $_POST['employee_' . $i];
    }

    if (isset($employeeCheck)){
        ${"employee_" . $i} = $employeeCheck;
    }
    else{
        ${"employee_" . $i} = NULL;
    }
(DID LOSE A TINY BIT OF ORIGIONAL CODE)

INTERPRETATION:
TURNS OUT MY NAMING CONVENTIONS WERE OFF THEREFORE 
MY COUNTER WASNT ACTUALLY COUNTING PAST employee_1 AND KEPT INSERTING THE SAME KEY.
 I WAS BASING IT OFF OF EMPLOYEE_ID RATHER THAN FIELD NAME ALTHOUGH CLAUDES CODE WAS MUCH MORE EFFICIENT
  



  }

*/
  






/* REDUNTANT CODE
$jobworkers_sql = "INSERT INTO `assigned to jobs` (JobID, ProductionOperatorID, ProductionOperatorID2, ProductionOperatorID3, ProductionOperatorID4, ProductionOperatorID5) VALUES (?, ?, ?, ?, ?, ?)";
$jobworkers_stmt = mysqli_prepare($conn, $jobworkers_sql);
mysqli_stmt_bind_param($jobworkers_stmt, "isssss", $job_id, $employee_1, $employee_2, $employee_3, $employee_4, $employee_5);
mysqli_stmt_execute($jobworkers_stmt);
*/

mysqli_stmt_close($job_stmt);

mysqli_close($conn);



//ADD CHECK OF YES OR NO

header("Location: Job-Added.php");
