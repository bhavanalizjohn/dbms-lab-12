<?php
include "db.php";

$sql = "SELECT employee.name AS employee_name,
               employee.designation,
               project.project_name,
               assignment.role,
               assignment.assigned_date
        FROM assignment
        INNER JOIN employee ON assignment.emp_id = employee.emp_id
        INNER JOIN project ON assignment.project_id = project.project_id
        ORDER BY assignment.assign_id DESC";

$result = mysqli_query($conn, $sql);

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Report</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container wide">
        <h1>Employee Project Assignment Report</h1>
        <p class="subtitle">Report generated from the employee, project and assignment tables.</p>

        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Designation</th>
                            <th>Project Name</th>
                            <th>Role</th>
                            <th>Assigned Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo e($row["employee_name"]); ?></td>
                                <td><?php echo e($row["designation"]); ?></td>
                                <td><?php echo e($row["project_name"]); ?></td>
                                <td><?php echo e($row["role"]); ?></td>
                                <td><?php echo e($row["assigned_date"]); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="empty">No assignments have been entered yet. Use the entry form to add an assignment.</p>
        <?php endif; ?>

        <p class="nav-link"><a href="assign.php">Back to Assignment Form</a></p>
    </main>
</body>
</html>
