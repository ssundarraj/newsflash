<?php
	session_start();
	function cutoff($text, $length){
		if(strlen($text) > $length){
			$returntext = substr($text, 0, strpos($text, ' ', $length));
		}
		return $returntext;
	}

	if(isset($_SESSION['useronline'])){
		$con=mysqli_connect("localhost","root","pass","newsreader");
		$sql="SELECT * FROM users WHERE username='".$_SESSION['useronline']."'";
		$result=mysqli_query($con, $sql);
		$row=mysqli_fetch_array($result);
		$total=20;
		
		$totalvotes=$row['happy']+$row['sad']+$row['angry']+$row['bored'];
		$happy=(int)($total * $row['happy']/$totalvotes);
		$sad=$total * $row['sad']/$totalvotes;
		$angry=$total * $row['angry']/$totalvotes;
		$bored=$total * $row['bored']/$totalvotes;
		
		$response="<table><tr>";
		$counter=0; $linebreak=2;
		
		$sql="SELECT * from thehindu order by sno desc, happy desc limit 0, ".$happy;
		$result=mysqli_query($con, $sql);
		while($row=mysqli_fetch_array($result)){
			if($counter===0||$counter % $linebreak===0){
				$response=$response."</tr><tr>";										
			}
			$response=$response."<td class='articlecell' id='".$row['link']
										."' onclick='recolinker(this)'><h2 class='article'><label>".$row['title']
										."</label></h2><p class='article'>";
			$f=fopen("/var/www/newsreader/sources/thehindu/".$row['title'].".txt","r");
			$contents=fgets($f);
			fclose($f);
			$contents=json_decode($contents);
			$response=$response."<label>".cutoff($contents, 250)."</label>...</br></p></td>";
			$counter++;
		}
	
		$sql="SELECT * from thehindu order by sno desc, angry desc limit 0, ".$angry;
			$result=mysqli_query($con, $sql);
			while($row=mysqli_fetch_array($result)){
				if($counter===0||$counter % $linebreak===0){
					$response=$response."</tr><tr>";										
				}
				$response=$response."<td class='articlecell' id='".$row['link']
											."' onclick='recolinker(this)'><h2 class='article'><label>".$row['title']
											."</label></h2><p class='article'>";
				$f=fopen("/var/www/newsreader/sources/thehindu/".$row['title'].".txt","r");
				$contents=fgets($f);
				fclose($f);
				$contents=json_decode($contents);
				$response=$response."<label>".cutoff($contents, 250)."</label>...</br></p></td>";
				$counter++;
			}
		$sql="SELECT * from thehindu order by sno desc, sad desc limit 0, ".$sad;
			$result=mysqli_query($con, $sql);
			while($row=mysqli_fetch_array($result)){
				if($counter===0||$counter % $linebreak===0){
					$response=$response."</tr><tr>";										
				}
				$response=$response."<td class='articlecell' id='".$row['link']
											."' onclick='recolinker(this)'><h2 class='article'><label>".$row['title']
											."</label></h2><p class='article'>";
				$f=fopen("/var/www/newsreader/sources/thehindu/".$row['title'].".txt","r");
				$contents=fgets($f);
				fclose($f);
				$contents=json_decode($contents);
				$response=$response."<label>".cutoff($contents, 250)."</label>...</br></p></td>";
				$counter++;
			}
		
		$sql="SELECT * from thehindu order by sno desc, bored desc limit 0, ".$bored;
		$result=mysqli_query($con, $sql);
		while($row=mysqli_fetch_array($result)){
			if($counter===0||$counter % $linebreak===0){
				$response=$response."</tr><tr>";										
			}
			$response=$response."<td class='articlecell' id='".$row['link']
										."' onclick='recolinker(this)'><h2 class='article'><label>".$row['title']
										."</label></h2><p class='article'>";
			$f=fopen("/var/www/newsreader/sources/thehindu/".$row['title'].".txt","r");
			$contents=fgets($f);
			fclose($f);
			$contents=json_decode($contents);
			$response=$response."<label>".cutoff($contents, 250)."</label>...</br></p></td>";
			$counter++;
		}
		$response=$response."</tr></table>";
	}
	else {
		$response="Please login to get recommendations.";
	}
	echo $response;
?>