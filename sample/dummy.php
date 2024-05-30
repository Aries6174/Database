<?php
include 'DBConnector.php';

$sql = "SELECT * FROM work WHERE DeptID = 2"; // Change DeptID from 1 to 2
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

            if (isset($row["MgrEmpID"])) {
                $mgrID = $row["MgrEmpID"];
                if ($mgrID == $empID) {
                    echo "<td align='center'> Manager </td>";
                } else {
                    echo "<td align='center'> Employee </td>";
                }
            } else {
                echo "<td align='center'> Employee </td>"; // Default to Employee if MgrEmpID is not set
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

$conn->close();
?>
