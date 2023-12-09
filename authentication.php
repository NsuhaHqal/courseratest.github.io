<?php      
session_start();

    include('include/connection.php');  
    $Email = $_POST['Email'];  
    $Password = $_POST['Password'];
      
        //to prevent from mysqli injection  
        $Email = stripcslashes($Email);  
        $Password = stripcslashes($Password);  
        $Email = mysqli_real_escape_string($con, $Email);  
        $Password = mysqli_real_escape_string($con, $Password);  
      
        $sql = "select *from Users where Email = '$Email' and Password = '$Password'";
     
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  

       $Email = $row['Email'];
    

        $count = mysqli_num_rows($result);  
          
     

        if($count == 1){  
            if ($row['UserLevel'] == '1') {
                $_SESSION['Email'] = $row['Email'];
                $_SESSION['UserID'] = $row['UserID'];
               header('location: admin/index.php');
            }
            else if ($row['UserLevel'] == '2') {
                $_SESSION['Email'] = $row['Email'];
                $_SESSION['UserID'] = $row['UserID'];
                    header('location: teacher/index.php');
                }
                else if ($row['UserLevel'] == '3') {
                    $_SESSION['Email'] = $row['Email'];
                    $_SESSION['UserID'] = $row['UserID'];
                        header('location: student/index.php');
                    }
        }  
    
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
            echo "Failed";
            header("location:index.php?msg=failed");
        }     
?>  