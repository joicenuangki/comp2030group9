<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Production Operator.css">
    <title>Task Notes</title>
</head>
<body>
    <header>
        <?php include '../inc/header.inc.php';?>
        <h1>Task Notes</h1>
        <div id="user-role">Role:</div>
    </header>
    <main>
        <div class="task-note-button">
            <a href="Create Task Notes.php"><button><b>Create New Note</b></button></a>
        </div>
        <div class="task-note-button">
            <a href="View Task Notes.php"><button><b>View All Notes</b></button></a>
        </div>

        <table>
            <tr>
                <th>Note ID</th>
                <th>Subject</th>
                <th>Assigned Manager/s</th>
                <th>Time Observed</th>
                <th></th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="Edit Task Notes.php">Edit</a></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="Edit Task Notes.php">Edit</td></a>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="Edit Task Notes.php">Edit</td></a>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="Edit Task Notes.php">Edit</td></a>
            </tr>
        </table>
    </main>
    
</body>
</html>