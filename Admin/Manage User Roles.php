<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/Style.css">
    <link rel="stylesheet" href="../Styles/Administrator.css">
    <title>Manage User Roles</title>
</head>
<?php
$servername = "Server_Name_Here";
$username = "Username"; 
$password = "Password";
$dbname = "Database"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function displayRoles($conn) {
    $sql = "SELECT * FROM UserRoles";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "User Roles:\n";
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Role: " . $row["role_name"] . "\n";
        }
    } else {
        echo "No user roles found.\n";
    }
}

function addRole($conn, $roleName) {
    $stmt = $conn->prepare("INSERT INTO UserRoles (role_name) VALUES (?)");
    $stmt->bind_param("s", $roleName);

    if ($stmt->execute()) {
        echo "User role added successfully.\n";
    } else {
        echo "Error adding user role: " . $stmt->error . "\n";
    }

    $stmt->close();
}

function deleteRole($conn, $roleId) {
    $stmt = $conn->prepare("DELETE FROM UserRoles WHERE id = ?");
    $stmt->bind_param("i", $roleId);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "User role removed successfully.\n";
        } else {
            echo "No user role found with that ID.\n";
        }
    } else {
        echo "Error removing user role: " . $stmt->error . "\n";
    }

    $stmt->close();
}

while (true) {
    echo "\nUser Role Management\n";
    echo "1. View User Roles\n";
    echo "2. Add User Role\n";
    echo "3. Remove User Role\n";
    echo "4. Exit\n";
    
    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case 1:
            displayRoles($conn);
            break;
        case 2:
            echo "Enter User Role Name: ";
            $roleName = trim(fgets(STDIN));
            addRole($conn, $roleName);
            break;
        case 3:
            echo "Enter User Role ID to Delete: ";
            $roleId = trim(fgets(STDIN));
            deleteRole($conn, $roleId);
            break;
        case 4:
            echo "Exiting\n";
            $conn->close();
            exit();
        default:
            echo "Invalid choice. Please try again.\n";
    }
}
?>
