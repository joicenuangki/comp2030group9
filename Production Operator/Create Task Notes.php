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
            <ul id='create-note-form-list'>
            <li><ul>
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
                <li><label for='datetime-observed-field'>Date & Time Observed</label> <input id='datetime-observed-field' type='datetime-local' name='datetime'> If left blank will default to current time</li>
            </ul></li>

            <li><ul>
                    <li><b>Assigned Managers:</b></li>");

                $sql = "SELECT EmployeeID, FName, LName FROM Employees WHERE Role = 'Factory Manager';";
                if($result = mysqli_query($conn, $sql)) {
                    if (1 <= mysqli_num_rows($result)) {
                        $count = 0;
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("
                                <li>
                                <label for='manager$count'>$row[FName] $row[LName]</label>
                                <input type='hidden' name='manager$count' value=''>
                                <input type='checkbox' name='manager$count' id='manager$count' value='$row[EmployeeID]'>
                                </li>");
                            $count++;
                        }
                    }
                }
                echo("</ul>
            </li></ul>

            <input type='hidden' name='count' value='$count'>

            <input type='submit' value='Create'>

        </form>");

        mysqli_close($conn);
        ?>

        <a href="Task Notes.php"><button>Cancel</button></a>

    </main>
</body>
</html>