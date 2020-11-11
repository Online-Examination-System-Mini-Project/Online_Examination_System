<!DOCTYPE html>
<?php
if(isset($_POST['submit-btn'])){
    $name=$_POST['firstname'];
    $subject=$_POST['subject1'];
    $email=$_POST['mailid'];
    $remail=$_POST['rmailid'];
    $feedback=$_POST['subject'];
    $date=date("Y-m-d");
    $time=date("h:i:sa");
    $conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
    $sql="Select * from feedback";
    $result = mysqli_query($conn,$sql) or die("Quesry Uncessfull");
    $c=0;
    while($row=mysqli_fetch_assoc($result)){
        $c=$c+1;
    }
    $c=$c+1;
    $sql1="Insert Into feedback(id,name,email,remail,subject,feedback,date,time) VALUES ('{$c}','{$name}','{$email}','{$remail}','{$subject}','{$feedback}','{$date}','{$time}')";
    $result1=mysqli_query($conn,$sql1) or die("Quesry Uncessfull");
}
    ?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script>
        function response(){
            alert("Thank you for your valuable feedback!");
        }
        </script>
    <style>
        * {
            box-sizing: border-box;
        }

        #header {
            width: 100%;
            height: 70px;
            background-image: linear-gradient(to right, rgb(21, 208, 241), rgb(76, 45, 252), rgb(116, 6, 126));
            position: sticky;
            top: 0;
            z-index: 2;
        }

        #logo img {
            width: 80px;
            height: 65px;
            border-radius: 50%;
            margin-top: 3px;
            margin-left: 50px;
            float: left;
        }

        .menu {
            float: right;
            margin: 10px;
        }

        .menu li {
            float: left;
            list-style-type: none;
            margin-right: 20px;
        }

        .menu li a {
            font-size: 25px;
            text-decoration: none;
            padding: 10px;
            display: block;
            color: white;
            text-decoration-style: solid;
        }

        .menu li a:hover {
            color: rgb(255, 255, 255);
            background-color: rgb(36, 36, 36);
            border-radius: 10px;
            transition: .4s;
            border: 2px solid white;
        }

        input[type=text],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid rgb(70, 68, 68);
            border-radius: 4px;
            resize: vertical;
        }

        input[type=email],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid rgb(70, 68, 68);
            border-radius: 4px;
            resize: vertical;
        }

        label {
            padding: 12px 12px 12px 0;
            display: inline-block;
        }

        input[type=submit] {
            background-color: rgb(37, 116, 161);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        #main-content {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        .col-25 {
            float: left;
            width: 25%;
            margin-top: 6px;
        }

        .col-75 {
            float: left;
            width: 75%;
            margin-top: 6px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    </style>
</head>
<body>
    <div class="container">
        <div id="header">
            <div id="logo"><img src="../images/1.png"></div>
            <ul class="menu">
                <li><a href="../index.html"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;HOME</a></li>
                <li><a href="Contact-Us.html"><i class="fa fa-phone" aria-hidden="true"></i>&nbsp;CONTACT</a></li>
                <li><a href="PreLoginPage.html"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;LOGIN</a></li>
                <li><a href="PreSignupPage.html"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;SIGN UP</a>
                </li>
            </ul>
        </div>
    </div>
    <div id="main-content">
        <h2>FEED BACK FORM</h2>
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
                    <label for="remail">Receiver's Mail Id</label>
                </div>
                <div class="col-75">
                    <input type="email" id="remail" name="rmailid" placeholder="Receiver's mail id..">
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