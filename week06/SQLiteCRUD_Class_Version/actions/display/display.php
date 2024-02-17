<?php
include("../../inc_header.php");
include("../../utils.php");
include("../../connect_database.php");
include("../../student/Student.php");

echo "<h1>Display Student</h1>";

if (isset($_GET['id'])) {

    // Sanitize user input to escape HTML entities and filter out dangerous characters.
    $id = sanitize_input($_GET['id']);

    // Fetch student details
    $studentDetails = Student::read($db, $id);

    // If student does not exist, display error message
    if ($studentDetails === null) {
        echo "<p class='alert alert-danger'>Student with ID $id does not exist.</p>";
    } else {
        echo "<table>
                <tr>
                    <td>Student ID:</td>
                    <td>{$studentDetails['StudentId']}</td>
                </tr>
                <tr>
                    <td>First name:</td>
                    <td>{$studentDetails['FirstName']}</td>
                </tr>
                <tr>
                    <td>Last name:</td>
                    <td>{$studentDetails['LastName']}</td>
                </tr>
                <tr>
                    <td>School:</td>
                    <td>{$studentDetails['School']}</td>
                </tr>
                </table>";
    }

    echo "<br /><a href='../../index.php' class='btn btn-small btn-primary'>&lt;&lt; BACK</a>";
}

$db->close();
include("../../inc_footer.php");
?>


