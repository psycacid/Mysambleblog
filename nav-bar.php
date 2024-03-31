<nav>
    <ul>
        <?php
        $currentPage = basename($_SERVER['PHP_SELF']);
        if ($currentPage == 'admin-index.php') {
            echo '<li><a href="admin-index.php">Home</a></li>';
            echo '<li><a href="logout.php">Logout</a></li>';
        } else {
            echo '<li><a href="index.php">Home</a></li>';
            echo '<li><a href="about.php">About Us</a></li>';
            echo '<li><a href="contact.php">Contact</a></li>';
        }
        ?>
    </ul>
</nav>
