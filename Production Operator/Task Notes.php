<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Production Operator.css">
    <title>Task Notes</title>
</head>
<body>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Task Notes</h1>
        <div id="user-role">Role:</div>
    </header>
    <main id="task-note-main">
        <ul>
            <li>
                <div id="task-note-buttons">
                    <a href="Create Task Notes.php"><button><b>Create New Note</b></button></a><br>
                    <a href="View Task Notes.php"><button><b>View All Notes</b></button></a>
                </div>
            </li>
            <li>
                <div id="task-note-recent-table">
                Recent
                <table id="recent-notes-table">
                    <tr>
                        <th>Note ID</th>
                        <th>Subject</th>
                        <th>Assigned Manager/s</th>
                        <th>Time Observed</th>
                        <th></th>
                    </tr>
                    <?php
                    require_once "../inc/dbconn.inc.php";

                    $sql = "SELECT Notes.NoteID, Subject, TimeObserved, GROUP_CONCAT(CONCAT(Employees.FName, ' ', Employees.LName) SEPARATOR ', ') AS AssignedFactoryManagers
                            FROM Notes
                            LEFT JOIN `Assigned to Notes` ON Notes.NoteID = `Assigned to Notes`.NoteID
                            LEFT JOIN Employees ON `Assigned to Notes`.FactoryManagerID = Employees.EmployeeID
                            WHERE Completed = 0 AND " . $_SESSION['employeeID'] ." = ProductionOperatorID
                            GROUP BY Notes.NoteID DESC;";

                    if($result = mysqli_query($conn, $sql)) {
                        if (1 <= mysqli_num_rows($result)) {
                            if(5 <= mysqli_num_rows($result)) {
                                for($i = 0; $i < 5; $i++) {
                                    $row = mysqli_fetch_assoc($result);
                                    echo("<tr>
                                            <td>$row[NoteID]</td>
                                            <td>$row[Subject]</td>
                                            <td>$row[AssignedFactoryManagers]</td>
                                            <td>$row[TimeObserved]</td>
                                            <td><a href='Edit Task Notes.php?noteid=$row[NoteID]'>Edit</a></td>
                                    </tr>");
                                }
                            }
                            else {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo("<tr>
                                            <td>$row[NoteID]</td>
                                            <td>$row[Subject]</td>
                                            <td>$row[AssignedFactoryManagers]</td>
                                            <td>$row[TimeObserved]</td>
                                            <td><a href='Edit Task Notes.php?noteid=$row[NoteID]'>Edit</a></td>
                                        </tr>");
                                }
                            }
                        }
                    }
                    mysqli_close($conn);
                    ?>
                </table>
                </div>
            </li>
        </ul>
    </main>

</body>
</html>