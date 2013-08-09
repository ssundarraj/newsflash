<?php
			session_start();
			$con=mysqli_connect("localhost","root","pass","newsreader");
			$sql="SELECT * FROM $_SESSION[source1] WHERE link='".$_SESSION['lnk']."'";
			$result=mysqli_query($con, $sql);
			$row=mysqli_fetch_array($result);
			$response='<td><label>'.$row['happy'].'</label></td>'
						.'<td><label>'.$row['sad'].'</label></td>'
						.'<td><label>'.$row['bored'].'</label></td>'
						.'<td><label>'.$row['angry'].'</label></td>';
			mysqli_close($con);
			echo $response;
?>