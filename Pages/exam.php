<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="../css/student_dashboard.css" rel="stylesheet">
    <link  rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link  rel="stylesheet" href="../css/bootstrap-theme.min.css"/>    
    <link rel="stylesheet" href="../css/main.css">
    <link  rel="stylesheet" href="../css/font.css">
    <script src="../javascript/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"  type="text/javascript"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <title>Exam</title>
    <!--alert message-->
    <?php if(@$_GET['w'])
    {echo'<script>alert("'.@$_GET['w'].'");</script>';}
    ?>
    <!--alert message end-->
    <script language="javascript">
        var Timer;
        var TotalSeconds;

        function CreateTimer(TimerID, Time) 
        {
            Timer = document.getElementById(TimerID);
            TotalSeconds = Time;
            UpdateTimer()
            window.setTimeout("Tick()", 1000);
        }

        function Tick() 
        {
            TotalSeconds -= 1;
            if(TotalSeconds ==-1)
            {
            document.getElementById("form2").submit();
            // Show alert Plus redirect any other page
            }
        else
            {
            UpdateTimer()
            window.setTimeout("Tick()", 1000);
            }
        }

        function UpdateTimer() {
            Timer.innerHTML = TotalSeconds;
        }
    </script>
</head>
<?php
$conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
?>
<body>
    <?php
    $conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
    session_start();
    if(!(isset($_SESSION['email']))){
        header("location:../index.html");
    }
    else{
        $email=$_SESSION['email'];
        $user_name=$_SESSION['username'];
    }
    ?>
    <!--quiz start-->
    <?php
    $conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
    $email=$_SESSION['email'];
    $user_name=$_SESSION['username'];
        if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
        $eid=@$_GET['eid'];
        $sn=@$_GET['n'];
        $total=@$_GET['t'];
        $time=$_GET['time'];
        $q=mysqli_query($conn,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
        echo '<div id="timer" style="color:white; background-image: linear-gradient(to right, rgb(21, 208, 241), rgb(76, 45, 252), rgb(116, 6, 126));width:150px;height:75px;display:flex;justify-content:center;align-items:center;border:2px solid white;font-weight:bold;padding:0px;position:absolute;right:0;top:0;"></div>';
        echo '<script type="text/javascript">window.onload = CreateTimer("timer", '.$time.');</script>';
        echo '<div class="panel" style="margin:5%">';
        while($row=mysqli_fetch_array($q) )
        {
        $qns=$row['qns'];
        $qid=$row['qid'];
        echo '<b>Question &nbsp;'.$sn.'&nbsp;::<br />'.$qns.'</b><br /><br />';

        $q=mysqli_query($conn,"SELECT * FROM options WHERE qid='$qid' " );
        echo '<form action="update.php?username='.$user_name.'&email='.$email.'&q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'&time='.$time.'" method="POST" name="form2" id="form2" class="form-horizontal">
        <br />';

        while($row=mysqli_fetch_array($q) )
        {
        $option=$row['option'];
        $optionid=$row['optionid'];
        echo'<input type="radio" name="ans" value="'.$optionid.'">'.$option.'<br /><br />';
        }
        echo'<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
        }
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

</body>
</html>