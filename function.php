<?php


function getUsers() {
    return [
        ["email" => "kai1@gmail.com", "password" => "kai1"],
        ["email" => "kai2@gmail.com", "password" => "kai2"],
        ["email" => "kai3@gmail.com", "password" => "kai3"],
        ["email" => "kai4@gmail.com", "password" => "kai4"],
        ["email" => "kai5@gmail.com", "password" => "kai5"]
    ];
}

function validateLoginCredentials($email, $password) {
    $errors = [];

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid Email.";
    } else {
        // Check if email exists in the getUsers() array
        $users = getUsers();
        $emailExists = false;
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $emailExists = true;
                break;
            }
        }

        if (!$emailExists) {
            $errors[] = "Invalid Email.";
        }
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    return $errors;
}


function checkLoginCredentials($email, $password, $users) {
    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            return true;
        }
    }
    return false;
}

function checkUserSessionIsActive() {
    // Only redirect if the user is already logged in and trying to access the login page
    if (isset($_SESSION['email']) && basename($_SERVER['PHP_SELF']) == 'index.php') {

        header("Location: dashboard.php");
        exit;
    }
}



function verifyActiveSession(){
    if (empty($_SESSION['email']) && basename($_SERVER['PHP_SELF']) != 'index.php') {

        header("Location: index.php"); 
        exit;
    }
}


function displayErrors($errors) {
    // <strong class='alert alert-danger'>System Errors</strong>
    $output = "<ul>";
    foreach ($errors as $error) {
        $output .= "<li>" . htmlspecialchars($error) . "</li>";
    }
    $output .= "</ul>";
    return $output;
}




function renderErrorsToView($error) {
    if (empty($error)) {
        return null;
    }
    return "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                $error
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
}

function getBaseURL() {
    return 'http://' . $_SERVER['HTTP_HOST'] . '/midterms';
}

function checkDuplicateStudentData($student_data) {
    // Check if the student_id already exists in the session
    if (!empty($_SESSION['student_data'])) {
        foreach ($_SESSION['student_data'] as $existing_student) {
            if ($existing_student['student_id'] === $student_data['student_id']) {
                return $existing_student; // Return the existing student if there's a match
            }
        }
    }
    return null; // Return null if no duplicate is found
}

function validateStudentData($student_data) {
    $errors = [];

    // Check if student ID is provided
    if (empty($student_data['student_id'])) {
        $errors[] = "Student ID is required.";
    }

    // Check if first name is provided
    if (empty($student_data['first_name'])) {
        $errors[] = "First Name is required.";
    }

    // Check if last name is provided
    if (empty($student_data['last_name'])) {
        $errors[] = "Last Name is required.";
    }

    // Optional: Add more validation rules as needed (e.g., length check, format validation)
    return $errors;
}

function getSelectedStudentIndex($student_id) {
    if (!empty($_SESSION['student_data'])) {
        foreach ($_SESSION['student_data'] as $index => $student) {
            if ($student['student_id'] === $student_id) {
                return $index; // Return index if found
            }
        }
    }
    return null; // Return null if student_id not found
}

// Function to get a student's data by index
function getSelectedStudentData($index) {
    if (isset($_SESSION['student_data'][$index])) {
        return $_SESSION['student_data'][$index];
    }
    return false;
}


?>