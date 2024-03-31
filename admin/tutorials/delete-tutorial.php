<?php
include '../../dbinfo.php';

if(isset($_POST['delete_tutorial'])) {
    $id = $_POST['delete_tutorial'];
    $delete_sql = "DELETE FROM tutorials WHERE id=$id";
    mysqli_query($con, $delete_sql);
    // Redirect back to the referring page after deletion
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}
?>
