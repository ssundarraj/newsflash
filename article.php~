<html>
	<head>
		<title>NewsFlash</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<script src="script2.js"></script>
	</head>
	<body>
	<div id='allcontent'>
		<div id="topbanner">
			<img src="./images/newsflash.png" alt="NewsFlash-logo">
		</div>
		</br>
		<div id="loginbar">
			<?php
				session_start();
				$form="<form><label>Name: </label><input type='text' name='usrnm' id='username'>"
						."<label>Password: </label><input type='password' name='passwd' id='pswd'>"
						."<input type='button' name='login_butt' onclick='trylogin();' value='Login!' id='login_button'>"
						."</form>";
				if(isset($_SESSION['useronline'])){
					echo("Welcome ".$_SESSION['useronline']);
					echo("<button onclick='logout();'>Logout</button>");			
				}
				else {
					echo $form;
				}
			?>
		</div>
		
		<div id="newscontent">
				<?php
					session_start();
					if(!isset($_SESSION['lnk'])){
						$_SESSION['lnk']=$_POST['articleid'];
						$_SESSION['source1']=$_POST['articlesource'];
					}
					//echo($_SESSION['source']);
					$con=mysqli_connect("localhost","root","pass","newsreader");
					$sql="SELECT * FROM $_SESSION[source1] WHERE link='".$_SESSION['lnk']."'";				
					$result=mysqli_query($con, $sql);
					$row=mysqli_fetch_array($result);
					echo("<h2 class='article'>".$row['title']."</h2><p class='article'>");
					$f=fopen("/var/www/newsreader/sources/".$_SESSION['source1']."/".$row['title'].".txt","r");
					$contents=fgets($f);
					$contents=json_decode($contents);
					echo($contents);
					echo("	<a href='".$row['link']."' target='_blank' >Read original article here.</a></br></p>");
					fclose($f);
					mysqli_close($con);
				?>
				<span><a href="home.php">Back to the latest headlines!</a></span>
		</div>
		</br>
		<div id='moods'>
		<p>How does this make you feel?</p>
		<table id="moods_table" >
		<tbody>
			<tr>
				<td id='happy' onclick='add_moods(this);get_moods();'>
					<img src='./images/happy.png' height='100px' width='100px' alt='happy'></img>
				</td>
				<td id='sad' onclick='add_moods(this);get_moods();'>
					<img src='./images/sad.png' height='100px' width='100px' alt='sad'></img>
				</td>
				<td id='bored' onclick='add_moods(this);get_moods();'>
					<img src='./images/bored.png' height='100px' width='100px' alt='bored'></img>				
				</td>
				<td id='angry' onclick='add_moods(this);get_moods();'>
					<img src='./images/angry.png' height='100px' width='100px' alt='angry'>
				</td>
			</tr>
			<tr id='moods_value'></tr>
		</tbody>
		</table>		
		<form id="moods_form" method="post" enctype="multipart/form-data">
			<input type='hidden' name="mood_click">
		</form>
		</div>
		<div id='comments'>
			<h4>Comments:</h4>
			<div id="form_div">
				<form action="article.php" id='comments_form' method="post" enctype="multipart/form-data">
					<label>Name:</label><input type="text" id='name_input' name="uname"><br>
					<label>Email: </label><input type="text" id='email_input' name="email"><br>
					<label>Comment: </label></br>
					<textarea rows="4" cols="50" id='comment_input' name='comment_input'></textarea></br>
					<input type="button" name="commenting" value="Comment" id="comment_button">
				</form>
			</div>
			<div id='prev_comments'></div>
		</div>
	</div>
	</body>
</html>