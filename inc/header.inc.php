<head>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@900&display=swap" rel="stylesheet"> 
</head>
<body>
<ul id="header-bar">
        <li><a href="../main">Home</a></li>
        <li id="title">Smart Manufacturing Dashboard</li>
        <li><a href="../main/Logout.php">Logout</a></li>
    </ul>

</body>

<style>
    body {
        margin: 0; 
        padding: 0;
    }

    #header-bar {
        font-family: 'Source Sans Pro';
        padding: 10px;
        left: 0;
        list-style-type: none; 
        background-color: #f8f8f8; 
        display: flex; 
        justify-content: space-between; 
        align-items: center;
        height: 20px; 
        position: fixed; 
        top: 0; 
        width: 100%;
        z-index: 1000; 
    }

    #title {
        font-weight: lighter;
    }

    li {

    }

    a {
        text-decoration: none; 
        color: black; 
    }

    div {
        padding-top: 60px; 
    }
</style>