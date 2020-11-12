<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/student_dashboard.css" rel="stylesheet">
    <link  rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link  rel="stylesheet" href="../css/bootstrap-theme.min.css"/>    
    <link rel="stylesheet" href="../css/main.css">
    <link  rel="stylesheet" href="../css/font.css">
    <script src="../javascript/jquery.js" type="text/javascript"></script>
    <script src="../javascript/bootstrap.min.js"  type="text/javascript"></script>
 	<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <style>
        #nav h3{
            color:red;
            line-height:15px;
            padding-top:0px;
            font-weight:bold;
            float:left;
        }
        .menu{
            float: left;
            margin-top: 10px;
            margin-left:15px;
        }
    </style>

</head>
<body>
    <?php
    $conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
    session_start();
    if(!(isset($_SESSION['email']))){
        header("location:../index.html");
    }
    else{
        $email=$_SESSION['email'];
    }
    ?>
    <div id="container">
        <div id="header">
            <div id="header1">
                <div id="logo"><img src="../images/1.png"></div>
                <div id="right-header1">
                    <a href="Signout.php?q=../index.html"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Sign out</a>
                    <a href="#"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Hello, Admin</a>
                </div>
            </div>
        </div>
        <div id="nav">
            <h3>DashBoard</h3>
            <ul class="menu">
                <li><a href="Teacher_Dashboard.php"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home</a></li>
                <li><?php if(@$_GET['q']==2) ?><a href="Teacher_Dashboard.php?q=2">&nbsp;Ranking</a></li>
                <li><?php if(@$_GET['q']==3) ?><a href="Teacher_Dashboard.php?q=3"><i class="material-icons" aria-hidden="true">feedback</i>&nbsp;Feedback</a></li>
                <li><a href="#">&nbsp;Quiz</a>
                    <ul class="dropdown-menu">
                        <li><a href="../Pages/Teacher_Dashboard.php?q=4">Add Quiz</a></li>
                        <li><a href="../Pages/Teacher_Dashboard.php?q=5">Remove Quiz</a></li>
	        		</ul>
                </li>
                <li><a href="Signout.php?q=../index.html"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Sign Out</a></li>
            </ul>
        </div>
        <div id="main-content">

        <?php
        //ranking start
        $conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
        if(@$_GET['q']== 2) 
        {
        $q=mysqli_query($conn,"SELECT * FROM rank ORDER BY score DESC " )or die('Error223');
        echo  '<div class="panel title"><div class="table-responsive">
        <table class="table table-striped title1" >
        <tr style="color:red"><td><b>Rank</b></td><td><b>Name</b></td><td><b>Email</b></td><td><b>Score</b></td></tr>';
        $c=0;
        while($row=mysqli_fetch_array($q) )
        {
        $e=$row['email'];
        $s=$row['score'];
        $q12=mysqli_query($conn,"SELECT * FROM users WHERE email='$e'" )or die('Error231');
        while($row=mysqli_fetch_array($q12) )
        {
        $name=$row['userName'];
        $c++;
        echo '<tr><td style="color:#99cc32"><b>'.$c.'</b></td><td>'.$name.'</td><td>'.$e.'</td><td>'.$s.'</td>';
        }
        }
        echo '</table></div></div>';}

        ?>

        <!--feedback start-->
        <?php if(@$_GET['q']==3) {
        $result = mysqli_query($conn,"SELECT * FROM feedback where remail='$email' ORDER BY feedback.date DESC") or die('Error');
        echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
        <tr><td><b>S.N.</b></td><td><b>Subject</b></td><td><b>Email</b></td><td><b>Date</b></td><td><b>Time</b></td><td><b>By</b></td><td></td><td></td></tr>';
        $c=1;
        while($row = mysqli_fetch_array($result)) {
            $date = $row['date'];
            $date= date("d-m-Y",strtotime($date));
            $time = $row['time'];
            $subject = $row['subject'];
            $name = $row['name'];
            $email = $row['email'];
            $id = $row['id'];
            echo '<tr><td>'.$c++.'</td>';
            echo '<td>'.$subject.'</td><td>'.$email.'</td><td>'.$date.'</td><td>'.$time.'</td><td>'.$name.'</td></tr>';
        }
        echo '</table></div></div>';
        }
        ?>

        <?php
            if(@$_GET['q']==4 && !(@$_GET['step']) ) {
            echo ' 
            <div class="row">
            <span class="title1" style="margin-left:40%;font-size:30px;"><b><center>Enter Quiz Details</b><center></span><br /><br />
            <div class="col-md-3"></div>
            <div class="col-md-6">
            <form class="form-horizontal title1" name="form" action="update.php?q=addquiz"  method="POST">
            <fieldset>


            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-12 control-label" for="name"></label>  
            <div class="col-md-12">
            <input id="name" name="name" placeholder="Enter Quiz title" class="form-control input-md" type="text">
                
            </div>
            </div>



            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-12 control-label" for="total"></label>  
            <div class="col-md-12">
            <input id="total" name="total" placeholder="Enter total number of questions" class="form-control input-md" type="number">
                
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-12 control-label" for="right"></label>  
            <div class="col-md-12">
            <input id="right" name="right" placeholder="Enter marks on right answer" class="form-control input-md" min="0" type="number">
                
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-12 control-label" for="wrong"></label>  
            <div class="col-md-12">
            <input id="wrong" name="wrong" placeholder="Enter minus marks on wrong answer without sign" class="form-control input-md" min="0" type="number">
                
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-12 control-label" for="time"></label>  
            <div class="col-md-12">
            <input id="time" name="time" placeholder="Enter time limit for test in secand for each question" class="form-control input-md" min="1" type="number">
                
            </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-12 control-label" for="tag"></label>  
            <div class="col-md-12">
            <input id="tag" name="tag" placeholder="Enter #tag which is used for searching" class="form-control input-md" type="text">
                
            </div>
            </div>


            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-12 control-label" for="desc"></label>  
            <div class="col-md-12">
            <textarea rows="8" cols="8" name="desc" class="form-control" placeholder="Write description here..."></textarea>  
            </div>
            </div>


            <div class="form-group">
            <label class="col-md-12 control-label" for=""></label>
            <div class="col-md-12"> 
                <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
            </div>
            </div>

            </fieldset>
            </form></div>';
            }
            ?>
            <!--remove quiz-->
            <?php if(@$_GET['q']==5) {

            $result = mysqli_query($conn,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
            echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
            <tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
            $c=1;
            while($row = mysqli_fetch_array($result)) {
                $title = $row['title'];
                $total = $row['total'];
                $sahi = $row['sahi'];
                $time = $row['time'];
                $eid = $row['eid'];
                echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
                <td><b><a href="update.php?q=rmquiz&eid='.$eid.'" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Remove</b></span></a></b></td></tr>';
            }
            $c=0;
            echo '</table></div></div>';
            }
            ?>


            <!--add quiz step2 start-->
            <?php
            if(@$_GET['q']==4 && (@$_GET['step'])==2 ) {
            echo ' 
            <div class="row">
            <span class="title1" style="margin-left:40%;font-size:30px;"><b><center>Enter Question Details</center></b></span><br /><br />
            <div class="col-md-3"></div><div class="col-md-6"><form class="form-horizontal title1" name="form" action="update.php?q=addqns&n='.@$_GET['n'].'&eid='.@$_GET['eid'].'&ch=4 "  method="POST">
            <fieldset>
            ';
            
            for($i=1;$i<=@$_GET['n'];$i++)
            {
            echo '<b>Question number&nbsp;'.$i.'&nbsp;:</><br /><!-- Text input-->
            <div class="form-group">
            <label class="col-md-12 control-label" for="qns'.$i.' "></label>  
            <div class="col-md-12">
            <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
            </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-12 control-label" for="'.$i.'1"></label>  
            <div class="col-md-12">
            <input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="form-control input-md" type="text">
                
            </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-12 control-label" for="'.$i.'2"></label>  
            <div class="col-md-12">
            <input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="form-control input-md" type="text">
                
            </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-12 control-label" for="'.$i.'3"></label>  
            <div class="col-md-12">
            <input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="form-control input-md" type="text">
                
            </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
            <label class="col-md-12 control-label" for="'.$i.'4"></label>  
            <div class="col-md-12">
            <input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="form-control input-md" type="text">
                
            </div>
            </div>
            <br />
            <b>Correct answer</b>:<br />
            <select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="form-control input-md" >
            <option value="a">Select answer for question '.$i.'</option>
            <option value="a">option a</option>
            <option value="b">option b</option>
            <option value="c">option c</option>
            <option value="d">option d</option> </select><br /><br />'; 
            }
                
            echo '<div class="form-group">
            <label class="col-md-12 control-label" for=""></label>
            <div class="col-md-12"> 
                <input  type="submit" style="margin-left:45%" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
            </div>
            </div>

            </fieldset>
            </form></div>';
            }
            ?>
        </div>
    </div>
    
</body>
</html>