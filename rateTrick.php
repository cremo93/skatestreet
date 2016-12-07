<?php
	$servername = "127.2.50.2";
	$username = "adminpHgZRmf";
	$database = "streetskateology";
	$password = "bnGlNf9YxIst";

	$conn = mysqli_connect($servername,$username,$password,$database); 
	
	$response=array();
	
	if (isset($_GET['user']) && isset($_GET['tricks']) && isset($_GET['rate'])){

		
		$query="INSERT INTO rates VALUES ('".$_GET['user']."','".$_GET['tricks']."',".$_GET['rate'].")";
		$result=mysqli_query($conn,$query);

		if($result){

			
			$query="UPDATE tricks SET rating=(rating + ".$_GET['rate'].")/(rating_counter+1), rating_counter=rating_counter+1 WHERE name='".$_GET['tricks']."'";				
			

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

?>
