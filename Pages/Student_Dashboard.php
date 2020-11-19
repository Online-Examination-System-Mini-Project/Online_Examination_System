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
    <div id="container">
        <div id="header">
            <div id="header1">
                <div id="logo"><img src="../images/1.png"></div>
                <div id="right-header1">
                    <a href="Signout.php?q=../index.html"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;Sign out</a>
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
                <form method="POST" id="form1" action="Student_Dashboard.php?username=<?php echo $user_name?>&email=<?php echo $email ?>&q=3">
                    <input type="text" id="tag" name="tag" size="20"  placeholder="Enter Tag">&nbsp;&nbsp;
                    <button id="search-btn"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;Search</button>
                </form>
            </ul>
        </div>

        <?php if(@$_GET['q']==3){
            $tag = $_POST['tag'];
            $result1 = mysqli_query($conn,"SELECT * FROM quiz WHERE tag='$tag'") or die('Error');
            echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
            <tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
            $c=1;
            while($row = mysqli_fetch_array($result1)) {
                $title = $row['title'];
                $total = $row['total'];
                $sahi = $row['sahi'];
                $time = $row['time'];
                $eid = $row['eid'];
            $q12=mysqli_query($conn,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
            $rowcount=mysqli_num_rows($q12);	
            if($rowcount == 0){
                echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;sec</td>
                <td onclick="quizstart()" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></td></tr>';
                echo'<script type="text/javascript">function quizstart(){window.open("exam.php?username='.$user_name.'&email='.$email.'&q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'&time='.$time.'","MyWindow","width=3000px,height=3000px");}</script>';
            }
            else{
                echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;sec</td>
                <td class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Done</b></span></td></tr>';
            }
            }
            $c=0;
            echo '</table></div></div>';
            }
            
        ?>
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
            echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;sec</td>
            <td onclick="quizstart()" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></td></tr>';
            echo'<script type="text/javascript">function quizstart(){window.open("exam.php?username='.$user_name.'&email='.$email.'&q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'&time='.$time.'","MyWindow","width=3000px,height=3000px");}</script>';
        }
        else{
            echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;sec</td>
            <td class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Done</b></span></td></tr>';
        }
        }
        $c=0;
        echo '</table></div></div>';
        }?>

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