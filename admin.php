<?php
include 'db.php';

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $conn->query("DELETE FROM users WHERE id=$id");
}

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Admin Panel</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Profile</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['profile']; ?></td>
                <td><a href="?delete_id=<?php echo $row['id']; ?>">Delete</a></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <a href="backup.php">Backup Database</a>
</body>
</html>
