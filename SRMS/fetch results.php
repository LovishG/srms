<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    

    <style>
        form {margin: 30px;}
        nav{background-color: #2C3C59;}
        .navbar-light .navbar-nav .nav-link {
                                                                    color: #f8f9fa;  text-align: rights;
                                            }
        .navbar-light .navbar-nav .active>.nav-link, .navbar-light .navbar-nav .nav-link.active, .navbar-light .navbar-nav .nav-link.show, .navbar-light .navbar-nav .show>.nav-link {
                                                                    color: #f8f9fa; text-align: rights;

                                                        }
        .navbar-light .navbar-nav .nav-link.disabled {
                                                                    color: #f8f9fa; text-align: rights;
                                                    }
    </style>

</head>
<body>
<!-- Nav-Bar -->
        <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.html">Go To Homepage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="fetch results.php">Click to Reload Page</a>
            </li>
            </ul>
        </div>
        </nav>

    <?php
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
    ?>


<h2>
    Fill the info below to get your result:
</h2>


    <form action="fetch results.php" method="post">
  <div class="form-group">
    <label for="StudentId">Enter your student Id:</label>
    <input type="number" min="1910990000" max="9999999999" class="form-control" placeholder="Enter Your Student Id Here."required="required" name="stuId">
  </div>
   <!-- HERE PLACE TRASH  S . NO 1  -->

    <br><br>

    <input type="submit">

</form>

        <br><br><br><br>
    <?php
        if (empty($_POST)){
            exit;
         }
    // we get studentId form the input Section
        $studentId = $_POST['stuId'];
        // echo $studentId . "<br><br><br> fkjfkjdsafkjdskfjadskfjakfjaksfjkadjfkadsjfkajdfkajdfkajdfkjakl.";
       
       
// results table sql query
        $sql = "SELECT * FROM `results` WHERE `StudentId` = '$studentId' ";
        $result = mysqli_query($conn, $sql);

// tblstudents table sql query
        $studentNameSql = "SELECT * FROM `tblstudents` WHERE `StudentId` = '$studentId' ";
        $studentNameResult = mysqli_query($conn, $studentNameSql);
        $studentNameRow= mysqli_fetch_assoc($studentNameResult);

        // class id for query in classes table form tbl students
        $classId = $studentNameRow['ClassId'];

// classes table sql query
        $classNameSql = "SELECT * FROM `classes` WHERE `ClassId` = '$classId' ";
        $classNameResult = mysqli_query($conn, $classNameSql);
        $classNameRow= mysqli_fetch_assoc($classNameResult);

// Subjectcombination table sql query
        $subjectNumberSql = "SELECT * FROM `subjectcombination` WHERE `ClassId` = '$classId' ";
        $subjectNumberResult = mysqli_query($conn, $subjectNumberSql);
        // $subjectNumberRow= mysqli_fetch_assoc($subjectNumberResult);

        // total no of subjects student has in a particular class
        $subjectCount = mysqli_num_rows($subjectNumberResult);

        // declaring subjectIds array for a particular class id
        $subjectIdArray = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

        // loop to add subjectIds to array

        $count = 0;
        $i = 0;
        while($count<$subjectCount && $subjectNumberRow= mysqli_fetch_assoc($subjectNumberResult)){
            
            $subjectIdArray[$i] = $subjectNumberRow['SubjectId']; 
            // // use below line to test if loop puts correct subject id in subjectId array
            // echo "Subject id is  ".  $subjectIdArray[$i] . "<br>" ;

            $i++;
            $count++;
        }

        // //print whole array using print_r function
        //  print_r($subjectIdArray);

        // Declaring an array which contains all subject names for a particular student
        $subjectNameArray= array();

// Adding all subjectnames in array

        for($j=0; $j<$subjectCount; $j++){

            $temp = $subjectIdArray[$j];
                // sql queru for subjects table
                $subjectNameSql = "SELECT * FROM `subjects` WHERE `SubjectId` = '$temp' ";
                $subjectNameResult = mysqli_query($conn, $subjectNameSql);
                $subjectNameRow= mysqli_fetch_assoc($subjectNameResult);

                // adding subject name to subjectname array
                $subjectNameArray[$j] = $subjectNameRow['SubjectName'];
        }

        // print_r($subjectNameArray);
        // echo"<br>";

        // Declaring Marks Array
        $marksArr = array();

        // for loop to fill marks array with corresponding subjectId
        for($k=0; $k<$subjectCount; $k++){

                $temp2 = $subjectIdArray[$k];

                $subjectMarksSql = "SELECT * FROM `results` WHERE `SubjectId` = $temp2  AND `StudentId` = $studentId ";
                $subjectMarksResult = mysqli_query($conn, $subjectMarksSql);
                $subjectMarksRow= mysqli_fetch_assoc($subjectMarksResult);

                $marksArr[$k] = $subjectMarksRow['Marks'];

        }


        //dispalying welcome message + name + roll no + class + section
        echo "<h3 style = 'text-align: center;'>Welcome <span style = 'color: blue;'>". $studentNameRow['StudentName']. "</span> your student id is <span style = 'color: red;'>" . $studentId . "</span> And You are from Class <span style = 'color: cyan;'>". $classNameRow['ClassName']. " ". $classNameRow['Section'] ."</span>. <br><br>And your Result is as Follows:  </h3>";

        
        echo "<br><br>";

        echo "<table class='table'>
        <thead>
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>Subject Name</th>
            <th scope='col'>Marks Obtained</th>
            <th scope='col'>Total Marks</th>
          </tr>
        </thead>
            ";

        $arrIndex = 0;  // this variable will be used as index to fetch sunject name, marks from their respective arrays
        $count2 = 1;   // normal counting no.  

        While($row = mysqli_fetch_assoc($result)){

            echo "
            
            <tbody>
            <tr>
              <th scope='row'>". $count2 ."</th>
              <td>". $subjectNameArray[$arrIndex] ."</td>
              <td>". $marksArr[$arrIndex] ."</td>
              <td>100</td>
            </tr>
            </tbody>
            ";


            // echo $row['StudentId']. " name =  ". $studentNameRow['StudentName']. " class = ". $classNameRow['ClassName']. " ". $classNameRow['Section'] . " subject count = ". $subjectCount . " subject no " . $count2 . " is " . $subjectNameArray[$arrIndex] . " and score is " . $marksArr[$arrIndex];
            // echo "<br>";

            $arrIndex++;
            $count2++;
        }

        echo "</table>";

    ?> 


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    



</body>
</html>