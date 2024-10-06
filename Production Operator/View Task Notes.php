<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Production Operator.css">
    <title>View Task Notes</title>
</head>
<body>
    <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>View Task Notes</h1>
        <div id="user-role">Role:</div>
    </header>
    <main id="view-task-note-main">
        <input type="text" placeholder="Search" id="search-bar">
        <label for="sort-button">Sort By: </label><button id="sort-button"><img src="../images/Sort_IMG.png" alt="Sort Button"></button>
        <a href="Task Notes.php" id="task-notes-back"><button>Back to Task Notes</button></a>
        <table>
            <tr>
                <th>Note ID</th>
                <th>Subject</th>
                <th>Assigned Manager/s</th>
                <th>Time Observed</th>
                <th>Active Task</th>
                <th>Note</th>
                <th></th>
            </tr>
            <?php
            require_once "../inc/dbconn.inc.php";

            $sql = "SELECT Notes.NoteID, Subject, TimeObserved, GROUP_CONCAT(CONCAT(Employees.FName, ' ', Employees.LName) SEPARATOR ', ') AS AssignedFactoryManagers, Jobs.Name, NoteContence
                    FROM Notes
                    LEFT JOIN `Assigned to Notes` ON Notes.NoteID = `Assigned to Notes`.NoteID
                    LEFT JOIN Employees ON `Assigned to Notes`.FactoryManagerID = Employees.EmployeeID
                    LEFT JOIN Jobs ON Notes.JobID = Jobs.JobID
                    WHERE Notes.Completed = 0 AND " . $_SESSION['employeeID'] ." = ProductionOperatorID
                    GROUP BY Notes.NoteID DESC;";

            if($result = mysqli_query($conn, $sql)) {
                
                while($row = mysqli_fetch_assoc($result)) {
                    echo("<tr>
                            <td>$row[NoteID]</td>
                            <td>$row[Subject]</td>
                            <td>$row[AssignedFactoryManagers]</td>
                            <td>$row[TimeObserved]</td>
                            <td>$row[Name]</td>
                            <td>$row[NoteContence]</td>
                            <td><a href='Edit Task Notes.php?noteid=$row[NoteID]'>Edit</a></td>
                        </tr>");
                }
            }

            mysqli_close($conn);
            ?>
            
        </table>
    </main>
    
</body>
</html>