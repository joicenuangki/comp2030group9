
<?php 
    require_once "../inc/loggedin.inc.php"; 
    FactoryManagerCheck(); 
    require "../inc/dbconn.inc.php";
    
    ?>

<?php 


$employees = $conn->query("SELECT FName, LName, EmployeeID FROM employees WHERE Role ='Production Operator'");

$employeeList = [];
while ($rows = $employees->fetch_assoc()) {
    $employeeList[] = ['id' => $rows['EmployeeID'], 'name' => $rows['FName'] . " " . $rows['LName']];
}


$machinesql = "SELECT MachineID, MachineName FROM machines";
$result = $conn->query($machinesql);


$conn->close();
?>


<!DOCTYPE html>
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factory Manager.css">
    <meta name="author" content="Elijah" />
    <title>Add Job</title>
    

    <head>

    </head>

    <<body id="addjob">
        <header>
            <?php include_once '../inc/header.inc.php';?>
            <h1>Add Job</h1>
            <div id="user-role"><?php DisplayInformation(); ?></div>
        </header>
        

        

        <div class="container">


        <form action="process-job.php" method="post" onsubmit="return validateEmployeeData();"> 
            <div id="input_fields">

            <label for="jobName">Job Name </label>
            <input type="text" id="jobName" name="jobName" required autocomplete="off">


            <label for="employee_1">Employee</label>
            <select id="employee_1" name="employee_1">
                <option selected disabled="true">Select an employee</option>
                <?php
                foreach ($employeeList as $employee) {
                    echo "<option value='" . htmlspecialchars($employee['id'], ENT_QUOTES, 'UTF-8') . "'>" . htmlspecialchars($employee['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                }
                ?>
            </select>



                <label for="jobDesc"> Description </label>
                <textarea id="jobDesc" name="jobDesc"></textarea>

                <label for="machine">Machine</label>
                <select id="machine" name="machine">
                    <option value="1">No Machine</option>
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['MachineID'] . "'>" . $row['MachineName'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No machines available</option>";
                        }
                    ?>
                                    
               

                </select>



                <label for="priority">Priority</label>
                <select id="priority" name="priority">
                    <option value="Low" selected>Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>

                <label for="jobDate">Job Date </label>
                <input type="date" id="jobDate" name="jobDate">

                <input hidden value="$_SESSION">

                <button>Confirm</button>
            </div>
        </form>

        <div class="btns">
                    <input type="button" value="Add Employee" onclick="addEmployee()">
                    <input type="button" value="Remove Employee" onclick="removeEmployee()">
                    
                    


        </div>
        </div>




    </body>




    <script src="jobjs.js"></script>

    <script>
        const employeeNames = <?php echo json_encode($employeeList); ?>;
    </script>
    
</html>