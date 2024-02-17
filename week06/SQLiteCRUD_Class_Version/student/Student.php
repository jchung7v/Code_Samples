<?php

class Student {
    public $studentId;
    public $firstName;
    public $lastName;
    public $school;

    public function __construct($studentId, $firstName, $lastName, $school) {
        $this->studentId = $studentId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->school = $school;
    }

    public function create($db) {
        // Check if student ID already exists
        $checkStmt = $db->prepare("SELECT COUNT(*) AS rowCount FROM Students WHERE StudentId = ?");
        $checkStmt->bindParam(1, $this->studentId, SQLITE3_TEXT);
        $result = $checkStmt->execute();
        $rowCount = $result->fetchArray(SQLITE3_NUM)[0];

        // If student ID already exists, return error message
        if ($rowCount > 0) {
            return 'Student ID already exists';
        }

        // Check if student ID is longer than 10 characters
        if (strlen($this->studentId) > 10) {
            return 'Student ID should not be longer than 10 characters';
        }

        // Insert new student into database
        $insertStmt = $db->prepare("INSERT INTO Students (StudentId, FirstName, LastName, School) VALUES (:StudentId, :FirstName, :LastName, :School)");
        $insertStmt->bindValue(':StudentId', $this->studentId, SQLITE3_TEXT);
        $insertStmt->bindValue(':FirstName', $this->firstName, SQLITE3_TEXT);
        $insertStmt->bindValue(':LastName', $this->lastName, SQLITE3_TEXT);
        $insertStmt->bindValue(':School', $this->school, SQLITE3_TEXT);
        $result = $insertStmt->execute();

        // If student was not created, return error message
        if ($result === false) {
            return 'Error creating student.';
        }

        return true;
    }

    public static function delete($db, $studentId) {
        // Check if student exists
        $checkStmt = $db->prepare("SELECT COUNT(*) FROM Students WHERE StudentId = ?");
        $checkStmt->bindParam(1, $studentId, SQLITE3_TEXT);
        $result = $checkStmt->execute()->fetchArray(SQLITE3_NUM);

        // If student does not exist, return error message
        if ($result[0] == 0) {
            return 'Student with ID ' . $studentId . ' does not exist.';
        }

        // If student exists, delete student
        $deleteStmt = $db->prepare("DELETE FROM Students WHERE StudentId = :StudentId");
        $deleteStmt->bindValue(':StudentId', $studentId, SQLITE3_TEXT);
        $result = $deleteStmt->execute();

        if ($result === false) {
            return 'Error deleting student.';
        }

        return true;
    }

    public static function read($db, $studentId) {

        // Fetch student details
        $stmt = $db->prepare("SELECT * FROM Students WHERE StudentId = ?");
        $stmt->bindParam(1, $studentId, SQLITE3_TEXT);
        $result = $stmt->execute();

        // If student does not exist, return null
        $row = $result->fetchArray(SQLITE3_ASSOC);
        if (!$row) {
            return null; 
        }

        return $row; 
    }

    public function update($db) {

        // Check if student exists
        $SQL_update_data = $db->prepare("UPDATE Students SET FirstName = :FirstName, LastName = :LastName, School = :School WHERE StudentId = :StudentId");
        
        // Bind parameters
        $SQL_update_data->bindValue(':StudentId', $this->studentId, SQLITE3_TEXT);
        $SQL_update_data->bindValue(':FirstName', $this->firstName, SQLITE3_TEXT);
        $SQL_update_data->bindValue(':LastName', $this->lastName, SQLITE3_TEXT);
        $SQL_update_data->bindValue(':School', $this->school, SQLITE3_TEXT);
        
        // Execute SQL statement
        $result = $SQL_update_data->execute();
        
        if ($result === false) {
            return 'Error updating student.';
        }
    
        return true;
    }


  }
?>

