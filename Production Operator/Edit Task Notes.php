<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Production Operator.css">
    <title>Edit Task Notes</title>
</head>
<body>
    <header>
        <?php include '../inc/header.inc.php';?>
        <h1>Edit Task Note</h1>
        <div id="user-role">Role:</div>
    </header>
    <main>
        <form action="Task Notes.php">
            <ul>
                <li><label for="subject-field">Subject</label> <input id="subject-field" type="text" required></li>
                <li><label for="note-field">Note</label> <input id="note-field" type="textarea" required></li>
                <li><label for="active-task-field">Active Task</label> <select id="active-task-field"> 
                    <option value="test">Test1</option>
                    <option value="test">Test2</option>
                    <option value="test">Test3</option>
                    <option value="test">Test4</option></select>
                    Check box for no task <input type="checkbox"></li> 
                <li><label for="assign-to-field">Assign To</label> <select id="assign-to-field">
                    <option value="test">Test1</option>
                    <option value="test">Test2</option>
                    <option value="test">Test3</option>
                    <option value="test">Test4</option></select></li>
                <li><label for="date-observed-field">Date Observed</label> <input type="date"> If no date is selected, date will default to todays date </li>
                <li><label for="time-observed-field">Time Observed</label> <input type="time"> If no time is selected, time will default to the current time </li>
            </ul>

            <input type="submit" value="Create">

        </form>

        <a href="Task Notes.php"><button>Cancel</button></a>

    </main>
</body>
</html>