<?php
	session_start();
	$con=mysqli_connect("localhost","root","pass","newsreader");
	$sql="SELECT * FROM ".$_SESSION['source1']." WHERE link='".$_SESSION['lnk']."'";
	$result=mysqli_query($con, $sql);
	$row=mysqli_fetch_array($result);
	$new=0;
	$sno=$row['sno'];
	if($_POST['mood_click']=='happy') {
		$new=$row['happy']+1;			
		$sql="UPDATE ".$_SESSION['source1']." SET happy=".strval($new)." WHERE sno=". strval($sno) .";";
		$result=mysqli_query($con, $sql);
	}
	else if($_POST['mood_click']=='sad') {
		$new=$row['sad']+1;			
		$sql="UPDATE ".$_SESSION['source1']." SET sad=".strval($new)." WHERE sno=". strval($sno) .";";
		$result=mysqli_query($con, $sql);
	}
	if($_POST['mood_click']=='angry') {
		$new=$row['angry']+1;			
		$sql="UPDATE ".$_SESSION['source1']." SET angry=".strval($new)." WHERE sno=". strval($sno) .";";
		$result=mysqli_query($con, $sql);
	}
	if($_POST['mood_click']=='bored') {
		$new=$row['bored']+1;			
		$sql="UPDATE ".$_SESSION['source1']." SET bored=".strval($new)." WHERE sno=". strval($sno) .";";
		$result=mysqli_query($con, $sql);
	}
	mysqli_close();
?>