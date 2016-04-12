<?php include '../header.php' ?>
    <main id="main">
        <h1>Database Error</h1>
        <p>There was an error connecting to the database.</p>
        <!-- show what errors occured -->
        <p>Error message: <?php echo $error_message; ?></p>
    </main><!-- end main -->
<?php include '../footer.php' ?>