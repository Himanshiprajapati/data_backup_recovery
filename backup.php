<?php
include 'db.php';

$backup_file = 'backup.sql';
$tables = array();
$result = $conn->query("SHOW TABLES");

while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

$sqlScript = "";

foreach ($tables as $table) {
    // Create table structure
    $result = $conn->query("SHOW CREATE TABLE $table");
    $row = $result->fetch_row();
    $sqlScript .= "\n\n" . $row[1] . ";\n\n";

    // Insert data
    $result = $conn->query("SELECT * FROM $table");
    $columnCount = $result->field_count;

    for ($i = 0; $i < $columnCount; $i++) {
        while ($row = $result->fetch_row()) {
            $sqlScript .= "INSERT INTO $table VALUES(";
            for ($j = 0; $j < $columnCount; $j++) {
                $row[$j] = $row[$j] ?? 'NULL';
                $row[$j] = $conn->real_escape_string($row[$j]);
                $sqlScript .= (is_numeric($row[$j]) ? $row[$j] : "'$row[$j]'") . ($j < ($columnCount - 1) ? ',' : '');
            }
            $sqlScript .= ");\n";
        }
    }
    $sqlScript .= "\n";
}

// Save the SQL script to a backup file
if (!empty($sqlScript)) {
    file_put_contents($backup_file, $sqlScript);
    echo "Database backup created successfully.";
} else {
    echo "Error creating backup.";
}
?>
