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
    include("../inc_db_params.php");
    if ($conn !== FALSE) {

        $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $db_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "\n<p class='alert alert-danger'>$db_name database already exist.</p>\n";
        } else {
            $SQLstring = "CREATE DATABASE IF NOT EXISTS $db_name;";
            $QueryResult = @mysqli_query($conn, $SQLstring);
            echo "\n<p class='alert alert-success'>$db_name database created successfully</p>\n";
        }
    };

    mysqli_close($conn);
}
?>

<?php include("../inc_footer.php"); ?>
