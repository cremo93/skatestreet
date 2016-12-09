<?php
	$servername = "127.2.50.2";
	$username = "adminpHgZRmf";
	$database = "streetskateology";
	$password = "bnGlNf9YxIst";

	$conn = mysqli_connect($servername,$username,$password,$database); 
	
	$response=array();
		
	$pos=0;
	$query="SELECT COUNT(*) as tot FROM tricks";
	$result=mysqli_query($conn,$query);

	$row=mysqli_fetch_array($result);

	$count=$row['tot'];
	
	$query="SELECT * FROM tricks";

	$result=mysqli_query($conn,$query);
	
	if($result){
		$response["message"]="Get all info";
		$response["success"]=1;
	
		while($row=mysqli_fetch_array($result)){
			$response["name".$pos]=$row['name'];
			$response["image_url".$pos]=$row['image_url'];
			$response["video_id".$pos]=$row['video_id'];
			$response["rating".$pos]=$row['rating'];
			$response["like".$pos]=$row['likeSum'];
			$response["dislike".$pos]=$row['dislike'];
			$response["rating_counter".$pos]=$row['rating_counter'];
			$pos++;
		
		}
		$response["count"]=$count;
	}

	else{
		$response["message"]="Ooops! An error occured";
		$response["success"]=0;
	}
	

	echo json_encode($response);
?>
