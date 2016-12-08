<?php
	$servername = "127.2.50.2";
	$username = "adminpHgZRmf";
	$database = "streetskateology";
	$password = "bnGlNf9YxIst";

	

	$conn = mysqli_connect($servername,$username,$password,$database); 
	
	$response=array();
	
	if(isset($_GET['user'])){
		$query="SELECT COUNT(*) AS tot,trick,hateLike FROM likes WHERE user='".$_GET['user']."'";
		$result=mysqli_query($conn,$query);

		// query non corretta
		if($result){
			$pos=0;
			
			//scandisci
			while($row=mysqli_fetch_array($result)){
				if($pos==0) {$response["count"]==$row['tot'];}
					

				$response["trick".$pos]=$row['trick'];

				$response["hol".$pos]=$row['hateLike'];	
				$pos++;	
			}//chiudo while

			// setterai ogni elemento come clickable
			if($pos==0) {$response["hol".$pos]=2;}
				

			$response["success"]=1;
			$response["message"]="Your hate or like!";
		} // chiudo result

		else{
			$response["success"]=0;
			$response["message"]="Wrong query!";
		}	
	}//chiudo getuser
	else{
		$response["success"]=0;
		$response["message"]="Missing user!";

	}
	
	echo json_encode($response);
?>
