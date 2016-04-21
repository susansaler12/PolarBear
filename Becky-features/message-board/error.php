<?php include '../header.php' ?>
    <main id="main">
        <section class="section error">
            <h1>Message Board</h1>
            <h2 class="top">Error</h2>
            <p><?php echo $error; ?></p>
            <form action="addMessageForm.php">
                <input class="btn" type="submit" value="Post New Message">
            </form>
        </section>
    </main>
<?php include '../footer.php' ?>