<?php
	$servername = "127.2.50.2";
	$username = "adminpHgZRmf";
	$database = "streetskateology";
	$password = "bnGlNf9YxIst";


	$conn = mysqli_connect($servername,$username,$password,$database); 

	$response=array();

	if (isset($_GET['user']) && isset($_GET['tricks'])){
		$_GET['tricks']=str_replace("_"," ",$_GET['tricks']);
		$query="SELECT rate FROM rates WHERE user='".$_GET['user']."' AND trick='".$_GET['tricks']."'";

		$result=mysqli_query($conn,$query);

		if($result){
			$row=mysqli_fetch_result($result);
			if ($row['rate']==null){
				$response["rate"]=$row['rate'];
			}
			else{
				$response["rate"]=$row['rate'];
			}
			
			$response["success"]=1;
			$response["message"]="Give your rate!";
			
		}

		else{
			$response["success"]=0;
			$response["message"]="SELECT ERROR!";
		}
	}
	else{
		$response["success"]=0;
		$response["message"]="Some parameters not inserted";
	}

	echo json_encode($response);
?>
