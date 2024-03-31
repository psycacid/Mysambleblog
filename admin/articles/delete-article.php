<?php
include '../../dbinfo.php';

if(isset($_POST['delete_article'])) {
    $id = $_POST['delete_article'];
    $delete_sql = "DELETE FROM articles WHERE id=$id";
    mysqli_query($con, $delete_sql);
    // Redirect back to the referring page after deletion
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}
?>
