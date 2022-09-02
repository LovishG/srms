<!-- here we are going to add student info in the database -->
<?php
echo "welcome to students data adding page <br>";
// connecting to database
$servername = "localhost";
$username = "root";
$password = "";
$database = "srms";

// creating a connection
$conn = mysqli_connect($servername, $username, $password, $database);
echo "connecton successsful";

//variables
$studentid =6;
$studentName = 'antonio';
$Email = 'ko@gmail.com';
$Gender = 'male';
$Contactno = 8432569443;
$Physics = 51;
$Chemistry =51;
$Maths = 51;
$English = 51;
$Additional = 51;

// sql query to be executed
$sql = "INSERT INTO `students` (`StudentId`, `StudentName`, `E-mail`, `Gender`, `ContactNo`, `Physics`, `Chemistry`, `Maths`, `English`, `Additional`) VALUES ('$studentid', '$studentName', '$Email',' $Gender', '$Contactno', '$Physics', '$Chemistry', '$Maths', '$English', '$Additional');"; 


// execute the sql query
$result = mysqli_query($conn, $sql);

// check if query was successfully executed.

if($result){
    echo "the record/data has been inserted successfully. <br>";
}
else{
    echo "the record/data was not inserted successfully because of this error ----> " . mysqli_error($conn);
}
?>