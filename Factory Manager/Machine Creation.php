<?php
if(isset($_POST['name'])) {
        require "../inc/dbconn.inc.php";
        $sql = "SELECT MachineName FROM Machines WHERE MachineName = ?";

        $statement = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($statement, 's', $_POST['name']);

        if(!mysqli_stmt_execute($statement)) {
            echo(mysqli_error($conn));
            exit;
        }
        $result = mysqli_stmt_get_result($statement);
        mysqli_stmt_close($statement);
        mysqli_close($conn);
        if (0 == mysqli_num_rows($result)) {
            $name = $_POST['name'];

            if(isset($_POST['description'])) {
                $description = $_POST['description'];
            }
            else {
                $description = NULL;
            }

            require "../inc/dbconn.inc.php";

            $sql = "INSERT INTO Machines (MachineName, Description) VALUES(?, ?);";

            $statement = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($statement, 'ss', $name, $description);

            if(!mysqli_stmt_execute($statement)) {
                echo(mysqli_error($conn));
                exit;
            }

            mysqli_stmt_close($statement);
            mysqli_close($conn);

            header("Location: Machine Creation Successful.php");
            exit;
        }
    }