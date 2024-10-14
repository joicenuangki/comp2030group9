<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once "../inc/loggedin.inc.php"; 
    ProductionOperatorCheck();?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Production Operator.css">
    <title>Note Creation Successful</title>
</head>
<body id="success-body">
    <header>
        <?php require_once "../inc/header.inc.php"; ?>
        <h1>Note Created Successfully!</h1>
    </header>
    <main>
        <img 
            src="../images/Ribbon.png"
            alt="Ribbon"
            class="floating-image"
         /><br>
        <a href="Task Notes.php"><button>Return to Notes Overview</button></a><br>
        <a href="../main"><button>Return to Home Page</button></a>

    </main>
</body>
</html>