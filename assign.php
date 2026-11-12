<?php
include "db.php";

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $emp_id = trim($_POST["emp_id"] ?? "");
    $project_id = trim($_POST["project_id"] ?? "");
    $role = trim($_POST["role"] ?? "");
    $assigned_date = trim($_POST["assigned_date"] ?? "");

    if ($emp_id === "" || $project_id === "" || $role === "" || $assigned_date === "") {
        $message = "Please complete all fields.";
        $message_type = "error";
    } else {
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO assignment (emp_id, project_id, role, assigned_date)
             VALUES (?, ?, ?, ?)"
        );

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $emp_id, $project_id, $role, $assigned_date);

            if (mysqli_stmt_execute($stmt)) {
                $message = "Assignment saved successfully!";
                $message_type = "success";
            } else {
                $message = "Could not save the assignment. Please check the selected employee and project.";
                $message_type = "error";
            }
            mysqli_stmt_close($stmt);
        } else {
            $message = "Unable to prepare the database query.";
            $message_type = "error";
        }
    }
}

$employees = mysqli_query($conn, "SELECT emp_id, name, designation FROM employee ORDER BY name");
$projects = mysqli_query($conn, "SELECT project_id, project_name, client FROM project ORDER BY project_name");

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Project Assignment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main class="container">
        <h1>Employee Project Assignment</h1>
        <p class="subtitle">Assign an employee to a project.</p>

        <?php if ($message !== ""): ?>
            <div class="message <?php echo e($message_type); ?>">
                <?php echo e($message); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="assign.php">
            <label for="emp_id">Select Employee</label>
            <select name="emp_id" id="emp_id" required>
                <option value="">-- Choose an employee --</option>
                <?php if ($employees): ?>
                    <?php while ($employee = mysqli_fetch_assoc($employees)): ?>
                        <option value="<?php echo e($employee["emp_id"]); ?>"
                            <?php echo (($_POST["emp_id"] ?? "") === $employee["emp_id"]) ? "selected" : ""; ?>>
                            <?php echo e($employee["name"]); ?> (<?php echo e($employee["designation"]); ?>)
                        </option>
                    <?php endwhile; ?>
                <?php endif; ?>
            </select>

            <label for="project_id">Select Project</label>
            <select name="project_id" id="project_id" required>
                <option value="">-- Choose a project --</option>
                <?php if ($projects): ?>
                    <?php while ($project = mysqli_fetch_assoc($projects)): ?>
                        <option value="<?php echo e($project["project_id"]); ?>"
                            <?php echo (($_POST["project_id"] ?? "") === $project["project_id"]) ? "selected" : ""; ?>>
                            <?php echo e($project["project_name"]); ?> - <?php echo e($project["client"]); ?>
                        </option>
                    <?php endwhile; ?>
                <?php endif; ?>
            </select>

            <label for="role">Role</label>
            <input type="text" name="role" id="role" maxlength="100"
                   value="<?php echo e($_POST["role"] ?? ""); ?>"
                   placeholder="Example: Developer" required>

            <label for="assigned_date">Assigned Date</label>
            <input type="date" name="assigned_date" id="assigned_date"
                   value="<?php echo e($_POST["assigned_date"] ?? ""); ?>" required>

            <button type="submit">Submit Assignment</button>
        </form>

        <p class="nav-link"><a href="report.php">View Assignment Report</a></p>
    </main>
</body>
</html>
