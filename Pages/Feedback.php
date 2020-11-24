<!DOCTYPE html>
<?php
if(isset($_POST['submit-btn'])){
    $name=$_POST['firstname'];
    $subject=$_POST['subject1'];
    $email=$_POST['mailid'];
    $phone=$_POST['phone'];
    $feedback=$_POST['subject'];
    $date=date("Y-m-d");
    $time=date("h:i:s a");
    $conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
    $sql="Select * from feedback";
    $result = mysqli_query($conn,$sql) or die("Quesry Uncessfull");
    $c=0;
    while($row=mysqli_fetch_assoc($result)){
        $c=$c+1;
    }
    $c=$c+1;
    $sql1="Insert Into feedback(id,name,email,phone,subject,feedback,date,time) VALUES ('{$c}','{$name}','{$email}','{$phone}','{$subject}','{$feedback}','{$date}','{$time}')";
    $result1=mysqli_query($conn,$sql1) or die("Quesry Uncessfull");
}
    ?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/feedback.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script>
        function response(){
            alert("Thank you for your valuable feedback!");
        }
    </script>
</head>
<body>
    <div class="container">
        <div id="header">
            <div id="logo"><img src="../images/1.png"></div>
            <ul class="menu">
                <li><a href="../index.html"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;HOME</a></li>
                <li><a href="Contact-Us.html"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;CONTACT</a></li>
                <li><a href="PreLoginPage.html"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;LOGIN</a></li>
                <li><a href="PreSignupPage.html"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;SIGN UP</a> </li>
            </ul>
        </div>
    </div>
    <div id="main-content">
        <h2>FEEDBACK FORM</h2>
        <form method="POST">
            <div class="row">
                <div class="col-25">
                    <label for="fname">First Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="fname" name="firstname" placeholder="Your name..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject1">Subject</label>
                </div>
                <div class="col-75">
                    <input type="text" id="subject1" name="subject1" placeholder="Enter subject..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="email">Mail Id</label>
                </div>
                <div class="col-75">
                    <input type="email" id="email" name="mailid" placeholder="Your mail id..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="phone">Phone number</label>
                </div>
                <div class="col-75">
                    <input type="tel" id="phone" name="phone" placeholder="Your Phone Number..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="country">Country</label>
                </div>
                <div class="col-75">
                    <select id="country" name="country">
                        <option value="none">Select Country</option>
                        <option value="australia">Australia</option>
                        <option value="canada">Canada</option>
                        <option value="usa">USA</option>
                        <option value="russia">Russia</option>
                        <option value="japan">Japan</option>
                        <option value="india">India</option>
                        <option value="china">China</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="feed_back">Feed Back</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>
                </div>
            </div>
            <div class="row">
                <input type="submit" value="Submit" name="submit-btn" onclick="response()">
            </div>
        </form>
    </div>
    </div>
</body>

</html>