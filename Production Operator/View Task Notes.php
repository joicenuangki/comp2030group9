<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; 
    ProductionOperatorCheck();?>
    <meta charset="UTF-8">
    <meta name="author" content="Nathan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Production Operator.css">
    <title>View Task Notes</title>
</head>
<body>
    <header>
        <?php include_once '../inc/header.inc.php'; ?>
        <h1>View Task Notes</h1>
        <div id="user-role"><?php DisplayInformation(); ?></div>
    </header>
    <main id="view-task-note-main">
        <ul id="view-notes-menu">
            <li><form method="post">
                <input type="text" placeholder="Search" id="search-bar" name="search" value="<?php echo(isset($_POST['search']) ? $_POST['search'] : ''); ?>" autocomplete="off" autofocus>
                <input type="submit" value="Search">
            </form></li>
            <li><a href="Task Notes.php" id="task-notes-back"><button>Back to Task Notes</button></a></li>
        </ul>
        <table>
            <tr>
                <th>Note ID</th>
                <th>Subject</th>
                <th>Assigned Manager/s</th>
                <th>Time Observed</th>
                <th>Active Task</th>
                <th>Note</th>
                <th>Edit</th>
                <th>Complete</th>
            </tr>
            <?php
            require "../inc/dbconn.inc.php";

            if(isset($_POST['search'])) {
                $search = "%{$_POST['search']}%";
            }
            else {
                $search = "%";
            }

            $sql = "SELECT Notes.NoteID, Subject, TimeObserved, GROUP_CONCAT(CONCAT(Employees.FName, ' ', Employees.LName) SEPARATOR '<br>') AS AssignedFactoryManagers, Jobs.Name, NoteContence FROM Notes
                    LEFT JOIN `Assigned to Notes` ON Notes.NoteID = `Assigned to Notes`.NoteID
                    LEFT JOIN Employees ON `Assigned to Notes`.FactoryManagerID = Employees.EmployeeID
                    LEFT JOIN Jobs ON Notes.JobID = Jobs.JobID
                    WHERE Notes.Completed = 0 AND ? = ProductionOperatorID
                    AND (Notes.NoteID LIKE ? OR Subject LIKE ? OR TimeObserved LIKE ? OR Employees.FName LIKE ? OR Employees.LName LIKE ? OR Jobs.Name LIKE ? OR NoteContence LIKE ?)
                    GROUP BY Notes.NoteID DESC;";
                    
            $statement = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($statement, 'isssssss', $_SESSION['employeeID'], $search, $search, $search, $search, $search, $search, $search);
                
            if(!mysqli_stmt_execute($statement)) {
                echo(mysqli_error($conn));
                exit;
            }
            $result = mysqli_stmt_get_result($statement);

            while($row = mysqli_fetch_assoc($result)) {
                echo("<tr>
                        <td>$row[NoteID]</td>
                        <td>$row[Subject]</td>
                        <td>$row[AssignedFactoryManagers]</td>
                        <td>$row[TimeObserved]</td>
                        <td>$row[Name]</td>
                        <td>$row[NoteContence]</td>
                        <td>
                            <form method='post' action='./Edit Task Notes.php'>
                                <input type='submit' name='action' value='Edit'>
                                <input type='hidden' name='noteID' value='$row[NoteID]'>
                            </form>
                        </td>
                        <td>
                            <form method='post' action='Note Modification'>
                                <input type='submit' name='action' value='Complete'>
                                <input type='hidden' name='noteID' value='$row[NoteID]'>
                            </form>
                        </td>
                    </tr>");
            }
            mysqli_stmt_close($statement);
            mysqli_close($conn);
            ?>
            
        </table>
    </main>
    
</body>
</html>