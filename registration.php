<?php
	$servername = "127.2.50.2";
	$username = "adminpHgZRmf";
	$database = "provinceitaliane";
	$password = "bnGlNf9YxIst";

	$conn = mysqli_connect($servername, $username, $password,$database); 

	$response=array();

	if( isset($_GET['user']) && strlen($_GET['user']) ){
		
		$query="SELECT username FROM users WHERE username='".$_GET['user']."'";
		$result=mysqli_query($conn,$query);

		$row_number=mysqli_num_rows($result);

		// Non presente
		if($row_number==0){
			$query="INSERT INTO users (username) VALUES ('".$_GET['user']."')";
			$result=mysqli_query($conn,$query);

			// Query riuscita
			if($result){
				$response["message"]="Perfect! Your username is ".$_GET['user']."";
				$response["success"]=1;
			}
			// Query fallita
			else{

				$response["message"]="Oops! Registration failed!";
				$response["success"]=0;
			}
		}
		
		// Username già nel database
		else{
			$response["message"]="Try with another username! This one is already in our database!";
			$response["success"]=0;
		}	

	}
	// username lungo o non in $_GET
	else{
		$response["message"]="Name is not inserted or name's length is over 20 characters";
		$response["success"]=0;
	}

	
	echo json_encode($response);
?>
