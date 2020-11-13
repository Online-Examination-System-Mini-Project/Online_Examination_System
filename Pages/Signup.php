<!DOCTYPE html>
<?php
if(isset($_POST['submit-btn'])){
    $stu_fname = $_POST['fname'];
    $stu_lname = $_POST['lname'];
    $stu_uname = $_POST['uname'];
    $stu_email = $_POST['email'];
    $stu_psw = $_POST['psw'];

    $conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
    $not_registered = true;
    $sql="Select * from users";
    $result = mysqli_query($conn,$sql) or die("Quesry Uncessfull");
    while($row=mysqli_fetch_assoc($result)){
        if($row['email'] == $stu_email){
            echo "<script>alert('This email is already registered')</script>";
            $not_registered = false;
            break;
        }
        else{
            continue;
        }
    }
    if($not_registered){
        $sql1 = "Insert Into users(fname,lname,userName,email,pasword) VALUES ('{$stu_fname}','{$stu_lname}','{$stu_uname}','{$stu_email}','{$stu_psw}')";
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
    <title>ALogin</title>
    <link rel="stylesheet" href="../css/Alogin.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
       
        function check(){
            var nameV = document.getElementById("name").value;
            var illegal = /\W/;
            if(illegal.test(nameV)){
                alert("Please Enter Valid Username");
                return false;
            }
            return true;
        }
        function checkP(){
            var nameP = document.getElementById("passL").value;
            if( nameP.length<8 && nameP.length!=0){
                alert("Password Length required is atleast 8");
                return false;
            }
            return true;
        }
    </script>
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
    <div id="L">
        <h1>Sign up</h1>
    </div>
    <form id="Login" method="POST">
        <div id="fname">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" placeholder="First Name" id="fname" name="fname" onblur="check()" required>
        </div>
        <div id="lname">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" placeholder="Last Name" id="lname" name="lname" onblur="check()" required>
        </div>
        <div id="username">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" placeholder="Username" id="name" name="uname" onblur="check()" required>
        </div>
        <div id="pass">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" placeholder="Password" id="passL" name="psw" onblur ="checkP()" required><br>
        </div>
        <div id="rpass">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" placeholder="Repeat Password" id="rpassL" name="rpsw" onblur ="checkP()" required><br><br>
        </div>
        <button type="submit" id="button" name="sbt-btn">SIGN UP</button>
    </form>
       
</body>
</html>
