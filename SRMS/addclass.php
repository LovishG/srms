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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add class here</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #msg{
                color: red;
            }

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
                <a class="nav-link" href="welcome.php">DASHBOARD</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addclass.php">Reload This Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="updateclass.php">UPDATE cLASS</a>
            </li>
            </ul>
        </div>
        </nav>
    


    <h2>
        Fill the info below to create class:
    </h2>
    
    
        <form action="addclass.php" method="get">
      <div class="form-group">
        <label for="className">Enter Class Name to be created:</label>
        <input type="text" class="form-control" placeholder="Enter class name like 10th, 8th, 7th...etc"required="required" name="className">
        <label for="section">Enter Section:</label>
        <input type="text" class="form-control" placeholder="Enter Section: A,B,C,D"required="required" name="section">
      </div>
       <!-- HERE PLACE TRASH  S . NO 1  -->
    
        <br><br>
    
        <input type="submit">
    
    </form>
    
            <br><br>
            
            <h2 id="msg"></h2>
            <br><br>


    <?php
        // connecting to database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "srms";
        
        // creating a connection
        
        $conn = mysqli_connect($servername, $username, $password, $database);
        
    ?>
       
       <h2>Below is the table:-</h2>
    <?php
                // Display whole classes table
                $classSql = "SELECT * FROM `classes`; ";
                $classResult = mysqli_query($conn, $classSql);
                
                echo "<table class='table'>
                <thead>
                <tr>
                <th scope='col'>#</th>
                <th scope='col'>Class Id</th>
                <th scope='col'>Class Name</th>
                <th scope='col'>Section</th>
                </tr>
                </thead>
                ";
                
                $count = 1;
                while($classRow= mysqli_fetch_assoc($classResult)){
                    echo "
                    
                    <tbody>
                    <tr>
                    <th scope='row'>". $count ."</th>
              <td>". $classRow['ClassId'] ."</td>
              <td>".$classRow['ClassName']  ."</td>
              <td>".$classRow['Section']."</td>
            </tr>
            </tbody>
            ";

            $count++;
    
        }
        echo "</table>";
    ?>





    <?php
        if (empty($_GET)){
            exit;
         }
    
        $className = $_GET['className'];
        $section = $_GET['section'];

        $sameSql = "SELECT * FROM `classes` WHERE `ClassName` = '$className' AND `Section` = '$section'";
        $sameResult = mysqli_query($conn,$sameSql);

        if($sameRow = mysqli_fetch_assoc($sameResult)){
            echo "<script>
            const element = document.getElementById('msg');
            element.innerHTML = 'Same class And Section already there.';
            </script>";
            exit;
        }

        $addClassSql = "INSERT INTO `classes` (`ClassId`, `ClassName`, `Section`) VALUES (NULL, '$className', '$section')";
        $classAddResult = mysqli_query($conn, $addClassSql);

        if($classAddResult){
            echo "<script>
                        alert('Added Successfully');
                        window.location.href='http://localhost/SRMS/addclass.php';
                </script>";
        }
        else {
            echo '<script>alert("error")</script>' . mysqli_error($conn) ;
        }

        

    ?> 

    
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    

    
</body>

</html>