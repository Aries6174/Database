<?php

include 'DBConnector.php';

$name = $_GET["name"];
$age = $_GET["age"];
$salary = $_GET["salary"];
$HireDate = $_GET["date_hired"]; // Corrected variable name
$DeptID = $_GET["department"];
$Percent_Time = $_GET["percent_time"];

$sql = "INSERT INTO `employee` (`EmpID`, `EmpName`, `Age`, `Salary`, `HireDate`) VALUES (NULL, '$name', '$age', '$salary', '$HireDate')"; // Removed unnecessary semicolon

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    header("Location: employee.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
