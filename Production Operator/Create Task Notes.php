<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; 
    ProductionOperatorCheck();?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Production Operator.css">
    <title>Create Task Notes</title>
</head>
<body>
    <header>
        <?php include_once "../inc/header.inc.php"; ?>
        <h1>Create New Task Note</h1>
        <div id="user-role"><?php DisplayInformation(); ?></div>
    </header>
    <main>
        <?php
        require "../inc/dbconn.inc.php";
        ?>
        <form action='Note Creation.php' method='post'>
            <ul id='note-form-list'>
            <li><ul>
                <li><label for='subject-field'>Subject</label> <input id='subject-field' type='text' name='subject' maxlength="50" required autocomplete='off'></li>
                <li><label for='note-field'>Note</label> <textarea id='note-field' name='note' maxlength="1000" rows="5" cols="100" required autocomplete='off'></textarea></li>

                <li><label for='active-task-field'>Active Task</label> <select id='active-task-field' name='task'>
                    <option value=''>&lt;No Task&gt;</option>
                    <?php
                        $sql = "SELECT Jobs.JobID, Name FROM Jobs 
                                JOIN `Assigned to Jobs` ON Jobs.JobID = `Assigned to Jobs`.JobID
                                WHERE Completed = 0 
                                AND `Assigned to Jobs`.ProductionOperatorID = ?;";

                        $statement = mysqli_prepare($conn, $sql);
        
                        mysqli_stmt_bind_param($statement, "i", $_SESSION['employeeID']);
                        if(!mysqli_stmt_execute($statement)) {
                            echo(mysqli_error($conn));
                            exit;
                        }

                        $result = mysqli_stmt_get_result($statement);

                        
                        if (1 <= mysqli_num_rows($result)) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo("<option value='$row[JobID]'>$row[Name]</option>");
                            }
                        }
             
                        mysqli_stmt_close($statement);
                    ?>
                </select></li> 
                <li><label for='datetime-observed-field'>Date & Time Observed</label> <input id='datetime-observed-field' type='datetime-local' step='1' name='datetime'> If left blank will default to current time</li>
            </ul></li>

            <li><ul>
                <li><b>Assign Managers:</b></li>
                <?php
                    $sql = "SELECT EmployeeID, FName, LName FROM Employees WHERE Role = 'Factory Manager';";
                    $statement = mysqli_prepare($conn, $sql);
                    
                    mysqli_stmt_execute($statement);
                    $result = mysqli_stmt_get_result($statement);
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo("
                                <li>
                                <label for='manager$count'>{$row['FName']} {$row['LName']}</label>
                                <input type='hidden' name='manager$count' value=''>
                                <input type='checkbox' name='manager$count' id='manager$count' value='$row[EmployeeID]'>
                                </li>");
                            $count++;
                        }
                    }
                    mysqli_stmt_close($statement);
                ?>
                </ul>
            </li></ul>

            <input type='hidden' name='count' value='<?php echo($count);?>'>

            <input type='submit' value='Create'>

        </form>
        
        <?php
        mysqli_close($conn);
        ?>

        <a href="Task Notes.php"><button>Cancel</button></a>

    </main>
</body>
</html>