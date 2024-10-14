<?php
include 'database/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM pendaftar WHERE id = '$id'";
    $query = mysqli_query($db, $sql);

    if ($query) {
        header('Location: dashboard-admin.php'); // redirect back to admin page
        exit;
    } else {
        echo "Error deleting data: " . mysqli_error($db);
    }
} else {
    echo "No ID provided";
}
?>