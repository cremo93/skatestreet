<?php
	$servername = "127.2.50.2";
	$username = "adminpHgZRmf";
	$database = "streetskateology";
	$password = "bnGlNf9YxIst";

	$conn = mysqli_connect($servername,$username,$password,$database); 
	
	$response=array();

	if( isset($_GET['user']) && strlen($_GET['user'])){
		$query="SELECT username FROM users WHERE username='".$_GET['user']."'";
		$result=mysqli_query($conn,$query);

		$rows=mysqli_num_rows($result);
		
		if($rows==0){
			$response["message"]=$_GET['user']." is not existing";
			$response["success"]=0;
		}
		else{
			$response["message"]="Welcome back ".$_GET['user'];
			$response["success"]=1;
		}	

	}
	else{	
		$response["message"]="Name is not inserted or name's length is over 20 characters";
		$response["success"]=0;
	}

	echo json_encode($response);
?>
