<?php include 'header.php' ?>
    <main id="main" class="container">
        <div class="col-md-6 col-md-offset-3">
            <h1>Message Board: Error</h1>
            <p><?php echo $error; ?></p>
            <div class="form-group">
                <a href="addMessageForm.php" class="btn btn-info btn-block" role="button">Post New Message</a>
                <a href="messageIndex.php" class="btn btn-default btn-block">Cancel</a>
            </div>
        </div>
    </main>
<?php include 'footer.php' ?>