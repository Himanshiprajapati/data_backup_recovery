<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $backup_file = $_FILES['backup']['tmp_name'];
    $sqlScript = file_get_contents($backup_file);

    // Split the SQL script into individual SQL statements
    $sqlStatements = explode(';', $sqlScript);
    
    foreach ($sqlStatements as $statement) {
        $statement = trim($statement);
        if ($statement) {
            $conn->query($statement);
        }
    }

    echo "Database restored successfully.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Database Recovery</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Database Recovery</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="backup" required><br>
        <input type="submit" value="Restore">
    </form>
</body>
</html>
