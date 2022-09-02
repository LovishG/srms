<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<!-- FORM TO GET STUDENT ID FROM USER  -->

<form action="results.php" method="get">
Student Id:  <input type="text" name="stuId">   
 <input type="submit">
</form>




<!-- here we are going to show the results -->
<?php
echo "welcome <br>";
// connecting to database
$servername = "localhost";
$username = "root";
$password = "";
$database = "srms";

// creating a connection

$conn = mysqli_connect($servername, $username, $password, $database);

// if (!$conn){
//     die("sorry we failed to connect: ". mysqli_error());
// }
// else{
//     echo "connecton was successsful <br>";
// }

//  DISPLAY OF ALL RECORDS IN DATABASE 

// //first of all select my database and table and execute sql command
// $sql = "SELECT * FROM `students`";
// $result = mysqli_query($conn, $sql);


// // fetch total no the rows
// echo "total no of rows in database ". mysqli_num_rows($result) . "<br>";


// // fetch all results using while loop
// while($row = mysqli_fetch_assoc($result)){
//     // echo var_dump($row);
//     // echo "<br><br><br>";

//     //or we can fetch individual attributes like this as well.
//     echo $row['StudentId']. " hi ". $row['StudentName'];
//     echo "<br><br><br>";
// }

// DISPLAY OF RECORD/result ON THE BASIS OF STUDENT ID 

// type in the StudentId to search
$searchedStudent = $_GET["stuId"];

// query to get the student info from his id and the execution of the query
$sql = "SELECT * FROM `students`";
$result = mysqli_query($conn, $sql);

// now to dispaly the result of the query
while($row = mysqli_fetch_assoc($result)){

    if($row['StudentId']==$searchedStudent){
        echo "you searched for studentId:". $row['StudentId'];
        echo "Student info is as follows <br>";
        echo "student name is " . $row['StudentName'] . "<br><br>";
        echo "email is " . $row['E-mail'] . "<br><br>";
        echo "gender is " . $row['Gender'] . "<br><br>";
        echo "phone no is " . $row['ContactNo'] . "<br><br>";
        echo "physics marks is " . $row['Physics'] . "<br><br>";
        echo "chemistry is " . $row['Chemistry'] . "<br><br>";
        echo "maths marks is " . $row['Maths'] . "<br><br>";
        echo "English marks is " . $row['English'] . "<br><br>";
        echo "add. sunject is " . $row['Additional'] . "<br><br>";
        echo "<br><br><br>";
    }
}
?>


</body>
</html> 