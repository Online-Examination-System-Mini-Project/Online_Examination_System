<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../css/student_dashboard.css" rel="stylesheet">
    <link  rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link  rel="stylesheet" href="../css/bootstrap-theme.min.css"/>    
    <link rel="stylesheet" href="../css/main.css">
    <link  rel="stylesheet" href="../css/font.css">
    <script src="../javascript/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"  type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

    
    <!--alert message-->
    <?php if(@$_GET['w'])
    {echo'<script>alert("'.@$_GET['w'].'");</script>';}
    ?>
    <!--alert message end-->
</head>
<?php
$conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
$user_name=$_GET['username'];
$email = $_GET['email'];
?>
<body>
    <?php
    $conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
    session_start();
    ?>
    <div id="container">
        <div id="header">
            <div id="header1">
                <div id="logo"><img src="../images/1.png"></div>
                <div id="right-header1">
                    <a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Sign out</a>
                    <a href="#"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Hello, <?php echo $_GET['username'] ?></a>
                </div>
            </div>
        </div>
        <div id="nav">
            <h3>DashBoard</h3>
            <ul class="menu">
                <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="Student_Dashboard.php?username=<?php echo $user_name?>&email=<?php echo $email ?>&q=1"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home</a></li>
                <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="Student_Dashboard.php?username=<?php echo $user_name?>&email=<?php echo $email ?>&q=2"><i class="fa fa-history" aria-hidden="true"></i>&nbsp;History</a></li>
                <li><a href="Signout.php?q=../index.html"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Sign Out</a></li>
                <form method="POST" id="form1">
                    <input type="text" id="tag" name="tag" size="25"  value="Enter Tag">&nbsp;&nbsp;
                    <button id="search-btn">Search</button>
                </form>
            </ul>
        </div>
        <?php if(@$_GET['q']==1) {

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
        $q12=mysqli_query($conn,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
        $rowcount=mysqli_num_rows($q12);	
        if($rowcount == 0){
            echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
            <td><b><a href="Student_Dashboard.php?username='.$user_name.'&email='.$email.'&q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
        }
        else
        {
        echo '<tr style="color:#99cc32"><td>'.$c++.'</td><td>'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
            <td><b><a href="update.php?username='.$user_name.'&email='.$email.'&q=quizre&step=25&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Restart</b></span></a></b></td></tr>';
        }
        }
        $c=0;
        echo '</table></div></div>';
        }?>

        <!--quiz start-->
        <?php
        if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
        $eid=@$_GET['eid'];
        $sn=@$_GET['n'];
        $total=@$_GET['t'];
        $q=mysqli_query($conn,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
        echo '<div class="panel" style="margin:5%">';
        while($row=mysqli_fetch_array($q) )
        {
        $qns=$row['qns'];
        $qid=$row['qid'];
        echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br />'.$qns.'</b><br /><br />';
        }
        $q=mysqli_query($conn,"SELECT * FROM options WHERE qid='$qid' " );
        echo '<form action="update.php?username='.$user_name.'&email='.$email.'&q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
        <br />';

        while($row=mysqli_fetch_array($q) )
        {
        $option=$row['option'];
        $optionid=$row['optionid'];
        echo'<input type="radio" name="ans" value="'.$optionid.'">'.$option.'<br /><br />';
        }
        echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
        //header("location:dash.php?q=4&step=2&eid=$id&n=$total");
        }
        //result display
        if(@$_GET['q']== 'result' && @$_GET['eid']) 
        {
        $eid=@$_GET['eid'];
        $q=mysqli_query($conn,"SELECT * FROM history WHERE eid='$eid' AND email='$email'" )or die('Error157');
        echo  '<div class="panel">
        <center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

        while($row=mysqli_fetch_array($q) )
        {
        $s=$row['score'];
        $w=$row['wrong'];
        $r=$row['sahi'];
        $qa=$row['level'];
        echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>'.$qa.'</td></tr>
            <tr style="color:#99cc32"><td>right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
            <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
            <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
        }
        $q=mysqli_query($conn,"SELECT * FROM rank WHERE  email='$email' " )or die('Error157');
        while($row=mysqli_fetch_array($q) )
        {
        $s=$row['score'];
        echo '<tr style="color:#990000"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
        }
        echo '</table></div>';

        }
        ?>

        <?php
        //history start
        if(@$_GET['q']== 2) 
        {
        $q=mysqli_query($conn,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
        echo  '<div class="panel title">
        <table class="table table-striped title1" >
        <tr style="color:red"><td><b>S.N.</b></td><td><b>Quiz</b></td><td><b>Question Solved</b></td><td><b>Right</b></td><td><b>Wrong<b></td><td><b>Score</b></td>';
        $c=0;
        while($row=mysqli_fetch_array($q) )
        {
        $eid=$row['eid'];
        $s=$row['score'];
        $w=$row['wrong'];
        $r=$row['sahi'];
        $qa=$row['level'];
        $q23=mysqli_query($conn,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');
        while($row=mysqli_fetch_array($q23) )
        {
        $title=$row['title'];
        }
        $c++;
        echo '<tr><td>'.$c.'</td><td>'.$title.'</td><td>'.$qa.'</td><td>'.$r.'</td><td>'.$w.'</td><td>'.$s.'</td></tr>';
        }
        echo'</table></div>';
        }
        ?>
    </div>
</body>

</html>