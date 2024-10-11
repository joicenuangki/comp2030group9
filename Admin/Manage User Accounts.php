<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Administrator.css">
    <title>Manage User Accounts</title>
    <?php
$servername = "Server_Name_Here";
$username = "Username"; 
$password = "Password";
$dbname = "Database"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Enter Employee First Name: ";
$firstName = trim(fgets(STDIN));

echo "Enter Employee Last Name: ";
$lastName = trim(fgets(STDIN));

echo "Enter User Role: ";
$userRole = trim(fgets(STDIN));


$stmt = $conn->prepare("INSERT INTO Employees (FirstName, LastName, UserRole) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $firstName, $lastName, $userRole);


if ($stmt->execute()) {
    echo "Employee added successfully.\n";
} else {
    echo "Error adding employee: " . $stmt->error . "\n";
}

$stmt->close();
$conn->close();
?>
