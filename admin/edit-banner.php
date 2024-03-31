<?php
// Check if the form is submitted
if (isset($_POST['create_banner'])) {
    // Retrieve the submitted banner link
    $banner_link = $_POST['banner_link'];

    // Validate the banner link (you may want to perform additional validation)
    if (filter_var($banner_link, FILTER_VALIDATE_URL)) {
        // Update the banner link in the database
        include '../dbinfo.php'; // Include database connection file

        // Update the banner link in the 'banner' table
        $update_sql = "UPDATE banner SET header_background_image = '$banner_link' WHERE id = 1"; // Assuming there's only one row in the 'banner' table
        if (mysqli_query($con, $update_sql)) {
            echo "<p>Banner link updated successfully</p>";
        } else {
            echo "<p>Error updating banner link: " . mysqli_error($con) . "</p>";
        }

        // Close the database connection
        mysqli_close($con);
    } else {
        echo "<p>Invalid banner link. Please enter a valid URL.</p>";
    }
}
?>
