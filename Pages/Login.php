<!DOCTYPE html>

<?php
if(isset($_POST['sbt-btn'])){
    $user_name = $_POST['uname'];
    $password = $_POST['psw'];
    $conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
    $sql="Select * from users";
    $result = mysqli_query($conn,$sql) or die("Quesry Uncessfull");
    $found_data = false;
    while($row=mysqli_fetch_assoc($result)){
        if($row['userName'] == $user_name){
            if($row['pasword'] == $password){
                $found_data = true;
                $email = $row['email'];
                header("Location: http://localhost/Online_Examination_System/Pages/Student_Dashboard.php?username=$user_name&email=$email&q=1");
            }
        }
        else{
            continue;
        }
    }
    if(! $found_data){
        echo "<script>alert('You entered wrong details.')</script>";
    }
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="../css/Signup.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <title>Login</title>
    </head>
    <body>
        <div id="contanier">
            <div id="header">
                <div id="logo"><img src="../images/1.png"></div>
                <ul class="menu">
                    <li><a href="../index.html"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;HOME</a></li>
                <li><a href="Aboutus.html"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;ABOUT US</a></li>
                <li><a href="Contact-Us.html"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;CONTACT</a></li>
                <li><a href="PreSignupPage.html"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;SIGN UP</a></li>
                </ul>
            </div>
        </div>
        <div class="middle">
            <form method="POST">
                <h1><center>LOGIN</center></h1><br>
                <hr><br>
                <label for="uname">Username:</label>
                <input type="text" placeholder="Enter Username" name="uname" required>
                <label for="psw">Password:</label>
                <input type="text" placeholder="Enter Password" name="psw" required>
                <button type="submit" class="login" name="sbt-btn">LOGIN</button><br><br>
                <h4>Don't have an account? <a href="../Pages/Signup.html">Sign-up</a></h4>
            </form>
        </div>
</html>