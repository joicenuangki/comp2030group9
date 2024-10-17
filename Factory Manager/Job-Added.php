<!DOCTYPE html>
    <html lang="en">
    <head>  
        <?php require_once "../inc/loggedin.inc.php";
        FactoryManagerCheck();?>
        <meta charset="UTF-8">
        <meta name="author" content="Elij" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Styles/Style.css">
        <link rel="stylesheet" href="../Styles/Factory Manager.css">
        <link rel="stylesheet" href="factorymanager2.css">
    </head>

    <body>
        <header>
            <?php include_once "../inc/header.inc.php"; ?>
            <h1>Congratulations Job has been posted</h1>
            <?php DisplayInformation(); ?>
        </header>
        <main>
            <a href="AddJob.php"><button class="jobsOverview-btn" id="AddJobs-btn">Add Another Job</button></a>
                    <a href="job-history.php"><button class="jobsOverview-btn" id="history-btn">Job History</button></a>
            <a href="JobsOverview.php"><button class="jobsOverview-btn" id="history-btn">Back To Job Overview</button></a>
        </main>
    </body>
    </html>

