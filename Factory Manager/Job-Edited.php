<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php";
    FactoryManagerCheck();?>
    <html lang="en">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factory Manager.css">
    <link rel="stylesheet" href="factorymanager2.css">
<head>
<body>
        <header>
        <?php include_once '../inc/header.inc.php';?>
        <h1>Edit Jobs</h1>
        <div id="user-role"><?php DisplayInformation(); ?></div>
        </header>
        
        <h1>Congratulations Job has been Updated</h1>

        <a href="AddJob.php"><button class="jobsOverview-btn" id="AddJobs-btn">Add Another Job</button></a>
        <a href="job-history.php"><button class="jobsOverview-btn" id="history-btn">Job History</button></a>
        <a href="JobsOverview.php"><button class="jobsOverview-btn" id="history-btn">Job Overview</button></a>
</body>
</html>