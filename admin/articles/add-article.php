<?php
include '../../dbinfo.php';

if (isset($_POST['create_article'])) {
    $title = $_POST['article_title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO articles (title, content) VALUES ('$title', '$content')";

    if (mysqli_query($con, $sql)) {
        mysqli_close($con);
        header("Location: ../admin-index.php"); // Redirect to admin.php after successful creation
        exit(); // Ensure no further code is executed after redirection
    } else {
        echo "<p>Error: " . $sql . "<br>" . mysqli_error($con) . "</p>";
    }
}
?>
