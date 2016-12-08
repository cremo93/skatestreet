<?php
	$servername = "127.2.50.2";
	$username = "adminpHgZRmf";
	$database = "streetskateology";
	$password = "bnGlNf9YxIst";

	$conn = mysqli_connect($servername,$username,$password,$database); 
	
	$response=array();
	
	if (isset($_GET['user']) && isset($_GET['tricks']) && isset($_GET['flag'])){

		// flag=0->hate; flag=1->like
		$query="DELETE FROM likes WHERE user='".$_GET['user']."' AND trick='".$_GET['trick']."'";
		$result=mysqli_query($conn,$query);

		if($result){

			if($_GET['flag']==0){
				$query="UPDATE tricks SET dislike=dislike-1 WHERE name='".$_GET['tricks']."'";				
			}
			else{
				$query="UPDATE tricks SET like=like-1 WHERE name='".$_GET['tricks']."'";				
			}

			$result=mysqli_query($conn,$query);
		
			if($result){
				$response["message"]="Correct!";
				$response["success"]=1;
			}
			else{
				$response["message"]="Oops! Update error!";
				$response["success"]=0;
			}
		}
		else{
			$response["message"]="Oops! Insert Error!";
			$response["success"]=0;
			
		}

	}
	else{
		$response["message"]="Some parameters not inserted";
		$response["success"]=0;
	}
	
	echo json_encode($response);

