
<?php
// Include the database connection file
include '../../dbinfo.php';


// Fetch the background image URL from the database
$background_image_query = "SELECT header_background_image FROM banner WHERE id = 1"; 
$background_image_result = mysqli_query($con, $background_image_query);
$background_image_row = mysqli_fetch_assoc($background_image_result);
$background_image_url = $background_image_row['header_background_image'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Article</title>
    <link rel="stylesheet" href="../../style/admin.css">
</head>
<body>
<header style="background-image: url('<?php echo $background_image_url; ?>');">
    <h1>Assignment 2 - Dynamic Blog</h1>
    <?php include '../../nav-bar.php'; ?>
</header>

<div style="margin: 50px;">
    <h2>Edit Article</h2>
    <?php
    include '../../dbinfo.php';

    if(isset($_POST['edit_article'])) {
        $id = $_POST['article_id'];
        $sql = "SELECT * FROM articles WHERE id=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
            echo "<input type='hidden' name='article_id' value='".$row['id']."'>";
            echo "<label for='title'>Title:</label>";
            echo "<input type='text' id='title' name='title' value='".$row['title']."' required><br>";
            echo "<label for='content'>Content:</label>";
            echo "<textarea id='content' name='content' required>".$row['content']."</textarea><br>";
            echo "<button type='submit' name='update_article'>Update Article</button>";
            echo "</form>";
        }
    }

    if(isset($_POST['update_article'])) {
        $id = $_POST['article_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $update_sql = "UPDATE articles SET title=?, content=? WHERE id=?";
        $stmt = mysqli_prepare($con, $update_sql);
        mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $id);
        if(mysqli_stmt_execute($stmt)) {
            // Redirect back to the admin page after successful update
            header("Location: ../admin-index.php");
            exit();
        } else {
            echo "<p>Error updating article: " . mysqli_error($con) . "</p>";
        }
    }

    mysqli_close($con);
    ?>
</div>

</body>
</html>
