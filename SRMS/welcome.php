<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Admin section.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

    <h2>From the below options choose what to do.</h2>

    <h3>For Classes</h3>
    <p>
        <a href="addclass.php" class="btn btn-warning">Add New Class</a>
        <a href="updateclass.php" class="btn btn-danger ml-3">Update Existing Class</a>
    </p>

    <h3>For Students</h3>
    <p>
        <a href="addstudent.php" class="btn btn-warning">Add New Student</a>
        <a href="updatestudent.php" class="btn btn-danger ml-3">Update Existing Student</a>
    </p>

    <h3>For Subjects</h3>
    <p>
        <a href="addsubject.php" class="btn btn-warning">Add New Subjects</a>
        <a href="updatesubject.php" class="btn btn-danger ml-3">Update Existing Subjects</a>
    </p>


    <h3>For Subject Combination</h3>
    <p>
        <a href="addsubcomb.php" class="btn btn-warning">Add New Subject Combination</a>
        <a href="updatesubcomb.php" class="btn btn-danger ml-3">Update Existing Subject Combination</a>


    <h3>For Result</h3>
    <p>
        <a href="addresult.php" class="btn btn-warning">Add New Result</a>
        <a href="updateresult.php" class="btn btn-danger ml-3">Update Existing Result</a>
    </p>
</body>
</html>