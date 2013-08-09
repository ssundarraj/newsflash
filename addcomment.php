<?php
			session_start();
			$con=mysqli_connect("localhost","root","pass","newsreader");
			$sql="SELECT * FROM ".$_SESSION['source1']." WHERE link='".$_SESSION['lnk']."'";
			$result=mysqli_query($con, $sql);
			$row=mysqli_fetch_array($result);
			$_SESSION['title']=$row['title'];
			$_SESSION['sno']=$_SESSION['source1'].$row['sno'];
			$sql="CREATE TABLE IF NOT EXISTS $_SESSION[sno] (cno INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,"
					."name char(50), email char(50), comment varchar(500))";
			$result=mysqli_query($con, $sql);
			$sql="INSERT INTO $_SESSION[sno] (name, email, comment)"
				." VALUES('$_POST[uname]', '$_POST[email]', '$_POST[comment_input]')";
			$result=mysqli_query($con, $sql);
			mysqli_close($con);
?>