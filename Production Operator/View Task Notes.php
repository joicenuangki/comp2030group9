<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Production Operator.css">
    <title>View Task Notes</title>
</head>
<body>
    <header>
        <?php include '../inc/header.inc.php';?>
        <h1>View Task Notes</h1>
        <div id="user-role">Role:</div>
    </header>
    <main>
        <input type="text" placeholder="Search" id="search-bar">
        <label for="sort-button">Sort By: </label><button id="sort-button"><img src="../images/Sort_IMG.png" alt="Sort"></button>
        <table id="view-notes-table">
            <tr>
                <th>Note ID</th>
                <th>Subject</th>
                <th>Assigned Manager/s</th>
                <th>Time Observed</th>
                <th>Active Task</th>
                <th>Note</th>
                <th></th>
            </tr>
            <tr>
                <td></td>
                <td></td>
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
                <td></td>
                <td></td>
                <td><a href="Edit Task Notes.php">Edit</a></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
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
                <td></td>
                <td></td>
                <td><a href="Edit Task Notes.php">Edit</a></td>
            </tr>
        </table>
    </main>
    
</body>
</html>