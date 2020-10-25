<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/student_dashboard.css" rel="stylesheet">
    <style>
        * {
    padding: 0;
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
}

body{
    background-color:rgb(240,240,240);
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

#right-header1 a{
    font-size: larger;
    float: right;
    color: white;
    padding: 20px;
    text-decoration: none;
}

#nav{
    width: 100%;
    height: 50px;
    border: 1px solid lightgray;
    background-color:rgb(253,252,252);
}

#nav h3{
    float: left;
    padding: 15px;
    padding-right: 30px;
    font-size: 20px;
}

.menu{
    float: left;
    margin-top: 10px;
    
}

.menu li {
    float: left;
    padding-right: 30px;
    padding-top: 5px;
    list-style-type: none;
    position:relative;
    line-height:30px;
}

.menu li a{
    text-decoration: none;
    color: black;
    padding: 10px;
    font-size: 18px;
    transition:.4s;
}

.dropdown-menu{
    position: absolute;
    width: 200px;
    display:none;
}
.dropdown-menu li{
    line-height:40px;
}


.dropdown-menu li a{
    padding:7px;
}

.menu li:hover .dropdown-menu{
    display:block;
}

.menu li a:hover{
    background-color: lightgray;
}

#tag{
    height: 25px;
    border: 2px solid black;
}

#search-btn{
    color: black;
    padding: 2px 5px;
    border-radius: 5px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
    </style>
</head>
<body>
    <div id="container">
        <div id="header">
            <div id="header1">
                <div id="logo"><img src="../images/1.png"></div>
                <div id="right-header1">
                    <a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Sign out</a>
                    <a href="#"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Hello, Admin</a>
                </div>
            </div>
        </div>
        <div id="nav">
            <h3>DashBoard</h3>
            <ul class="menu">
                <li><a href="../Pages/D_Home.html"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home</a></li>
                <li><?php if(@$_GET['q']==2) echo'class="active"'; ?><a href="../Pages/Teacher_Dashboard.php?q=2">&nbsp;Ranking</a></li>
                <li><a href="../Pages/D_Feedback.html"><i class="material-icons" aria-hidden="true">feedback</i>&nbsp;Feedback</a></li>
                <li><a href="#">&nbsp;Quiz</a>
                    <ul class="dropdown-menu">
                        <li><a href="dash.php?q=4">Add Quiz</a></li>
                        <li><a href="dash.php?q=5">Remove Quiz</a></li>
	        		</ul>
                </li>
                <li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Sign Out</a></li>
                
                
            </ul>
        </div>
    </div>
    
</body>
</html>