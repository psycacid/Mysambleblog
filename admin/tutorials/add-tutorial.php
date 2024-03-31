<?php
include '../../dbinfo.php';

if (isset($_POST['create_tutorial'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $sql = "INSERT INTO tutorials (title, description) VALUES ('$title', '$description')";

    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        header("Location: ../admin-index.php"); // Redirect to admin.php after successful creation
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "<p>Error: " . $sql . "<br>" . mysqli_error($con) . "</p>";
    }
}
?>
