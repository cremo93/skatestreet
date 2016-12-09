<?php
	$servername = "127.2.50.2";
	$username = "adminpHgZRmf";
	$database = "streetskateology";
	$password = "bnGlNf9YxIst";

	$conn = mysqli_connect($servername,$username,$password,$database); 
	
	$response=array();
	
	if (isset($_GET['user']) && isset($_GET['tricks']) && isset($_GET['rate'])){
		$_GET['tricks']=str_replace("_"," ",$_GET['tricks']);

		$query="SELECT COUNT(*) as tot,rate FROM rates WHERE user='".$_GET['user']."' AND tricks='".$_GET['tricks']."'";


		$result=mysqli_query($conn,$query);
		if($result){
			$row=mysqli_fetch_array($result);
			$tot=$row['tot'];


			if($tot>0){
				$old_rate=$row['rate'];
				$query="UPDATE rates SET rate=".$_GET['rate']." WHERE user='".$_GET['user']."' AND tricks='".$_GET['tricks']."'";
				$result=mysqli_query($conn,$query);
				if($result){
					$query="SELECT SUM(rate) as total FROM rates WHERE tricks='".$_GET['tricks']."'";
					$result=mysqli_query($conn,$query);
					$row=mysqli_fetch_array($result);
					$sum=$row['total'];
			
					$query="UPDATE tricks SET rating=(".$sum.")/(rating_counter) WHERE name='".$_GET['tricks']."'";
					
					$result=mysqli_query($conn,$query);
					
					if($result){
						$response["success"]=1;
						$response["message"]="Update your rate!";

						$query="SELECT rating,rating_counter FROM tricks WHERE name='".$_GET['tricks']."'";
						$result=mysqli_query($conn,$query);
						$row=mysqli_fetch_array($result);
						$response["rating"]=$row['rating'];
						$response["rating_counter"]=$row['rating_counter'];
					}
					else{
						$response["success"]=0;
						$response["message"]="Update failed!";

					}
				}
				else{
					$response["success"]=0;
					$response["message"]="Failed trick update";
				}
			}
			else{
				$query="INSERT INTO rates VALUES ('".$_GET['user']."','".$_GET['tricks']."',".$_GET['rate'].")";
				$result=mysqli_query($conn,$query);

				if($result){

			
					$query="UPDATE tricks SET rating=(rating + ".$_GET['rate'].")/(rating_counter+1), rating_counter=rating_counter+1 WHERE name='".$_GET['tricks']."'";				
			

					$result=mysqli_query($conn,$query);
		
					if($result){
						$response["message"]="Correct!";
						$response["success"]=1;

						$query="SELECT rating,rating_counter FROM tricks WHERE name='".$_GET['tricks']."'";
						$result=mysqli_query($conn,$query);
						$row=mysqli_fetch_array($result);
						$response["rating"]=$row['rating'];
						$response["rating_counter"]=$row['rating_counter'];
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
		}
		else{
			$response["success"]=0;
			$response["message"]="Oops! Count error!";
		}
		
		

	}
	else{
		$response["message"]="Some parameters not inserted";
		$response["success"]=0;
	}
	
	echo json_encode($response);

?>
