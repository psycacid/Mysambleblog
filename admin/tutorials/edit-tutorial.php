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
    <title>Edit Tutorial</title>
    <link rel="stylesheet" href="../../style/admin.css">
</head>
<body>
<header style="background-image: url('<?php echo $background_image_url; ?>');">
    <h1>Assignment 2 - Dynamic Blog</h1>
    <?php include '../../nav-bar.php'; ?>
</header>

<div style="margin: 50px;">
    <h2>Edit Tutorial</h2>
    <?php
    include '../../dbinfo.php';

    if(isset($_POST['edit_tutorial'])) {
        $id = $_POST['tutorial_id'];
        $sql = "SELECT * FROM tutorials WHERE id=$id";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<form action='".$_SERVER['PHP_SELF']."' method='post'>";
            echo "<input type='hidden' name='tutorial_id' value='".$row['id']."'>";
            echo "<label for='title'>Title:</label>";
            echo "<input type='text' id='title' name='title' value='".$row['title']."' required><br>";
            echo "<label for='description'>Description:</label>";
            echo "<textarea id='description' name='description' required>".$row['description']."</textarea><br>";
            echo "<button type='submit' name='update_tutorial'>Update Tutorial</button>";
            echo "</form>";
        }
    }

    if(isset($_POST['update_tutorial'])) {
        $id = $_POST['tutorial_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $update_sql = "UPDATE tutorials SET title='$title', description='$description' WHERE id=$id";
        if(mysqli_query($con, $update_sql)) {
            echo "<p>Tutorial updated successfully</p>";
        } else {
            echo "<p>Error updating tutorial: " . mysqli_error($con) . "</p>";
        }
    }

    mysqli_close($con);
    ?>
</div>

</body>
</html>
