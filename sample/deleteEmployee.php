<?php
include 'DBConnector.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if EmpID is set and not empty
    if (isset($_POST["EmpID"]) && !empty($_POST["EmpID"])) {
        $empID = $_POST["EmpID"];

        // Prepare SQL statement to delete employee from database
        $sql = "DELETE FROM employee WHERE EmpID = $empID";

        if ($conn->query($sql) === TRUE) {
            // Redirect to index.php after successful deletion
            header("Location: index.php");
            exit();
        } else {
            echo "Error deleting employee: " . $conn->error;
        }
    } else {
        echo "Employee ID is missing.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
