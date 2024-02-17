<?php
include("../../utils.php");
include("../../connect_database.php");
include("../../student/Student.php");

if (isset($_POST['StudentId'])) {

    $studentId = $_POST['StudentId'];

    // Use the static method to delete the student
    $result = Student::delete($db, $studentId);

    // Check if the student was deleted
    if ($result === true) {
        header('Location: ../../index.php');
        exit;
    } else {
        header("Location: delete.php?id=" . urlencode($studentId) . "&error=" . urlencode($result));
        exit;
    }
}
?>