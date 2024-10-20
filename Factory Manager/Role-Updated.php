<!DOCTYPE html>
    <html lang="en">
    <head> 
    <?php require_once "../inc/loggedin.inc.php"; 
    FactoryManagerCheck();?>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Factory Manager.css">
    </head>

    <body>
        <header>
            <?php include_once "../inc/header.inc.php"; ?>
            <h1>ROLE UPDATED</h1>
            <div id="user-role"><?php DisplayInformation(); ?></div>
        </header>
        <main>
            <a href="assign-roles.php"><button class="jobsOverview-btn" id="roles-btn">Back to Roles</button></a>
            <a href="JobsOverview.php"><button class="jobsOverview-btn">Edit Or Delete Jobs</button></a>
        </main>
    </body>
    </html>