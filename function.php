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
function displayErrors($errors) {
    // <strong class='alert alert-danger'>System Errors</strong>
    $output = "<ul>";
    foreach ($errors as $error) {
        $output .= "<li>" . htmlspecialchars($error) . "</li>";
    }
    $output .= "</ul>";
    return $output;
}
?>