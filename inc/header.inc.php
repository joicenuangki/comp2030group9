<body>
<ul id="header-bar">
        <li><a href="../main">Home</a></li>
        <li id="title">Smart Manufacturing Dashboard</li>
        <li><a href="../main/Logout.php">Logout</a></li>
    </ul>

</body>

<style>
    body {
        margin: 0; /* Remove default body margin */
        padding: 0; /* Remove default body padding */
    }

    #header-bar {
        padding: 10px;
        left: 0
        list-style-type: none; /* Remove bullet points */
        background-color: #f8f8f8; /* Optional: background color for visibility */
        display: flex; /* Use flexbox for alignment */
        justify-content: space-between; /* Space items evenly */
        align-items: center; /* Center items vertically */
        height: 20px; /* Set a fixed height */
        position: fixed; /* Make the header fixed */
        top: 0; /* Position it at the top */
        width: 100%; /* Full width */
        z-index: 1000; /* Ensure it stays above other content */
    }

    #title {
        font-weight: lighter;
    }

    li {

    }

    a {
        text-decoration: none; /* Remove underline from links */
        color: black; /* Set link color */
    }

    div {
        padding-top: 60px; /* Add padding to avoid overlap with fixed header */
    }
</style>