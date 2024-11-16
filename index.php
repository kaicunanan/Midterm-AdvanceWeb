<?php
session_start(); // Start the session
$Title = "Log In";

// Redirect to dashboard if already logged in
if (!empty($_SESSION['email'])) {
    header("Location: dashboard.php");
    exit;
}

include 'header.php'; // Include the header layout
include 'functions.php'; // Include functions for validation, user retrieval, etc.

$errors = [];
$notification = null;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate inputs
    if (empty($email) || empty($password)) {
        $errors[] = 'Email and password are required.';
    } else {
        $users = getUsers(); // Retrieve users (from a database or mock data in `functions.php`)
        if (checkLoginCredentials($email, $password, $users)) {
            $_SESSION['email'] = $email; // Store email in session
            $_SESSION['current_page'] = 'dashboard.php';
            header("Location: dashboard.php");
            exit;
        } else {
            $errors[] = 'Invalid email or password.';
        }
    }

    // Prepare error notifications
    if (!empty($errors)) {
        $notification = displayErrors($errors);
    }
}
?>

<main>
    <div class="container d-flex flex-column align-items-center mt-5">
        <!-- Display notification if there are errors -->
        <?php if (!empty($notification)): ?>
            <div class="col-md-4 mb-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>System Errors:</strong>
                    <?php echo $notification; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-md-4">
            <!-- Login Form Card -->
            <div class="card">
                <div class="card-header text-center">
                    <h5>Login</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>