<?php
	$servername = "127.2.50.2";
	$username = "adminpHgZRmf";
	$database = "streetskateology";
	$password = "bnGlNf9YxIst";

	$conn = mysqli_connect($servername,$username,$password,$database); 
	
	$response=array();

	if (isset($_GET['rankby'])){
		$query="";
		
			//five most liked
			if($_GET['rankby']==0)
				$query="SELECT * FROM tricks ORDER BY likeSum DESC LIMIT 0,5";
				
			
			
			if($_GET['rankby']==1)
				$query="SELECT * FROM tricks ORDER BY dislike DESC LIMIT 0,5";

			
			if($_GET['rankby']==2)
				$query="SELECT * FROM tricks ORDER BY rating DESC LIMIT 0,5";

		
		$result=mysqli_query($conn,$query);
			if($result){
						
				while($row=mysqli_fetch_result($result)){
					$response["name".$pos]=$row['name'];
					$response["image_url".$pos]=$row['image_url'];
					$response["video_id".$pos]=$row['video_id'];
					$response["rating".$pos]=$row['rating'];
					$response["like".$pos]=$row['likeSum'];
					$response["dislike".$pos]=$row['dislike'];
					$response["rating_counter".$pos]=$row['rating_counter'];
					}
				$response["success"]=1;
				$response["message"]="Rank!";
			}
			else{
				$response["success"]=0;
				$response["message"]="Select error!";
			}

	}else{
		$response["success"]=0;
		$response["message"]="No parameters!";	
	}

	echo json_encode($response);		
?>
