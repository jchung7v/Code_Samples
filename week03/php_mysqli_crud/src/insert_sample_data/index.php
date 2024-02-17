<?php include("../inc_header.php"); ?>

<h1>Create Sample Data</h1>
<p>Click on the below button to Insert sample Students data.</p>

<form action="/insert_sample_data/index.php" method="POST">
<p>
    <a href="/" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="Submit" name="Submit" value="Insert data" class="btn btn-small btn-success"/>
</p>
</form>

<?php
if (isset($_POST['Submit'])) {
    include("../inc_db_params.php");
    mysqli_select_db($conn, $db_name);

    if ($conn !== FALSE) {
        $TableName = "Students";

        # only proceed if table is empty
        $result = mysqli_query($conn, "SELECT COUNT(*) AS 'count' FROM $TableName");
        $count = $result->fetch_object()->count;
    
        if ($count == 0) { 
            $SQLstring = "INSERT INTO $TableName (StudentId, FirstName, LastName, School) 
            VALUES 
            ('A00111111', 'Tom', 'Max', 'Science'),
            ('A00222222', 'Ann', 'Fay', 'Mining'),
            ('A00333333', 'Joe', 'Sun', 'Nursing'),
            ('A00444444', 'Sue', 'Fox', 'Computing'),
            ('A00555555', 'Ben', 'Ray', 'Mining')
            ";
            $QueryResult = mysqli_query($conn, $SQLstring);
            $rowcount=mysqli_affected_rows($conn);
            printf("<p class='alert alert-success'>%d records were inserted.</p>\n", $rowcount);
        } else {
            printf("<p class='alert alert-danger'>$TableName table already contains sample data</p>\n");
        }

        $conn->close();
    }
}
?>

<?php include("../inc_footer.php"); ?>