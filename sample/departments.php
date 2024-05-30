<?php
include 'DBConnector.php';

$departments = [
    'dpsm' => 1,
    'dummy' => 2,
    'ghost' => 3
];

foreach ($departments as $deptName => $deptID) {
    echo "<h2 style='color: silver;'> $deptName Department:</h2>";
    echo "<table style='width:100%'>";
    echo "<tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Salary</th>
            <th>Hire Date</th>
            <th>Position</th>
            <th>Actions</th>
          </tr>";

    $sql = "SELECT DISTINCT e.EmpID, e.EmpName, e.Age, e.Salary, e.HireDate, d.MgrEmpID
            FROM employee e 
            JOIN work w ON e.EmpID = w.EmpID 
            JOIN department d ON w.DeptID = d.DeptID
            WHERE w.DeptID = $deptID";

    $result = $conn->query($sql);

    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<tr>".
                    "<td align='center'>".$row['EmpID']."</td>".
                    "<td align='center'>".$row['EmpName']."</td>".
                    "<td align='center'>".$row['Age']."</td>".
                    "<td align='center'>".$row['Salary']."</td>".
                    "<td align='center'>".$row['HireDate']."</td>";

            if ($row["MgrEmpID"] == $row["EmpID"]) {
                echo "<td align='center'> Manager </td>";
            } else {
                echo "<td align='center'> Employee </td>";
            }

            echo "<td align='center'>".
                    "<form action='deleteEmployee.php' method='post'>".
                        "<input type='hidden' name='EmpID' value='".$row["EmpID"]."'>".
                        "<button type='submit'>Delete</button>".
                    "</form>".
                    "<form action='editEmployee.php' method='post'>".
                        "<input type='hidden' name='EmpID' value='".$row["EmpID"]."'>".
                        "<button type='submit'>Edit</button>".
                    "</form>".
                "</td>";

            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7' align='center'>N/A</td></tr>";
    }

    echo "</table><br>";
}

$conn->close();
?>
