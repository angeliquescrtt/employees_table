<?php
include_once 'db.php'; // Assuming db.php contains the database connection logic

if (isset($_GET["id"])) {
    $employee_Id = mysqli_real_escape_string($conn, $_GET["id"]);
    
    if (isset($_GET['confirmed']) && $_GET['confirmed'] == 'true') {
        // If confirmed, proceed with deletion
        $sql = "DELETE FROM employees WHERE employee_Id = $employee_Id";

        if (mysqli_query($conn, $sql)) {
            // Deletion successful
            mysqli_close($conn);
            header("Location: employees.php"); // Redirect to dashboard after deletion
            exit();
        } else {
            // Error occurred during deletion
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        // Confirmation dialog
        echo '<script>
            if (confirm("Are you sure you want to delete this employee?")) {
                window.location.href = "employees_delete.php?id=' . $employee_Id . '&confirmed=true";
            } else {
                window.location.href = "employees.php";
            }
        </script>';
    }
} else {
    echo "No employee ID provided.";
}
?>
