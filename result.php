<html>

<head>
		<title>InstaSearch</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<?php
	session_start();
	$access_token=$_SESSION['tok'];
	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?access_token='.$token);
	//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);	
	curl_setopt($ch	, CURLOPT_RETURNTRANSFER, 1);
	$response = curl_exec($ch);
	curl_close($ch);

	$response=json_decode($response);
	for($i=0; $i<sizeof($response->data); $i=$i+1){
		//echo $i;
		//echo $response->data[0]->images->low_resolution->url;
		$ch=curl_init();
		curl_setopt($ch, CURLOPT_URL, $response->data[$i]->images->low_resolution->url);
		curl_setopt($ch	, CURLOPT_RETURNTRANSFER, 1);
		$img=curl_exec($ch);
		//echo($img);
		curl_close($ch);
		$file=fopen('instaimage_'.$tag.'_'.$i.'.jpg', 'w');
		fwrite($file, $img);
		fclose($file);
	}
?>

</html>