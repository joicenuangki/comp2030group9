<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage User Roles</title>
</head>
<body>
    <header>
        <h1>User Role Management</h1>
    </header>
    <main>
        <form method="POST" action="Add And Manage User Roles.php">
            <h3>Add New Role</h3>
            <label for="role_name">Role Name:</label>
            <input type="text" name="role_name" required />
            <button type="submit" name="action" value="add">Add Role</button>
        </form>

        <form method="POST" action="Add And Manage User Roles.php">
            <h3>Update Role</h3>
            <label for="existing_role">Select Role:</label>
            <select name="existing_role" required>
                <option value="Production Operator">Production Operator</option>
                <option value="Factory Manager">Factory Manager</option>
                <option value="Administrator">Administrator</option>
                <option value="Auditor">Auditor</option>
            </select>
            <label for="new_role_name">New Role Name:</label>
            <input type="text" name="new_role_name" required />
            <button type="submit" name="action" value="update">Update Role</button>
        </form>

        <form method="POST" action="Add And Manage User Roles.php">
            <h3>Delete Role</h3>
            <label for="delete_role">Select Role:</label>
            <select name="delete_role" required>
                <option value="Production Operator">Production Operator</option>
                <option value="Factory Manager">Factory Manager</option>
                <option value="Administrator">Administrator</option>
                <option value="Auditor">Auditor</option>
            </select>
            <button type="submit" name="action" value="delete">Delete Role</button>
        </form>
    </main>
</body>
</html>
