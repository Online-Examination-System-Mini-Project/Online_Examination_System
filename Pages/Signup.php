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
    <title>Signup(Student)</title>
    <link rel="stylesheet" href="../css/Asignup.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        var fn = 1;
        var ln = 1;
        var un = 1;
        var em = 1;
        var ps = 1;
        var rps = 1;
        function checkFName(){
            var btn = document.getElementById("button");
            var namev = document.getElementById("fname").value;
            var wrongsyn1 = /\W/;
            var wrongsyn2 = /^.*[0-9]+.*$/;
            if( wrongsyn1.test(namev) || wrongsyn2.test(namev)){
                document.getElementById("firstname").style.color = "red";
                btn.disabled = true;
                fn = 0;
                alert("Please Enter Valid First Name");
                return false;
            }
            else if( namev.length == 0){
                return false;
            }
            else{
                document.getElementById("firstname").style.color = "blue";
                fn = 1;
                if(ln == 1 && un == 1 && em == 1 && ps == 1 && rps == 1){
                   
                    btn.disabled = false;
                }
            }
            return true;
        }
        function checkLName(){
            var btn = document.getElementById("button");
            var namev = document.getElementById("lname").value;
            var wrongsyn1 = /\W/;
            var wrongsyn2 = /^.*[0-9]+.*$/;
            if( wrongsyn1.test(namev) || wrongsyn2.test(namev)){
                document.getElementById("lastname").style.color = "red";
                btn.disabled = true;
                alert("Please Enter Valid Last Name");
                ln = 0;
                return false;
            }
            else if( namev.length == 0){
                return false;
            }
            else{
                document.getElementById("lastname").style.color = "blue";
                ln = 1;
                
                if(fn == 1 && un == 1 && em == 1 && ps == 1 && rps == 1){
                    
                    
                    btn.disabled = false;
                }
                

            }
            return true;

        }
        function check(){
            var btn = document.getElementById("button");
            var nameV = document.getElementById("name").value;
            var illegal = /\W/;
            if(illegal.test(nameV) ){
                document.getElementById("username").style.color = "red";
                btn.disabled = true;
                alert("Please Enter Valid Username");
                
                un = 0;
                return false;
            }
            else if( nameV.length == 0){
                return false;
            }
            else{
                document.getElementById("username").style.color = "blue";
                un = 1;
                
                if(ln == 1 && fn == 1 && em == 1 && ps == 1 && rps == 1){
                   
                    
                    btn.disabled = false;
                }
            }
            return true;
        }
        function checkP(){
            var btn = document.getElementById("button");
            var nameP = document.getElementById("passL").value;
            if( nameP.length<8 && nameP.length!=0){
                document.getElementById("pass").style.color = "red";
                btn.disabled = true;
                alert("Password Length required is atleast 8");
                ps = 0;
                return false;
            }
            else if( nameP.length == 0){
                return false;
            }
            else{
                document.getElementById("pass").style.color = "blue";
                ps = 1;
                
                if(ln == 1 && un == 1 && em == 1 && fn == 1 && rps == 1){
                    
                    
                    btn.disabled = false;
                }
            }
            return true;
        }
        function EmailChecker(){
            var btn = document.getElementById("button");
            var inputE= document.getElementById("mail").value;
            var emailSyntax= /^.+@gmail.com$/;
            if(emailSyntax.test(inputE)){
                document.getElementById("Email").style.color = "blue";
               
                em = 1;
                if(ln == 1 && un == 1 && rps == 1 && ps == 1 && fn == 1){
                   
                    
                    btn.disabled = false;
                }
        
            }
            else if( inputE.length == 0){
                return false;
            }
            else{
                document.getElementById("Email").style.color = "red";
                btn.disabled = true;
                em = 0;
                alert("Please Enter valid Email");
            }
         }
        function confirmPass(){
            var btn = document.getElementById("button");
            var pass1 = document.getElementById("passL").value;
            var pass2 = document.getElementById("rpassL").value;
            if( pass1 != pass2){
                document.getElementById("rpass").style.color = "red";
                btn.disabled = true;
                alert("Password not matched");
                rps = 0;
                return false;
            }
            else if( pass2.length == 0){
                return false;
            }
            else{
                document.getElementById("rpass").style.color = "blue";
                rps = 1;
                if(ln == 1 && un == 1 && em == 1 && ps == 1 && fn == 1){
                    
                    
                    btn.disabled = false;
                }
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
                <li><a href="PreLoginPage.html"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;LOGIN</a></li>
            </ul>
        </div>
    </div>
    <div id="L">
        <h1>Sign up</h1>
    </div>
    <form id="Login" method="POST">
        <div id="firstname">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" placeholder="First Name" id="fname" name="fname" onblur="checkFName()" required>
        </div>
        <div id="lastname">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" placeholder="Last Name" id="lname" name="lname" onblur="checkLName()" required>
        </div>
        <div id="username">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" placeholder="Username" id="name" name="uname" onblur="check()" required>
        </div>
        <div id = "Email">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <input type="email" placeholder="Email" id="mail" name="email" onblur="EmailChecker()" required>
        </div>
        <div id="pass">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" placeholder="Password" id="passL" name="psw" onblur ="checkP()" required><br>
        </div>
        <div id="rpass">
            <i class="fa fa-lock" aria-hidden="true"></i>
            <input type="password" placeholder="Repeat Password" id="rpassL" name="rpsw" onblur ="confirmPass()" required><br><br>
        </div>
        <button type="submit" id="button" name="submit-btn">SIGN UP</button>
    </form>
       
</body>
</html>
