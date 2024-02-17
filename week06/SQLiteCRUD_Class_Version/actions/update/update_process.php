<?php
include("../../utils.php");
include("../../connect_database.php");
include("../../student/Student.php");

if (isset($_POST['update'])) {
    // Sanitize user input to escape HTML entities and filter out dangerous characters.
    $studentId = sanitize_input($_POST['StudentId']);
    $firstName = sanitize_input($_POST['FirstName']);
    $lastName = sanitize_input($_POST['LastName']);
    $school = sanitize_input($_POST['School']);

    // Initialize a new Student object
    $student = new Student($studentId, $firstName, $lastName, $school);
    // Call update method
    $result = $student->update($db);
    
    // Check if the student was updated
    if ($result === true) {
        header('Location: ../../index.php');
        exit;
    } else {
        header("Location: update.php?id=" . urlencode($studentId) . "&error=" . urlencode($result));
        exit;
    }
}
?>