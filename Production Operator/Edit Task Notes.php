<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once '../inc/loggedin.inc.php' ?>
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
        require_once '../inc/dbconn.inc.php';

        if(isset($_GET['noteid'])) {
            $NoteID = $_GET['noteid'];
        }
        else {
            header("location: Task Notes.php");
        }

        $sql = "SELECT Subject, NoteContence, JobID, TimeObserved
                FROM Notes
                WHERE $NoteID = NoteID;";

        if($result = mysqli_query($conn, $sql)) {
            if (1 == mysqli_num_rows($result)) {
                $info = mysqli_fetch_assoc($result);
            }
            else {
                header("location: Task Notes.php");
            }
        }
        else {
            header("location: Task Notes.php");
        }

        echo("
            <b>Note ID: $NoteID</b>
            <ul>
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
                <li><label for='assign-to-field'>Assign To</label> <select id='assign-to-field'>
                    <option value='test'>Test1</option>
                    <option value='test'>Test2</option>
                    <option value='test'>Test3</option>
                    <option value='test'>Test4</option></select></li>
                <li><label for='datetime-observed-field'>Date & Time Observed</label> <input id='datetime-observed-field' type='datetime-local' name='datetime' value='$info[TimeObserved]'> If left blank will default to current time</li>
            </ul>

            
            <input type='submit' value='Update'> <br>

        </form>

        <a href='Task Notes.php'><button>Cancel</button></a> <br>
        <a href='Note Deletion.php?noteID=$NoteID'><button>Delete</button></a>");

        mysqli_close($conn);

        ?>
        

    </main>
</body>
</html>