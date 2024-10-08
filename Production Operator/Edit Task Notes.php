<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
    require_once '../inc/loggedin.inc.php';
    require_once '../inc/dbconn.inc.php';

    if(isset($_GET['noteid'])) {
        $NoteID = $_GET['noteid'];

        $sql = "SELECT ProductionOperatorID, Subject, NoteContence, JobID, TimeObserved FROM Notes WHERE NoteID = $NoteID";
        $result = mysqli_query($conn, $sql);
        $info = mysqli_fetch_assoc($result);

        if($info['ProductionOperatorID'] != $_SESSION['employeeID']) {
            header("Location: ../Production Operator/Task Notes.php");
            exit;
        }
    }
    else {
        header("location: Task Notes.php");
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
        <?php

        echo("<form action='Note Editing.php' method='post'>
            <b>Note ID: $NoteID</b>
            <ul id='note-form-list'>
                <li><ul>
                    <li><label for='subject-field'>Subject</label> <input id='subject-field' type='text' name='subject' value='$info[Subject]' required></li>
                    <li><label for='note-field'>Note</label> <input id='note-field' type='textarea' name='note' value='$info[NoteContence]' required></li>
                    <li><label for='active-task-field'>Active Task</label> <select id='active-task-field' name='task'>

                    <option value=''>&lt;No Task&gt;</option>");
                    $sql = "SELECT JobID, Name FROM Jobs;";
                    if($result = mysqli_query($conn, $sql)) {
                        if (1 <= mysqli_num_rows($result)) {
                            while($row = mysqli_fetch_assoc($result)) {
                                if($row['JobID'] == $info['JobID']) 
                                    echo("<option value='$row[JobID]' selected='selected'>$row[Name]</option>");
                                else
                                echo("<option value='$row[JobID]'>$row[Name]</option>");
                            }
                        }
                    }
                    echo("</select></li> 
                    <li><label for='datetime-observed-field'>Date & Time Observed</label> <input id='datetime-observed-field' type='datetime-local' name='datetime' value='$info[TimeObserved]'> If left blank will not update time</li>
                </ul></li>

            <li><ul>
                <li><b>Assigned Managers:</b></li>");

                $sql = "SELECT FName, LName, FactoryManagerID FROM Employees
                        JOIN `Assigned to Notes` ON EmployeeID = FactoryManagerID
                        WHERE `Assigned to Notes`.NoteID = $NoteID;";
                if($result = mysqli_query($conn, $sql)) {
                    $assignedCount = 0;
                    if (1 <= mysqli_num_rows($result)) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("
                                <li>
                                <label for='assignedManager$assignedCount'>$row[FName] $row[LName]</label>
                                <input type='hidden' name='assignedManager$assignedCount' value='$row[FactoryManagerID]'>
                                <input type='checkbox' name='assignedManager$assignedCount' id='assignedManager$assignedCount' value='' checked>
                                </li>");
                            $assignedCount++;
                        }
                    }
                }

                echo("<li><b>Unassigned Managers:</b></li>");

                $sql = "SELECT FName, LName, EmployeeID AS FactoryManagerID FROM Employees
                        LEFT JOIN `Assigned to Notes` ON EmployeeID = FactoryManagerID AND `Assigned to Notes`.NoteID = $NoteID
                        WHERE Role = 'Factory Manager' AND `Assigned to Notes`.NoteID IS NULL;";
                if($result = mysqli_query($conn, $sql)) {
                    $unassignedCount = 0;
                    if (1 <= mysqli_num_rows($result)) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo("
                                <li>
                                <label for='unassignedManager$unassignedCount'>$row[FName] $row[LName]</label>
                                <input type='hidden' name='unassignedManager$unassignedCount' value=''>
                                <input type='checkbox' name='unassignedManager$unassignedCount' id='unassignedManager$unassignedCount' value='$row[FactoryManagerID]'>
                                </li>");
                            $unassignedCount++;
                        }
                    }
                }
                
                echo("</ul>
            </li></ul>
            
            <input type='hidden' name='assignedCount' value='$assignedCount'>
            <input type='hidden' name='unassignedCount' value='$unassignedCount'>
            <input type='hidden' name='noteID' value='$NoteID'>
            
            <input type='submit' value='Update'> <br>

        </form>

        <a href='Task Notes.php'><button>Cancel</button></a> <br>
        <a href='Note Deletion.php?noteID=$NoteID'><button>Delete</button></a>");

        mysqli_close($conn);

        ?>
        

    </main>
</body>
</html>