<?php
include 'DBConnector.php';

// Function to fetch and display employee data
function displayEmployeeData($sql, $conn) {
    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $empID = $row["EmpID"];
            $sql_get_EmployeeData = "SELECT EmpName, Age, Salary, HireDate FROM employee WHERE EmpID = '$empID'";
            $employeeDataResult = $conn->query($sql_get_EmployeeData);

            if ($employeeDataResult && $employeeDataResult->num_rows > 0) {
                $employeeData = $employeeDataResult->fetch_assoc();
                echo "<tr>".
                        "<td align='center'>".$row["EmpID"]."</td>".
                        "<td align='center'>".$employeeData['EmpName']."</td>".
                        "<td align='center'>".$employeeData['Age']."</td>".
                        "<td align='center'>".$employeeData['Salary']."</td>".
                        "<td align='center'>".$employeeData['HireDate']."</td>";

                // Check if the employee is a manager
                if (isset($row["MgrEmpID"])) {
                    $mgrID = $row["MgrEmpID"];
                    $sql_get_ManagerData = "SELECT EmpName FROM employee WHERE EmpID = '$mgrID'";
                    $managerDataResult = $conn->query($sql_get_ManagerData);
                    if ($managerDataResult && $managerDataResult->num_rows > 0) {
                        echo "<td align='center'> Manager </td>";
                    } else {
                        echo "<td align='center'> Employee </td>";
                    }
                } else {
                    echo "<td align='center'> Test </td>";
                }
                echo "</tr>";
            } else {
                // Employee data not found or query failed
                echo "<tr>".
                        "<td align='center'>".$row["EmpID"]."</td>".
                        "<td align='center'>N/A</td>".
                        "<td align='center'>N/A</td>".
                        "<td align='center'>N/A</td>".
                        "<td align='center'>N/A</td>".
                        "<td align='center'> Employee </td>";
                echo "</tr>";
            }
        }
    }
    else{
        echo "0 results";
    }
}

// Display data for Department 1
echo "<h2>Department 1</h2>";
$sql_dept1 = "SELECT * FROM work WHERE DeptID = 1";
displayEmployeeData($sql_dept1, $conn);

// Display data for Department 2
echo "<h2>Department 2</h2>";
$sql_dept2 = "SELECT * FROM work WHERE DeptID = 2";
displayEmployeeData($sql_dept2, $conn);

// Display data for Department 3
echo "<h2>Department 3</h2>";
$sql_dept3 = "SELECT * FROM work WHERE DeptID = 3";
displayEmployeeData($sql_dept3, $conn);

$conn->close();
?>
