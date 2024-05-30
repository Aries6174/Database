<?php
include 'DBConnector.php';

// Function to get employee details by EmpID
function getEmployeeDetails($conn, $empID)
{
    $sql = "SELECT * FROM employee WHERE EmpID = $empID";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if EmpID is set and not empty
    if (isset($_POST["EmpID"]) && !empty($_POST["EmpID"])) {
        $empID = $_POST["EmpID"];

        // Get employee details
        $employeeDetails = getEmployeeDetails($conn, $empID);

        if ($employeeDetails) {
            // Display edit form with employee details
            echo "<!DOCTYPE html>
                <html>
                <head>
                    <style>
                        body {
                            font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
                        }
                    </style>
                </head>
                <body>
                    <h2>Edit Employee</h2>
                    <form action='updateEmployee.php' method='post'>
                        <input type='hidden' name='EmpID' value='" . $employeeDetails["EmpID"] . "'>
                        <label>Name:</label>
                        <input type='text' name='name' value='" . $employeeDetails["EmpName"] . "'><br>
                        <label>Age:</label>
                        <input type='number' name='age' value='" . $employeeDetails["Age"] . "'><br>
                        <label>Salary:</label>
                        <input type='number' step='.01' name='salary' value='" . $employeeDetails["Salary"] . "'><br>
                        <label>Date Hired:</label>
                        <input type='date' name='date_hired' value='" . $employeeDetails["HireDate"] . "'><br>
                        <input type='submit' value='Submit'>
                        <button type='button' onclick='window.location.href=\"employees.php\"'>Cancel</button>
                        <button type='button' onclick='window.location.href=\"employees.php\"'>Back to Employees</button>
                    </form>
                </body>
                </html>";
        } else {
            echo "Employee details not found.";
        }
    } else {
        echo "Employee ID is missing.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
