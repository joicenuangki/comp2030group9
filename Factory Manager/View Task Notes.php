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
        <div id="user-role"><?php DisplayInformation(); ?></div>
    </header>
    <main id="view-task-note-main">
        <form method="post">
            <input type="text" placeholder="Search" id="search-bar" name="search" value="<?php echo(isset($_POST['search']) ? $_POST['search'] : ''); ?>" autocomplete="off" autofocus>
        </form>
        <table>
            <tr>
                <th>Note ID</th>
                <th>Subject</th>
                <th>Note Creator</th>
                <th>Time Observed</th>
                <th>Active Task</th>
                <th>Note</th>
                <th>Mark Complete</th>
            </tr>
            <?php
            require "../inc/dbconn.inc.php";

            if(isset($_POST['search'])) {
                $search = "%{$_POST['search']}%";
            }
            else {
                $search = "%";
            }

            $sql = "SELECT Notes.NoteID, Notes.Subject, Notes.TimeObserved, Jobs.Name, CONCAT (Employees.FName, ' ', Employees.LName) AS FullName, Notes.NoteContence, `Assigned to Notes`.FactoryManagerID
                    FROM Notes
                    LEFT JOIN `Assigned to Notes` ON Notes.NoteID = `Assigned to Notes`.NoteID
                    LEFT JOIN Jobs ON Notes.JobID = Jobs.JobID
                    JOIN Employees ON Notes.ProductionOperatorID = Employees.EmployeeID
                    WHERE Notes.Completed = 0 AND `Assigned to Notes`.FactoryManagerID = ? 
                    AND (Notes.NoteID LIKE ? OR Subject LIKE ? OR TimeObserved LIKE ? OR Name LIKE ? OR FName LIKE ? OR LName LIKE ?  OR NoteContence LIKE ?)
                    ORDER BY Notes.NoteID DESC;";

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
                        <td>$row[FullName]</td>
                        <td>$row[TimeObserved]</td>
                        <td>$row[Name]</td>
                        <td>$row[NoteContence]</td>
                        <td>
                            <form action='Note Modification.php' method='post'>
                                <input type='hidden' value='$row[NoteID]' name='noteID'>
                                <input type='submit' value='Complete'>
                            </form>
                    </tr>");
            }


            mysqli_close($conn);
            ?>
            
        </table>
    </main>
    
</body>
</html>