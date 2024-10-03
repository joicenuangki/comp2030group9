<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Production Operator.css">
    <title>Create Task Notes</title>
</head>
<body>
    <header>
        <?php include '../inc/header.inc.php';?>
        <h1>Create New Task Note</h1>
        <div id="user-role">Role:</div>
    </header>
    <main>
        <?php

        require_once '../inc/dbconn.inc.php';

        echo("<form action='Task Note Creation.php' method='post'>
            <ul>
                <li><label for='subject-field'>Subject</label> <input id='subject-field' type='text' name='subject' required></li>
                <li><label for='note-field'>Note</label> <input id='note-field' type='textarea' name='note' required></li>
                <li><label for='active-task-field'>Active Task</label> <select id='active-task-field' name='task'>

                <option value=''>&lt;No Task&gt;</option>");
                $sql = "SELECT JobID, Name FROM Jobs;";
                if($result = mysqli_query($conn, $sql)) {
                    if (1 <= mysqli_num_rows($result)) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("<option value='$row[JobID]'>$row[Name]</option>");
                        }
                    }
                }

                echo("</select></li> 
                <li><label for='assign-to-field'>Assign To</label> <select id='assign-to-field' name='assign'>");
                $sql = "SELECT EmployeeID, FName, LName FROM Employees WHERE Role = 'Factory Manager';";
                if($result = mysqli_query($conn, $sql)) {
                    if (1 <= mysqli_num_rows($result)) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("<option value='$row[EmployeeID]'>$row[FName] $row[LName]</option>");
                        }
                    }
                }
                echo("
                </select></li>
                <li><label for='datetime-observed-field'>Date & Time Observed</label> <input id='datetime-observed-field' type='datetime-local' name='datetime'> If no date is selected, date will default to todays date </li>
            </ul>

            <input type='submit' value='Create'>

        </form>");

        mysqli_close($conn);
        ?>

        <a href="Task Notes.php"><button>Cancel</button></a>

    </main>
</body>
</html>