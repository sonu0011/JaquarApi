<?php 
require_once'../Android/DbOperations.php';
$response =array();

if ($_SERVER['REQUEST_METHOD'] =='POST') {
	if (isset($_POST['login_email']) AND 
		isset($_POST['login_pwd'])) {
		$db =new DbOperation();
	$user_id = $db->SignInUser($_POST['login_email'],$_POST['login_pwd']);
		if ($user_id > 0) {
				$response['error'] ='false';
				$response['user_id'] =$user_id;
			
		}
		else {
			$response['error'] ='true';
	        $response['message'] ="Inavlid Username or Password";
		}
		}
else {
	$response['error'] ='true';
	$response['message'] ="All field are required";
}
}
else {
	$response['error'] ='true';
	$response['message'] ="Invalid Request";

}
echo json_encode($response);
 ?>