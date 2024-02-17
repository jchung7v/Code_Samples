<?php include("../inc_header.php"); ?>

<h1>Create School Database</h1>
<p>Click on the below button to create a database named School.</p>

<form action="/create_db/index.php" method="POST">
<p>
    <a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="Submit" name="Submit" value="Create Database" class="btn btn-small btn-success"/>
</p>
</form>

<?php
if (isset($_POST['Submit'])) {
    
    $db_path = '../school.db';
    $db_exists = file_exists($db_path);

    if (!$db_exists) {
        $conn = new SQLite3($db_path);
        echo "\n<p class='alert alert-success'>Database created successfully.</p>\n";
    } else {
        echo "\n<p class='alert alert-danger'>The database already exists.</p>\n";
    }
}
?>

<?php include("../inc_footer.php"); ?>
