<!DOCTYPE html>
<?php
if(isset($_POST['sbt-btn'])){
    session_start();
    $admin_name = $_POST['admin_name'];
    $password = $_POST['password'];
    $conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
    $sql="Select * from superadmin";
    $result = mysqli_query($conn,$sql) or die("Quesry Uncessfull");
    $found_data = false;
    while($row=mysqli_fetch_assoc($result)){
        if($row['sadminName'] == $admin_name){
            if($row['pasword'] == $password){
                $found_data = true;
                $email=$row['email'];
                $_SESSION["email"] = $email;
                header("Location: http://localhost/Online_Examination_System/Pages/SuperAdmin_Dashboard.php");
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
    <title>Login(SuperAdmin)</title>
    <link rel="stylesheet" href="../css/Alogin.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
       
       function check(){
            
            var button = document.getElementById("button");
            var nameV = document.getElementById("name").value;
            var illegal = /\W/;
            if(illegal.test(nameV)){
                alert("Please Enter Valid Username");
                document.getElementById("username").style.color = "red";
                return false;
            }
            else if( nameV.length ==0){
                return false;
            }
            else{
                document.getElementById("username").style.color = "blue";
            
            }
            
        }
        function checkP(){
            var button = document.getElementById("button");
            var nameP = document.getElementById("passL").value;
            if( nameP.length<8 && nameP.length!=0){
                document.getElementById("pass").style.color = "red";
                alert("Password Length required is atleast 8");
                return false;
            }
            else if( nameP.length ==0){
                return false;
            }
            else{
                document.getElementById("pass").style.color = "blue";
            
            }
        }
    </script>
</head>
<body>
    <div id="contanier">
        <div id="header">
        <input type="checkbox" id="chk" />
        <label for="chk" class="show-btn">
        <i class="fa fa-bars"></i>
        </label>
            <div id="logo"><img src="../images/1.png"></div>
            <ul class="menu">
                <li><a href="../index.html"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;HOME</a></li>
                <li><a href="Aboutus.html"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;ABOUT US</a></li>
                <li><a href="Contact-Us.html"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;CONTACT</a></li>
                <li><a href="PreSignupPage.html"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;SIGN UP</a></li>
                <label for="chk" class="hide-btn">
                    <i class="fa fa-times"></i>
                </label>
            </ul>
        </div>
    </div>
    <div id="L">
        <h1>Login</h1>
    </div>
    <form id="Login" method="POST">
        <div id="username">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" placeholder="Username" id="name" name="admin_name" onblur="check()" required>
        </div>
        <div id="pass">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" placeholder="Password" id="passL" name="password" onblur ="checkP()" required><br><br>
        </div>
        <button type="submit" id="button" name="sbt-btn">LOGIN</button>
    </form>
       
</body>
</html>