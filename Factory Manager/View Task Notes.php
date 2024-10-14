<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factory Manager.css">
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
        <table>
            <tr>
                <th>Note ID</th>
                <th>Subject</th>
                <th>Note Creator</th>
                <th>Time Observed</th>
                <th>Active Task</th>
                <th>Note</th>
            </tr>
            <?php
            require_once "../inc/dbconn.inc.php";



            $sql = "SELECT Notes.NoteID, Notes.Subject, Notes.TimeObserved, Jobs.Name, CONCAT (Employees.FName, ' ', Employees.LName) AS FullName, Notes.NoteContence, `Assigned to Notes`.FactoryManagerID
                    FROM Notes
                    LEFT JOIN `Assigned to Notes` ON Notes.NoteID = `Assigned to Notes`.NoteID
                    LEFT JOIN Jobs ON Notes.JobID = Jobs.JobID
                    JOIN Employees ON Notes.ProductionOperatorID = Employees.EmployeeID
                    WHERE Notes.Completed = 0 AND `Assigned to Notes`.FactoryManagerID = " . $_SESSION['employeeID'] ."
                    ORDER BY Notes.NoteID DESC;";

            if($result = mysqli_query($conn, $sql)) {
                
                while($row = mysqli_fetch_assoc($result)) {
                    echo("<tr>
                            <td>$row[NoteID]</td>
                            <td>$row[Subject]</td>
                            <td>$row[FullName]</td>
                            <td>$row[TimeObserved]</td>
                            <td>$row[Name]</td>
                            <td>$row[NoteContence]</td>
                        </tr>");
                }
            }

            mysqli_close($conn);
            ?>
            
        </table>
    </main>
    
</body>
</html>