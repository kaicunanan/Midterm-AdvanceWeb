<?php
    session_start();
    $Title = "Delete";
    include '../header.php';
    include '../functions.php';
    //guard();  // Protect the page to ensure only logged-in users can access

    // Retrieve student data using index from session or redirect if not found
    if (isset($_GET['index'])) {
        $index = $_GET['index'];

        // Get the student data by index
        $student = getSelectedStudentData($index);
        if (!$student) {
            header("Location: register.php");  // Redirect if student not found
            exit;
        }
    } else {
        header("Location: register.php");  // Redirect if no index provided
        exit;
    }

    // Handle form submission to delete student data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Delete student from the session data
        unset($_SESSION['student_data'][$index]);
        header("Location: register.php");  // Redirect after deleting
        exit;
    }
?>

<main>
    <div class="container justify-content-between align-items-center col-6">
        
        <h3 class=" mt-4">Delete a Student</h3>

            <!-- breadcrumb -->
    <div class="w-100 mt-5">
        <div class="container justify-content-between align-items-center bg-light p-2 border r-4 ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="register.php">Register Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Delete Student</li>
                </ol>
            </nav>
        </div>
    </div>


        <div class=" border border-secondary-1 p-4 mt-3">
            <!-- Confirm Deletion Form -->
            <form method="POST" action="">
                <div class="mb-2">
                              
                    <label class="form-label">Are you sure you want to delete the following student record?</label> 
                        <ul style="list-style-type:disc;">
                            <li><strong>Student ID:</strong> <?php echo htmlspecialchars($student['student_id']); ?></li>
                            <li><strong>First Name:</strong> <?php echo htmlspecialchars($student['first_name']); ?></li>
                            <li><strong>Last Name:</strong> <?php echo htmlspecialchars($student['last_name']); ?></li>
                        </ul>
                    
                    <!-- Buttons for Submit and Cancel -->
                    <div>
                        <a href="register.php" class="btn btn-secondary btn-sm">Cancel</a> <!-- Cancel button with gray background -->
                        <button type="submit" class="btn btn-primary btn-sm">Delete Student Record</button> <!-- Delete button -->
                    </div>  
                </div>
            
            </form>
        </div>
    </div>
</main>

<?php
    include '../footer.php';
?>