<?php include("../../inc_header.php"); ?>

<h1>Delete Student</h1>

<?php
if (isset($_GET['id'])) {
    include("../../inc_db_params.php");

    /* change db to world db */
    mysqli_select_db($conn, $db_name);

    if ($conn !== FALSE) {
        $id = $_GET['id'];

        /* create a prepared statement */
        if ($stmt = mysqli_prepare($conn, "SELECT * FROM Students WHERE StudentId=?")) {

            /* bind parameters for markers */
            mysqli_stmt_bind_param($stmt, "s", $id);

            /* execute query */
            mysqli_stmt_execute($stmt);

            /* bind variables to prepared statement */
            mysqli_stmt_bind_result($stmt, $StudentId, $FirstName, $LastName, $School);

            /* fetch value */
            mysqli_stmt_fetch($stmt);
        }
    };

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<table>
    <tr>
        <td>Student ID:</td>
        <td><?php echo $StudentId ?></td>
    </tr>
    <tr>
        <td>First name: </td>
        <td><?php echo $FirstName ?></td>
    </tr>
    <tr>
        <td>Last name: </td>
        <td><?php echo $LastName ?></td>
    </tr>
    <tr>
        <td>School: </td>
        <td><?php echo $School ?></td>
    </tr>
</table>
<br />
<form action="process_delete.php" method="post">
    <input type="hidden" value="<?php echo $StudentId ?>" name="StudentId" />
    <a href="../list" class="btn btn-small btn-primary">&lt;&lt; BACK</a>
    &nbsp;&nbsp;&nbsp;
    <input type="submit" value="Delete" class="btn btn-danger" />
</form>

<br />


<?php include("../../inc_footer.php"); ?>