<?php
session_start(); // Ensure the session is started
$Title = "Dashboard";
// Check if the user is logged in, if not, redirect to login page
if (empty($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

// Block browser back button access to previously cached pages
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache");


include 'header.php'; 
include 'functions.php'; 

// Check if the session is still valid (to prevent direct URL access after logout)
checkUserSessionIsActive();  // Ensure this function verifies session status
verifyActiveSession();  // Ensure that the user is logged in to access the dashboard

?>
<main>
    <br>
    <div class="container d-flex justify-content-between align-items-center col-md-7">
        <h4>Welcome to the System: <?php echo $_SESSION['email']; ?></h4>
        <button onclick="window.location.href='logout.php'" class="btn btn-danger">Logout</button>
    </div>

    <!-- Register Student Card --> 
    <div class="container d-flex justify-content-between align-items-center col-md-7"> 
        <div class="container row d-flex justify-content-between align-items-right mt-5">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Register a Student</h5>
                    </div>
                    <div class="card-body">
                        <p class="justify-text-center">This section allows you to  register a new student in the system. Click the button bellow to proceed with the registration process.</p>

                        <!-- Button to proceed to register a student -->
                        <div class="d-grid gap-2">
                            <a href="student/register.php" class="btn btn-primary w-100">Register a Student</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include 'footer.php';  // Include the footer
?>