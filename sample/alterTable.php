<?php
include 'DBConnector.php';

// Check if the Designation column exists
$check_query = "SHOW COLUMNS FROM employee LIKE 'Designation'";
$result = $conn->query($check_query);

if ($result && $result->num_rows == 0) {
    // Column doesn't exist, execute ALTER TABLE query
    $alter_query = "ALTER TABLE employee ADD COLUMN Designation INT";
    if ($conn->query($alter_query) === TRUE) {
        echo "<p>Table altered successfully.</p>";
    } else {
        echo "<p>Error altering table: " . $conn->error . "</p>";
    }
} else {
    echo "<p>Designation column already exists.</p>";
}

$conn->close();
?>
