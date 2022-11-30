
<?php $con=mysqli_connect("localhost","root","","invoice_db");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" class="">
</head>
<body>
    <div class="hero"> 
        <div class="form-box">
            <div class="button-box">
                 
                <button type="button" class="toggle-btn" >Log in</button>
                
                
            </div>
    
            <form   action="login.php" id="login" class="input-group" method="POST">
                <label for="">Username</label>
                <input type="text" name="username" class="input-field"  required >
                <label for="">Password </label>
                <input type="password" class="input-field" name="password" required>
                <!-- <input type="checkbox"  class="checkbox" required><span>Remember Password</span> -->
               <input type="submit" name="submit" value="submit" class= "submit-btn" >

              
            </form>
            <?php
            // if(isset($_POST['submit'])){   
            //     if($_POST['submit'])
            //     {
    
            //         $Username = $_POST['username'];
            // //         $Password = $_POST['password'];
            // $Password = md5( $_POST['password']);
                   
            //         $sql=mysqli_query($con,"INSERT INTO  log VALUES(NULL,'$Username','$Password')");
                    
            //     }
               
            // }


            if(isset($_POST['submit']))
                {
                    if($_POST['submit'])
                    {
                    $Username = $_POST['username'];
                    $Password = md5($_POST['password']);
                   
                    $sql="SELECT * FROM  log where Username= '$Username' and UPassword='$Password' ";
                    $result=mysqli_query($con,$sql);

                    if(mysqli_num_rows($result)==0){
                       
                        echo "<script type='text/javascript'>alert('Username and Password is Wrong!!');</script>";
                    }else
                    {
                        header("Location:index.php");
                    }
                }
            }
            

            
             ?>
            
           
        </div>
         
    </div> 

</body> 
</html>  