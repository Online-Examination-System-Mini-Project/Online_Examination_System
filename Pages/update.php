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
    $qans=mysqli_query($conn,"INSERT INTO answer VALUES  ('$qid','$ansid')");
    
     }
    header("Location: Teacher_Dashboard.php?q=0");
    }

    //remove quiz
      if(@$_GET['q']== 'rmquiz') {
      $eid=@$_GET['eid'];
      $result = mysqli_query($conn,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
      while($row = mysqli_fetch_array($result)) {
        $qid = $row['qid'];
      $r1 = mysqli_query($conn,"DELETE FROM options WHERE qid='$qid'") or die('Error');
      $r2 = mysqli_query($conn,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
      }
      $r3 = mysqli_query($conn,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
      $r4 = mysqli_query($conn,"DELETE FROM quiz WHERE eid='$eid' ") or die('Error');
      $r4 = mysqli_query($conn,"DELETE FROM history WHERE eid='$eid' ") or die('Error');
      
      header("location:Teacher_Dashboard.php?q=5");
      }

      //remove admin
      if(@$_GET['q']== 'rmadmin') {
      $id=@$_GET['id'];
      $result=mysqli_query($conn,"DELETE FROM admins WHERE adminId='$id'") or die('Error');
      header("location:SuperAdmin_Dashboard.php?q=0");
      }

      //remove user
      if(@$_GET['q']== 'rmuser') {
        $email=@$_GET['email'];
        $result=mysqli_query($conn,"DELETE FROM users WHERE email='$email'") or die('Error');
        header("location:SuperAdmin_Dashboard.php?q=1");
      }

      //remove quiz
      if(@$_GET['q']== 'rmquiz') {
        $eid=@$_GET['eid'];
        $result=mysqli_query($conn,"DELETE FROM quiz WHERE eid='$eid'") or die('Error');
        header("location:SuperAdmin_Dashboard.php?q=6");
      }
    
    //quiz start
    if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
      $eid=@$_GET['eid'];
      $sn=@$_GET['n'];
      $total=@$_GET['t'];
      $ans=$_POST['ans'];
      $qid=@$_GET['qid'];
      $email=$_GET['email'];
      $username=$_GET['username'];
      $time=$_GET['time'];
      $q=mysqli_query($conn,"SELECT * FROM answer WHERE qid='$qid' " );
      while($row=mysqli_fetch_array($q) )
      {
      $ansid=$row['ansid'];
      }
      if($ans == $ansid)
      {
      $q=mysqli_query($conn,"SELECT * FROM quiz WHERE eid='$eid' " );
      while($row=mysqli_fetch_array($q) )
      {
      $sahi=$row['sahi'];
      }
      if($sn == 1)
      {
      $q=mysqli_query($conn,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW())")or die('Error');
      }
      $q=mysqli_query($conn,"SELECT * FROM history WHERE eid='$eid' AND email='$email' ")or die('Error115');
      
      while($row=mysqli_fetch_array($q) )
      {
      $s=$row['score'];
      $r=$row['sahi'];
      }
      $r++;
      $s=$s+$sahi;
      $q=mysqli_query($conn,"UPDATE `history` SET `score`=$s,`level`=$sn,`sahi`=$r, date= NOW()  WHERE  email = '$email' AND eid = '$eid'")or die('Error124');
      
      } 
      else
      {
      $q=mysqli_query($conn,"SELECT * FROM quiz WHERE eid='$eid' " )or die('Error129');
      
      while($row=mysqli_fetch_array($q) )
      {
      $wrong=$row['wrong'];
      }
      if($sn == 1)
      {
      $q=mysqli_query($conn,"INSERT INTO history VALUES('$email','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
      }
      $q=mysqli_query($conn,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error139');
      while($row=mysqli_fetch_array($q) )
      {
      $s=$row['score'];
      $w=$row['wrong'];
      }
      $w++;
      $s=$s-$wrong;
      $q=mysqli_query($conn,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  email = '$email' AND eid = '$eid'")or die('Error147');
      }
      if($sn != $total)
      {
      $sn++;
      header("location:Student_Dashboard.php?username=$username&email=$email&q=quiz&step=2&eid=$eid&n=$sn&t=$total&time=$time")or die('Error152');
      }
      else if( $_SESSION['key']!='sunny7785068889')
      {
      $q=mysqli_query($conn,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
      while($row=mysqli_fetch_array($q) )
      {
      $s=$row['score'];
      }
      $q=mysqli_query($conn,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
      $rowcount=mysqli_num_rows($q);
      if($rowcount == 0)
      {
      $q2=mysqli_query($conn,"INSERT INTO rank VALUES('$email','$s',NOW())")or die('Error165');
      }
      else
      {
      while($row=mysqli_fetch_array($q) )
      {
      $sun=$row['score'];
      }
      $sun=$s+$sun;
      $q=mysqli_query($conn,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
      }
      header("location:Student_Dashboard.php?username=$username&email=$email&q=result&eid=$eid");
      }
      else
      {
      header("location:Student_Dashboard.php?username=$username&email=$email&q=result&eid=$eid");
      }
      }
      
      //restart quiz
      if(@$_GET['q']== 'quizre' && @$_GET['step']== 25 ) {
      $eid=@$_GET['eid'];
      $n=@$_GET['n'];
      $t=@$_GET['t'];
      $username=$_GET['username'];
      $email=$_GET['email'];
      $time=$_GET['time'];
      $q=mysqli_query($conn,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error156');
      while($row=mysqli_fetch_array($q) )
      {
      $s=$row['score'];
      }
      $q=mysqli_query($conn,"DELETE FROM `history` WHERE eid='$eid' AND email='$email' " )or die('Error184');
      $q=mysqli_query($conn,"SELECT * FROM rank WHERE email='$email'" )or die('Error161');
      while($row=mysqli_fetch_array($q) )
      {
      $sun=$row['score'];
      }
      $sun=$sun-$s;
      $q=mysqli_query($conn,"UPDATE `rank` SET `score`=$sun ,time=NOW() WHERE email= '$email'")or die('Error174');
      header("location:Student_Dashboard.php?username=$username&email=$email&q=quiz&step=2&eid=$eid&n=1&t=$t&time=$time");
      }
      
    
?>