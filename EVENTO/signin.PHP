<?php
    @include 'config.php';
    if(isset($_POST['SUBMIT'])){

        $name = mysqli_real_escape_string($conn,$_POST['name']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $pass=md5($_POST['password']);
        $cpass=md5($_POST['cpassword']);
        $age= $_POST['age'];

        $select="SELECT*FROM user_form  WHERE email= '$email'&& password='$pass'";
        $result = mysqli_query($conn,$select);

        if(mysqli_num_rows($result)>0){
            $error[]='user already exist!';
        }else{

            if($pass!= $cpass){
                $error[]='password not matched';
            }
            else{
                $insert="INSERT INTO user_form(name.email,passeord,age)VALUES('$name','$email','$pass','$age')";
                mysqli_query($conn,$insert);
                header('location:LOGIN.php.php');
            }
        }



        
    };
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signin.css">
    <title>SIGNIN</title>
</head>
<body>

    <form action="backend.php">

        <div id="sign">
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            }
        }
          ?>
        <div class="name">
    
            <label for="name"></label>
            <input type="text" id="name" placeholder="Enter your name">
        </div>
    
        <div class="email">
            <label for="email"></label>
            <input type="email" id="email" placeholder="Enter your Email">
        </div>
    
        <div class="age">
            <label for="age"></label>
            <input type="number" id="age" placeholder="Enter your Age">
        </div>
    
        <div class="newpassword">
    
            <label for="password"></label>
            <input type="password" type="hidden" id="newpassword" placeholder="Enter New Password">
        </div>
        <div class="confirmpassword">
    
            <label for="cpassword"></label>
            <input type="password" type="hidden" id="confirmpassword" placeholder="Enter Confirm Password">
        </div>
        <div class="confirmpassword">
    
            <input type="submit" name="SUBMIT" id="submit">
            
        </div>
    
    </div>
    </form>


</body>
</html>