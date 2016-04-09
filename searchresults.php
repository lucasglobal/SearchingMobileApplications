<html>
<head>
<title>Hello World!</title>
<body>

<div class="search">
	<form action="searchresults.php" method="post">	
		<input type="text" name="search" placeholder="Search through APIs..."/>
		<input type="text" name="limit" placeholder="How many?"/>
		<input type="submit" value="Search"/>
	</form>


</div>

<div style="overflow:auto;height:500px;">
<?php
if(isset($_POST['search'])){
	$limit = $_POST['limit'];
	$query = $_POST['search'];
	for($i =0;$i < strlen($query); $i++){
		if ($query[$i] == " "){
			$query[$i] = "+";
	 	}
	}
	$appleContent=file_get_contents("https://itunes.apple.com/search?term={$query}&country=us&entity=software&limit=10");
 	$appleJson = json_decode($appleContent, true);
	$appleCount=count($appleJson);
 	echo'<table><th>Image</th><th>Name</th>';
 	for($i=0;$i<$appleCount && $i < $limit;$i++) {
        $appleUr=$appleJson['results'][$i]['artworkUrl512'];
        echo '<tr><td><img src="'.$appleUr.'" width="150px"></td>';
        echo'<td>'.$appleJson['results'][$i]['trackName'].'</td>';
    	echo'</tr>';
        }
 	echo'</table>';
	}
?>
</div>

<div style="overflow:auto;height:500px;">
	<?php
if(isset($_POST['search'])){
	$limit = $_POST['limit'];
	$query = $_POST['search'];
	for($i =0;$i < strlen($query); $i++){
		if ($query[$i] == " "){
			$query[$i] = "+";
	 	}
	}
	$androidContent=file_get_contents("https://42matters.com/api/1/apps/search.json?q={$query}&limit={$limit}&access_token=170d8129d0ccc752e404a1c609126729c57a70cf");
	 $androidJson = json_decode($androidContent, true);
	 $androidCount=count($androidJson);
	 echo'<table><th>Image</th><th>Name</th>';
	 for($i=0;$i<$androidCount && $i < $limit;$i++)
	 {
	 	$androidUr=$androidJson['results'][$i]['icon'];
	    echo '<tr><td><img src="'.$androidUr.'" width="150px"></td>';
	    echo'<td>'.$androidJson['results'][$i]['title'].'</td>';
	    echo'</tr>';
	 }
	 echo'</table>';
}
?>
</div>
</body>
</head>
</html>