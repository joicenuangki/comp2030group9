<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    require_once '../inc/loggedin.inc.php';
    ProductionOperatorCheck();
    require_once '../inc/dbconn.inc.php';

    if(isset($_GET['noteid'])) {
        $NoteID = $_GET['noteid'];

        $sql = "SELECT ProductionOperatorID, Subject, NoteContence, JobID, TimeObserved FROM Notes WHERE NoteID = ?;";
        
        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, "i", $NoteID);
        if(!mysqli_stmt_execute($statement)) {
            echo(mysqli_error($conn));
            exit;
        }

        $result = mysqli_stmt_get_result($statement);
        $info = mysqli_fetch_assoc($result);

        if($info['ProductionOperatorID'] != $_SESSION['employeeID']) {
            header("Location: ../Production Operator/Task Notes.php");
            exit;
        }
        mysqli_stmt_close($statement);
    }
    else {
        header("Location: Task Notes.php");
        exit;
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Production Operator.css">
    <title>Edit Task Notes</title>
</head>
<body>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Edit Task Note</h1>
        <div id="user-role">Role:</div>
    </header>
    <main>
        <form action='./Note Modification.php' method='post'>
            <b>Note ID: <?php echo($NoteID);?></b>
            <ul id='note-form-list'>
                <li><ul>
                    <li><label for='subject-field'>Subject</label> <input id='subject-field' type='text' name='subject' <?php echo("value='$info[Subject]'");?> required></li>
                    <li><label for='note-field'>Note</label> <textarea id='note-field' name='note' required><?php echo("$info[NoteContence]");?></textarea></li>
                    <li><label for='active-task-field'>Active Task</label> <select id='active-task-field' name='task'>

                    <option value=''>&lt;No Task&gt;</option>"
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
                            if($row['JobID'] == $info['JobID']) 
                                echo("<option value='$row[JobID]' selected='selected'>$row[Name]</option>");
                            else
                                echo("<option value='$row[JobID]'>$row[Name]");
                        }
                    }

                    mysqli_stmt_close($statement);
                    ?>
                    </select></li> 
                    <li><label for='datetime-observed-field'>Date & Time Observed</label> <input id='datetime-observed-field' type='datetime-local' step='1' name='datetime' value='$info[TimeObserved]'> If left blank will not update time</li>
                </ul></li>

            <li><ul>
                <li><b>Assigned Managers:</b></li>
                <?php

                $sql = "SELECT FName, LName, FactoryManagerID FROM Employees
                        JOIN `Assigned to Notes` ON EmployeeID = FactoryManagerID
                        WHERE `Assigned to Notes`.NoteID = ?;";

                $statement = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($statement, "i", $NoteID);
                if(!mysqli_stmt_execute($statement)) {
                    echo(mysqli_error($conn));
                    exit;
                }

                $result = mysqli_stmt_get_result($statement);

                $assignedCount = 0;
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo("
                            <li>
                                <label for='assignedManager$assignedCount'>{$row['FName']} {$row['LName']}</label>
                                <input type='hidden' name='assignedManager$assignedCount' value='{$row['FactoryManagerID']}'>
                                <input type='checkbox' name='assignedManager$assignedCount' id='assignedManager$assignedCount' value='' checked>
                            </li>");
                        $assignedCount++;
                    }
                }

                mysqli_stmt_close($statement);

                ?>
                <br>
                <li><b>Unassigned Managers:</b></li>
                <?php

                    $sql = "SELECT FName, LName, EmployeeID AS FactoryManagerID FROM Employees
                    LEFT JOIN `Assigned to Notes` ON EmployeeID = FactoryManagerID AND `Assigned to Notes`.NoteID = ?
                    WHERE Role = 'Factory Manager' AND `Assigned to Notes`.NoteID IS NULL";

                    $statement = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($statement, "i", $NoteID);
                    if(!mysqli_stmt_execute($statement)) {
                        echo(mysqli_error($conn));
                        exit;
                    }

                    $result = mysqli_stmt_get_result($statement);

                    $unassignedCount = 0;
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                        echo("
                            <li>
                            <label for='unassignedManager$unassignedCount'>{$row['FName']} {$row['LName']}</label>
                            <input type='hidden' name='unassignedManager$unassignedCount' value=''>
                            <input type='checkbox' name='unassignedManager$unassignedCount' id='unassignedManager$unassignedCount' value='{$row['FactoryManagerID']}'>
                            </li>");
                        $unassignedCount++;
                        }
                    }
                mysqli_stmt_close($statement);
                mysqli_close($conn);
                ?>
                </ul>
            </li></ul>
            
            <input type='hidden' name='assignedCount' value='<?php echo($assignedCount);?>'>
            <input type='hidden' name='unassignedCount' value='<?php echo($unassignedCount);?>'>
            <input type='hidden' name='noteID' value='<?php echo($NoteID);?>'>
            
            <input type='submit' name='action' value='Update'> <br>
            
            <input type='submit' name='action' value='Delete'>

        </form>

            <a href='./Task Notes.php'><button>Cancel</button></a> <br>

    </main>
</body>
</html>