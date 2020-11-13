<!DOCTYPE html>
<?php
if(isset($_POST['submit-btn'])){
    $admin_fname = $_POST['fname'];
    $admin_lname = $_POST['lname'];
    $admin_uname = $_POST['uname'];
    $admin_email = $_POST['email'];
    $admin_psw = $_POST['psw'];

    $conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
    $not_registered = true;
    $sql="Select * from admins";
    $result = mysqli_query($conn,$sql) or die("Quesry Uncessfull");
    $c=0;
    while($row=mysqli_fetch_assoc($result)){
        $c=$c+1;
    }
    $c=$c+1;
    while($row=mysqli_fetch_assoc($result)){
        if($row['email'] == $admin_email){
            echo "<script>alert('This email is already registered')</script>";
            $not_registered = false;
            break;
        }
        else{
            continue;
        }
    }
    if($not_registered){
        $sql1 = "Insert Into admins(adminId,adminName,email,pasword) VALUES ('{$c}','{$admin_uname}','{$admin_email}','{$admin_psw}')";
        $result1 = mysqli_query($conn,$sql1) or die("Query Unsucessful.");
        echo "<script>alert('Your data is uploaded sucessfully.')</script>";
    }
    mysqli_close($conn);
}
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="../css/Signup.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <title>SignUpAsAdmin</title>
    </head>
    <body>
        <div id="contanier">
            <div id="header">
                <div id="logo"><img src="../images/1.png"></div>
                <ul class="menu">
                    <li><a href="../index.html"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;HOME</a></li>
                <li><a href="Aboutus.html"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;ABOUT US</a></li>
                <li><a href="Contact-Us.php"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;CONTACT</a></li>
                <li><a href="PreLoginPage.html"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;LOGIN</a></li>
                </ul>
            </div>
        </div>
        <div class="middle">
            <form method="POST">
                <h1><center>Sign Up</center></h1><br>
                <hr><br>
                <h2><center>CREATE AN ACCOUNT</center></h2><br>
                <label for="fname">First Name:</label>
                <input type="text" placeholder="Enter First Name" name="fname" required>
                <label for="lname">Last Name:</label>
                <input type="text" placeholder="Enter Last Name" name="lname" required>
                <label for="uname">Username:</label>
                <input type="text" placeholder="Enter Username" name="uname" required>
                <label for="email">Email:</label>
                <input type="text" placeholder="Enter Email" name="email" required>
                <label for="psw">Password:</label>
                <input type="text" placeholder="Enter Password" name="psw" required>
                <label for="rpsw">Repeat Password:</label>
                <input type="text" placeholder="Enter Password Again" name="rpsw" required>
                <button type="submit" class="signup" name="submit-btn" >Create An Account</button><br><br>
                <h4>Already have an account? <a href="../Pages/PreLoginPage.html">Sign-in</a></h4>
            </form>
        </div>
    </body>
</html>