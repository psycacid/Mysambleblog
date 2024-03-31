<?php
include '../dbinfo.php';

$background_image_query = "SELECT header_background_image FROM banner WHERE id = 1"; 
$background_image_result = mysqli_query($con, $background_image_query);
$background_image_row = mysqli_fetch_assoc($background_image_result);
$background_image_url = $background_image_row['header_background_image'];

$tutorials_sql = "SELECT * FROM tutorials";
$tutorials_result = mysqli_query($con, $tutorials_sql);

$articles_sql = "SELECT * FROM articles";
$articles_result = mysqli_query($con, $articles_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../style/admin.css">
</head>
<body>
<header style="background-image: url('<?php echo $background_image_url; ?>');">
    <h1>Assignment 2 - Dynamic Blog</h1>
    <?php include '../nav-bar.php'; ?>
</header>

<div style="margin: 50px;">
    <h2>List of Tutorials</h2>
    <table> 
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($tutorials_result) > 0) {
                while ($row = mysqli_fetch_assoc($tutorials_result)) {
                    echo "<tr>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>
                        <form method='post' action='tutorials/edit-tutorial.php'>
                            <input type='hidden' name='tutorial_id' value='".$row['id']."'>
                            <button type='submit' name='edit_tutorial'>Edit</button>
                        </form>
                        <form method='post' action='tutorials/delete-tutorial.php'>
                            <input type='hidden' name='delete_tutorial' value='".$row['id']."'>
                            <button type='submit' name='delete'>Delete</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No tutorials found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Create Tutorial</h2>
    <form action="tutorials/add-tutorial.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea><br>
        <button type="submit" name="create_tutorial">Create Tutorial</button>
    </form>

    <h2>List of Articles</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($articles_result) > 0) {
                while ($row = mysqli_fetch_assoc($articles_result)) {
                    $truncated_content = substr($row['content'], 0, 100) . "...";
                    echo "<tr>";
                    echo "<td>" . $row['title'] . "</td>";
                    echo "<td>" . $truncated_content . "</td>";
                    echo "<td>
                        <form method='post' action='articles/edit-article.php'>
                            <input type='hidden' name='article_id' value='".$row['id']."'>
                            <button type='submit' name='edit_article'>Edit</button>
                        </form>
                        <form method='post' action='articles/delete-article.php'>
                            <input type='hidden' name='delete_article' value='".$row['id']."'>
                            <button type='submit' name='delete'>Delete</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No articles found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Create Article</h2>
    <form action="articles/add-article.php" method="post">
        <label for="article_title">Title:</label>
        <input type="text" id="article_title" name="article_title" required><br>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea><br>
        <button type="submit" name="create_article">Create Article</button>
    </form>

    <h2>Create Banner</h2>
    <form action="edit-banner.php" method="post">
        <label for="banner_link">Banner Link:</label>
        <input type="text" id="banner_link" name="banner_link" required><br>
        <button type="submit" name="create_banner">Submit Banner Link</button>
    </form>
</div>
</body>
</html>
