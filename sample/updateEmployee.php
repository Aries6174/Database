<?php
include 'DBConnector.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if EmpID is set and not empty
    if (isset($_POST["EmpID"]) && !empty($_POST["EmpID"])) {
        $empID = $_POST["EmpID"];

        // Collect other form data
        $name = $_POST["name"];
        $age = $_POST["age"];
        $salary = $_POST["salary"];
        $date_hired = $_POST["date_hired"];

        // Prepare and execute SQL query to update employee details
        $sql = "UPDATE employee SET EmpName = '$name', Age = '$age', Salary = '$salary', HireDate = '$date_hired' WHERE EmpID = '$empID'";

        if ($conn->query($sql) === TRUE) {
            echo "Employee details updated successfully";
        } else {
            echo "Error updating employee details: " . $conn->error;
        }
    } else {
        echo "Employee ID is missing.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
