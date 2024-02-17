<?php
if (isset($_POST['create'])) {
    include("../../utils.php");
    include("../../connect_database.php");
    include("../../student/Student.php");

    // Sanitize user input to escape HTML entities and filter out dangerous characters.
    $studentId = sanitize_input($_POST['StudentId']);
    $firstName = sanitize_input($_POST['FirstName']);
    $lastName = sanitize_input($_POST['LastName']);
    $school = sanitize_input($_POST['School']);

    // Initialize a new Student object
    $student = new Student($studentId, $firstName, $lastName, $school);
    // Call create method
    $result = $student->create($db);
    
    // Check if the student was created
    if ($result !== false) {
        header('Location: ../../index.php');
        exit;
    }
}
?>