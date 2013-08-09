<?php
	set_time_limit(120);
	//shell_exec('python /var/www/newsreader/scripts/thehindu.py');
	$response="";
	function cutoff($text, $length){
		if(strlen($text) > $length){
			$returntext = substr($text, 0, strpos($text, ' ', $length));
		}
		return $returntext;
	}
	//connect to the database which has the details of the files and get the data
	$con=mysqli_connect("localhost","root","pass","newsreader");
	$sql="SELECT * FROM thehindu ORDER BY sno DESC  LIMIT 0, 8";				
	$result=mysqli_query($con, $sql);
	//iterating the list and displaying each result
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