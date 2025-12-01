<?php
include "db.php";

if(isset($_GET['id'])){
    $id = intval($_GET['id']); // make sure it's an integer
    $conn->query("DELETE FROM medicines WHERE id=$id");
    // Redirect back with alert
    echo "<script>alert('Medicine deleted successfully!'); window.location='index.php';</script>";
    exit;
} else {
    echo "<script>alert('Invalid ID'); window.location='index.php';</script>";
    exit;
}
?>
