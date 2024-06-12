<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $profile = $_POST['profile'];

    $sql = "INSERT INTO users (name, email, profile) VALUES ('$name', '$email', '$profile')";
    if ($conn->query($sql) === TRUE) {
        echo "New user created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>User Registration</h2>
    <form method="post" action="">
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Profile: <input type="text" name="profile" required><br>
        <input type="submit" value="Register">
    </form>

    <h2>Registered Users</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Profile</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['profile']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
