<?php
	$servername = "127.2.50.2";
	$username = "adminpHgZRmf";
	$database = "streetskateology";
	$password = "bnGlNf9YxIst";

	

	$conn = mysqli_connect($servername,$username,$password,$database); 
	
	$response=array();
	
	if(isset($_GET['user'])){
		$_GET['user']=str_replace("~"," ",$_GET['user']);
		$query="SELECT trick,hateLike FROM likes WHERE user='".$_GET['user']."'";
		$result=mysqli_query($conn,$query);

		// query non corretta
		if($result){
			$pos=0;
			
			//scandisci
			while($row=mysqli_fetch_array($result)){
				
					

				$response["trick".$pos]=$row['trick'];

				$response["hol".$pos]=$row['hateLike'];	
				$pos++;
			}//chiudo while
			
			// setterai ogni elemento come clickable
			if($pos==0) {$response["hol".$pos]=2;}
				
			$response["count"]=$pos;
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
