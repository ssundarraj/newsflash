<html>
	<head>
		<title>NewsFlash</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<script src="script1.js"></script>
	</head>
	<body>
	<?php
		session_start();
		unset($_SESSION['lnk']);
		unset($_SESSION['source1']);
		function cutoff($text, $length){
							if(strlen($text) > $length){
								$returntext = substr($text, 0, strpos($text, ' ', $length));
							}
							return $returntext;
		}
		
	?>
	<div id='allcontent'>
		<div id="topbanner">
			<img src="./images/newsflash.png" alt="NewsFlash-logo">
		</div>
		<br>
		<div id="loginbar">
			<?php
				unset($_SESSION['lnk']);
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
		</br>
		<div id="newscontent">
			<div id="reco"></div>
			<form action="article.php" id='redirect_form' method="post" enctype="multipart/form-data">
			<div id='thehindu'>
				<a href='http://www.thehindu.com/' target="_blank">
					<img class='sourceimg' src='./images/thehindu.jpg' alt='The Hindu'>
				</a>
				<table border='1' id='content_thehindu'>
				<tbody>
				<tr >
					<?php
						set_time_limit(120);
						//shell_exec('python /var/www/newsreader/scripts/thehindu.py');
						$response="";
						$con=mysqli_connect("localhost","root","pass","newsreader");
						$sql="SELECT * FROM thehindu ORDER BY sno DESC  LIMIT 0, 8";				
						$result=mysqli_query($con, $sql);
						$counter=0; $linebreak=2;
						while($row=mysqli_fetch_array($result)){
							if($counter===0||$counter % $linebreak===0){
								$response=$response."</tr><tr>";										
							}
							$response=$response."<td class='articlecell' id='".$row['link']
									."' onclick='linker(this)'><h2 class='article'><label>".$row['title']
									."</label></h2><p class='article'>";
							$f=fopen("/var/www/newsreader/sources/thehindu/".$row['title'].".txt","r");
							$contents=fgets($f);
							fclose($f);
							$contents=json_decode($contents);
							$response=$response."<label>".cutoff($contents, 250)."</label>...</br></p></td>";
							$counter++;
						}
						mysqli_close($con);
						echo $response;
					?>
				</tr>
				</tbody>
				</table>
			</div>
			<br>
			<div id='bbc'>
				<a href='http://www.bbc.com/news/' target="_blank">
					<img class='sourceimg' width=400px src='./images/bbc.jpg' alt='BBC'>
				</a>
				<table border='1' id='content_bbc'>
				<tbody>
				<tr>
					<?php
						set_time_limit(120);
						//shell_exec('python /var/www/newsreader/scripts/bbc.py');
						$response="";
						//connect to the database which has the details of the files and get the data
						$con=mysqli_connect("localhost","root","pass","newsreader");
						$sql="SELECT * FROM bbc ORDER BY sno DESC LIMIT 0, 8";				
						$result=mysqli_query($con, $sql);
						//iterating the list and displaying each result
						$counter=0; $linebreak=2;
						while($row=mysqli_fetch_array($result)){
							if($counter===0||$counter % $linebreak===0){
								$response=$response."</tr><tr>";										
							}
							$response=$response."<td class='articlecell' id='".$row['link']
									."' onclick='linker(this)'><h2 class='article'><label>".$row['title'].
									"</label></h2><p class='article'>";
							$f=fopen("/var/www/newsreader/sources/bbc/".$row['title'].".txt","r");
							$contents=fgets($f);
							fclose($f);
							$contents=json_decode($contents);
							$response=$response."<label>".cutoff($contents, 250)."</label>...</br></p></td>";
							$counter++;
						}
						mysqli_close($con);
						echo $response;
					?>
				</tr>
				</tbody>
				</table>
			</div>
				<input type='hidden' name="articleid">
				<input type="hidden" name="articlesource">
				</form>
		</div>
		<div id="bottombanner">
			<p>A news reader built by Sriram Sundarraj, NIT Trichy.</p>
		</div>
	</div>
	</body>
</html>