

<?php 
    require_once "../inc/loggedin.inc.php"; 
    FactoryManagerCheck(); 
    require "../inc/dbconn.inc.php";
    
    ?>

<?php 

$jobName = $_POST["JobID"];
$employees = $conn->query("SELECT FName, LName, EmployeeID FROM employees WHERE Role ='Production Operator'");



$employeeList = [];
while ($rows = $employees->fetch_assoc()) {
    $employeeList[] = ['id' => $rows['EmployeeID'], 'name' => $rows['FName'] . " " . $rows['LName']];
}


$machinesql = "SELECT MachineID, MachineName FROM machines";
$result = $conn->query($machinesql);

$chosenJobQuery = $conn->query("SELECT * FROM jobs WHERE JobID = $jobName");
$chosenJob = $chosenJobQuery->fetch_assoc();

$chosenJobEmployeesQuery = $conn->query("SELECT * FROM `assigned to jobs` WHERE JobID = $jobName");
$chosenJobEmployees = [];

while ($row = $chosenJobEmployeesQuery->fetch_assoc()) {
    $chosenJobEmployees[] = $row['ProductionOperatorID'];
}



$conn->close();
?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Elij" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Styles/Style.css">
        <link rel="stylesheet" href="../Styles/Factory Manager.css">
        <link rel="stylesheet" href="factorymanager2.css">
    </head>

    <body>
        <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Edit Jobs</h1>
        <div id="user-role"><?php DisplayInformation(); ?></div>
        </header>

        

        <div class="container">


        <form action="process-edit-job.php" method="post" onsubmit="return validateEmployeeData();"> 
            <div id="input_fields">

            <input type="hidden" name="current_job" value="<?php echo $chosenJob['JobID']; ?>">

            <label for="jobName">Job Name </label>
            <input type="text" id="jobName" name="jobName" required autocomplete="off" value="<?php echo htmlspecialchars($chosenJob['Name']); ?>">



            <?php
            // Generate dropdowns for each assigned employee    
            for ($i = 1; $i <= count($chosenJobEmployees); $i++) {
                echo '<label for="employee_' . $i . '">Employee ' . $i . '</label>';
                echo '<select id="employee_' . $i . '" name="employee_' . $i . '">';
                echo '<option value="">Select an employee</option>';
                
                foreach ($employeeList as $employee) {
                    $selected = (in_array($employee['id'], $chosenJobEmployees) && $chosenJobEmployees[$i-1] == $employee['id']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($employee['id'], ENT_QUOTES, 'UTF-8') . "' " . $selected . ">" . htmlspecialchars($employee['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                }
                
                echo '</select>';
            }
            
            



                  /*  REDUNDANT CODE
                  
                  foreach ($employeeList as $employee) {
                        if (in_array($employee['id'], $chosenJobEmployees)) {
                            // Employee is already assigned to this job, mark as selected
                            echo "<option selected value='" . htmlspecialchars($employee['id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($employee['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                        } else {
                            // Employee is not assigned, just list them
                            echo "<option value='" . htmlspecialchars($employee['id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($employee['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                        }
                    }*/
                ?>
            </select>



                <label for="jobDesc"> Description </label>
                <textarea id="jobDesc" name="jobDesc"><?php echo htmlspecialchars($chosenJob['Desc'], ENT_QUOTES, 'UTF-8'); ?></textarea>

                <label for="machine">Machine</label>
                <select id="machine" name="machine">
                    <option value="1">No Machine</option>
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                
                                if($row['MachineID'] === $chosenJob['MachineID']){
                                    echo "<option selected value='" . $row['MachineID'] . "'>" . $row['MachineName'] . "</option>";
                                }

                                else{
                                    echo "<option value='" . $row['MachineID'] . "'>" . $row['MachineName'] . "</option>";
                                }
                            }
                        } else {
                            echo "<option value=''>No machines available</option>";
                        }
                    ?>
                                    
               

                </select>



                <label for="priority">Priority</label>
                <select id="priority" name="priority">
                    <?php


                        if($chosenJob['Priority'] === 'Low'){
                            echo "<option value='Low' selected>Low</option> 
                            <option value='Medium'>Medium</option>
                            <option value='High'>High</option>";
                            
                            
                            
                        }

                        elseif($chosenJob['Priority'] === 'Medium'){
                            echo "<option value='Low'>Low</option> 
                            <option value='Medium' selected>Medium</option>
                            <option value='High'>High</option>";

                            
                        }
                        elseif($chosenJob['Priority'] === 'High'){
                            echo "<option value='Low'>Low</option> 
                            <option value='Medium'>Medium</option>
                            <option value='High' selected>High</option>";

                           


                        }
                        else{

                            echo "
                            <option disabled='true' selected>Please select a priority for this job</option> 
                            <option value='Low'>Low</option> 
                            <option value='Medium'>Medium</option>
                            <option value='High'>High</option>";

                           
                        }

                    
                    
                    
                    ?>
                </select>

                <label for="jobDate">Job Date </label>
                <input type="date" id="jobEditDate" name="jobEditDate" value="<?php echo $chosenJob['AssignedDate']; ?>">

                <input type="hidden" name="current_job" value="<?php echo $chosenJob['JobID']; ?>">
                <button type="submit" name="action" value="update">UPDATE JOB</button>
                <button type="submit" name="action" value="delete">DELETE JOB</button>

            </div>
        </form>

        <div class="btns">
                    <input type="button" value="Add Employee" onclick="addEmployee()">
                    <input type="button" value="Remove Employee" onclick="removeEmployee()">
                   
                    


        </div>
        </div>




    </body>




    <script src="jobedit.js"></script>

    <!-- Pass the PHP employee list to JavaScript queried chat gpt about transfering variables from php to javascript -->
    <script>
        const employeeNames = <?php echo json_encode($employeeList); ?>;
        const employeeNameSet = <?php echo json_encode($chosenJobEmployees)?>;
        const initialEmployeeCount = <?php echo json_encode(count($chosenJobEmployees)); ?>
    </script>
    


</html>