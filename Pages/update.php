<?php
$conn = mysqli_connect("localhost","root","","database") or die("Connection failed");
//add quiz
    if($_GET['q'] == 'addquiz') {
    $name = $_POST['name'];
    $name= ucwords(strtolower($name));
    $total = $_POST['total'];
    $sahi = $_POST['right'];
    $wrong = $_POST['wrong'];
    $time = $_POST['time'];
    $tag = $_POST['tag'];
    $desc = $_POST['desc'];
    $id=uniqid();
    $q3=mysqli_query($conn,"INSERT INTO quiz(eid,title,sahi,wrong,total,time,intro,tag,date) VALUES  ('$id','$name' , '$sahi' , '$wrong','$total','$time' ,'$desc','$tag', NOW())");
    
    header("Location: Teacher_Dashboard.php?q=4&step=2&eid=$id&n=$total");
    }

    //add question
    //add question
    if($_GET['q']== 'addqns') {
    $n=$_GET['n'];
    $eid=$_GET['eid'];
    $ch=$_GET['ch'];
    
    for($i=1;$i<=$n;$i++)
     {
     $qid=uniqid();
     $qns=$_POST['qns'.$i];
    $q3=mysqli_query($conn,"INSERT INTO questions VALUES  ('$eid','$qid','$qns' , '$ch' , '$i')");
      $oaid=uniqid();
      $obid=uniqid();
    $ocid=uniqid();
    $odid=uniqid();
    $a=$_POST[$i.'1'];
    $b=$_POST[$i.'2'];
    $c=$_POST[$i.'3'];
    $d=$_POST[$i.'4'];
    $qa=mysqli_query($conn,"INSERT INTO options VALUES  ('$qid','$a','$oaid')") or die('Error61');
    $qb=mysqli_query($conn,"INSERT INTO options VALUES  ('$qid','$b','$obid')") or die('Error62');
    $qc=mysqli_query($conn,"INSERT INTO options VALUES  ('$qid','$c','$ocid')") or die('Error63');
    $qd=mysqli_query($conn,"INSERT INTO options VALUES  ('$qid','$d','$odid')") or die('Error64');
    $e=$_POST['ans'.$i];
    switch($e)
    {
    case 'a':
    $ansid=$oaid;
    break;
    case 'b':
    $ansid=$obid;
    break;
    case 'c':
    $ansid=$ocid;
    break;
    case 'd':
    $ansid=$odid;
    break;
    default:
    $ansid=$oaid;
    }
    $qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");
    
     }
    header("Location: Teacher_Dashboard.php?q=0");
    }
    
?>