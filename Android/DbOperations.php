<?php 

class DbOperation{
	private $con;
	function __construct(){
		include_once(dirname(__FILE__)).'/DbConnection.php';
		$obj  =new DbConnect();
		$this->con = $obj->connect();

	}
	//Sign in user with email and password

	function SignInUser($email,$password){
		// $stmt =$this->con->prepare("SELECT * FROM users  WHERE user_email = ? AND user_pwd = ?");
		// $stmt->bind_param("ss",$email,$password);
		// $stmt->execute();
		// $stmt->store_result();
		// if ($stmt->num_rows == 1) {
		// 	return 1;
		// }
		// else{
		// 	return 0;
		// }
		$result = mysqli_query($this->con,"select * from users where user_email ='$email' && user_pwd ='$password'");
		if ($result) {
			$row =mysqli_fetch_assoc($result);
			
			$user_id = $row['user_id'];

			return $user_id;
			}
			else { 
				return 0;
			}
		
	}
	function FetchCategoty(){
		$sql ="select * from category";
	 	$result = $this->con->query($sql);
	 		$products = array(); 

	 	if ($result->num_rows >0 ) {
	 		while ($row =$result->fetch_assoc()) {
	 					$temp = array();
	 					$temp['cat_id'] =$row['cat_id'];
	 					$temp['cat_name'] =$row['cat_name'];
	 					$temp['image'] ="http://192.168.43.126/Jaquar/Android/".$row['image'];
	 					array_push($products, $temp);

	 		    
	 		}
	 		
	 	}
	 		//displaying the result in json format 
			echo json_encode($products);
	}
	function FetchSubCategory($cat_id){
			$sql ="select * from subcategory where cat_id =$cat_id";
	 		$result = $this->con->query($sql);
	 		$products = array(); 

	 	if ($result->num_rows >0 ) {
	 		while ($row =$result->fetch_assoc()) {
	 					$temp = array();
	 					$temp['subcat_id'] =$row['subcat_id'];
	 					$temp['subcat_name'] =$row['subcat_name'];
	 					$temp['cat_id'] = $row['cat_id'];
	 					$temp['image'] ="http://192.168.43.126/Jaquar/Android/SubCategory/".$row['subcat_image'];
	 					array_push($products, $temp);

	 		    
	 		}
	 		
	 	}
	 		//displaying the result in json format 
			echo json_encode($products);

	}
	function FetchProducts($cat_id,$subcat_id){

			$sql ="select * from Products where cat_id =$cat_id && subcat_id = $subcat_id";
	 		$result = $this->con->query($sql);
	 		$products = array(); 

	 	if ($result->num_rows >0 ) {
	 		while ($row =$result->fetch_assoc()) {
	 					$temp = array();
	 					$temp['cat_id'] =$row['cat_id'];
	 					$temp['subcat_id'] =$row['subcat_id'];
	 					$temp['product_id'] =$row['product_id'];
	 					$temp['product_title'] =$row['product_title'];
	 					$temp['product_price'] = $row['product_price'];
	 					$temp['product_code'] = $row['product_code'];
	 					$temp['product_image'] ="http://192.168.43.126/Jaquar/Android/Products/".$row['product_image'];
	 					array_push($products, $temp);

	 		    
	 		}
	 		
	 	}
	 		//displaying the result in json format 
			echo json_encode($products);
	}
	function FetchSingleProduct($cat_id,$subcat_id,$product_id){

			$sql ="select * from Products where cat_id =$cat_id && subcat_id = $subcat_id && product_id= $product_id";
	 		$result = $this->con->query($sql);
	 		$products = array(); 

	 	if ($result->num_rows >0 ) {
	 		while ($row =$result->fetch_assoc()) {
	 					$temp = array();
	 					$temp['product_id'] =$row['product_id'];
	 					$temp['product_title'] =$row['product_title'];
	 					$temp['product_price'] = $row['product_price'];
	 					$temp['product_code'] = $row['product_code'];
	 					$temp['product_image'] ="http://192.168.43.126/Jaquar/Android/Products/".$row['product_image'];
	 					array_push($products, $temp);

	 		    
	 		}
	 		
	 	}
	 		//displaying the result in json format 
			echo json_encode($products);
	}
	function AddWhishlist($user_id,$product_id){
		$sql1 ="select * from whishlist where user_id = $user_id && product_id = $product_id";
		$result1 = mysqli_query($this->con,$sql1);
		$num_rows = mysqli_num_rows($result1);
		if ($num_rows ==1) {
			return 1;
		}
		else {
			$sql ="INSERT INTO whishlist(user_id, product_id) VALUES ($user_id,$product_id)";
			$result = mysqli_query($this->con,$sql);
			if ($result) {
				return 0;
			// Product is not in whishlist
			
		}
	}


}
function CheckWhishlist($user_id,$product_id){
	$sql1 ="select * from whishlist where user_id = $user_id && product_id = $product_id";
		$result1 = mysqli_query($this->con,$sql1);
				$num_rows = mysqli_num_rows($result1);

		if ($num_rows ==1) {
			return 1;
		}
}
function RemoveFromWhishList($user_id,$product_id){
	$sql ="DELETE FROM whishlist WHERE product_id =$product_id && user_id =$user_id";
	$result1 = mysqli_query($this->con,$sql);
		if ($result1) {
			return 1;
		}

}
function CartWhishlist($user_id,$product_id){
	$sql1 ="select * from whishlist where user_id = $user_id && product_id = $product_id";
		$result1 = mysqli_query($this->con,$sql1);
				$num_rows = mysqli_num_rows($result1);

		if ($num_rows ==1) {
			return 1;
		}
		else {
			return 0;
		}
}
function AddToCart($user_id,$product_id,$product_name,$product_image,
					$product_code,$product_single_price,$product_quantity,
					$product_total_price

){
	$sql1 ="select * from cart where user_id = $user_id && product_id = $product_id";
		$result1 = mysqli_query($this->con,$sql1);
				$num_rows = mysqli_num_rows($result1);

		if ($num_rows ==1) {
			echo 1;
		}
		else {
			$sql ="INSERT INTO cart(user_id, product_id, product_name, product_image, product_code, product_single_price, product_quantity, product_total_price) VALUES ('$user_id',
			'$product_id','$product_name','$product_image','$product_code','$product_single_price',
			'$product_quantity','$product_total_price'

		)";
				 if(mysqli_query($this->con,$sql)){
				 	echo 0;
				 }
				

		}


}
function GetCartProducts($user_id){
$sql ="select * from cart where user_id = $user_id";
$result = mysqli_query($this->con,$sql);
$products =array();
while ($row =mysqli_fetch_assoc($result)) {

    $temp =array();
    $temp['user_id'] = $row['user_id'];
    $temp['product_id'] = $row['product_id'];
    $temp['product_name'] = $row['product_name'];
    $temp['product_image'] = $row['product_image'];
    $temp['product_code'] = $row['product_code'];
    $temp['product_single_price'] = $row['product_single_price'];
    $temp['product_quantity'] = $row['product_quantity'];
    $temp['product_total_price'] = $row['product_total_price'];
array_push($products, $temp);
}
echo json_encode($products);
}
function UpdateItem($user_id,$product_id,$product_quantity,$product_total_price){
	$sql ="UPDATE cart SET product_quantity =$product_quantity,product_total_price = $product_total_price WHERE user_id =$user_id && product_id =$product_id";
	 if(mysqli_query($this->con,$sql)){
	 	return 1;
	 }
}
function RemoveFromCart($user_id,$product_id){

$sql ="DELETE FROM cart WHERE product_id =$product_id && user_id =$user_id";
	$result1 = mysqli_query($this->con,$sql);
		if ($result1) {
			return 1;
		}
}
function TotalPrice($user_id){
	$amount =0;
	$sql ="select * from cart where user_id =$user_id";
	$result =mysqli_query($this->con,$sql);
	while ($row =mysqli_fetch_assoc($result)) {
		$amount =$amount+$row['product_total_price'];
	    
	}
	echo $amount;

}
function NewArrivals(){

			$sql ="select * from Products order by product_id desc limit 5";
	 		$result = $this->con->query($sql);
	 		$products = array(); 

	 	if ($result->num_rows >0 ) {
	 		while ($row =$result->fetch_assoc()) {
	 					$temp = array();
	 					$temp['cat_id'] =$row['cat_id'];
	 					$temp['subcat_id'] =$row['subcat_id'];
	 					$temp['product_id'] =$row['product_id'];
	 					$temp['product_title'] =$row['product_title'];
	 					$temp['product_price'] = $row['product_price'];
	 					$temp['product_code'] = $row['product_code'];
	 					$temp['product_image'] ="http://192.168.43.126/Jaquar/Android/Products/".$row['product_image'];
	 					array_push($products, $temp);

	 		    
	 		}
	 		
	 	}
	 		//displaying the result in json format 
			echo json_encode($products);

}
function WhishlistProducts($user_id){
	$sql ="SELECT * FROM Products INNER JOIN whishlist ON whishlist.user_id = $user_id AND whishlist.product_id =Products.product_id";
		$result = $this->con->query($sql);
	 		$products = array(); 

	 	if ($result->num_rows >0 ) {
	 		while ($row =$result->fetch_assoc()) {
	 					$temp = array();
	 					$temp['cat_id'] =$row['cat_id'];
	 					$temp['subcat_id'] =$row['subcat_id'];
	 					$temp['product_id'] =$row['product_id'];
	 					$temp['product_title'] =$row['product_title'];
	 					$temp['product_price'] = $row['product_price'];
	 					$temp['product_code'] = $row['product_code'];
	 					$temp['product_image'] ="http://192.168.43.126/Jaquar/Android/Products/".$row['product_image'];
	 					array_push($products, $temp);

	 		    
	 		}
	 		
	 	}
	 		//displaying the result in json format 
			echo json_encode($products);
}
function WhishListCount($user_id){
	$sql ="SELECT COUNT(product_id) AS total FROM whishlist WHERE user_id=$user_id";
	$result = mysqli_query($this->con,$sql);
	$row = mysqli_fetch_assoc($result);
     $count = $row['total'];
      echo $count;
}
function SearchForProducts($key){
	$products =array();

	$sql ="select * from Products where product_title like '%$key%'";
	$result = mysqli_query($this->con,$sql);
	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0) {
		while ($row =$result->fetch_assoc()) {
	 					$temp = array();
	 					$temp['cat_id'] =$row['cat_id'];
	 					$temp['subcat_id'] =$row['subcat_id'];
	 					$temp['product_id'] =$row['product_id'];
	 					$temp['product_title'] =$row['product_title'];
	 					$temp['product_price'] = $row['product_price'];
	 					$temp['product_code'] = $row['product_code'];
	 					$temp['product_image'] ="http://192.168.43.126/Jaquar/Android/Products/".$row['product_image'];
	 					array_push($products, $temp);

	 		    
	 		}
	 					echo json_encode($products);

		
	}
	else {
		echo 1;
	}


}
function HomeProducts(){
		$products =array();

	$sql ="select * from Products order by rand() limit 6";
	$result = mysqli_query($this->con,$sql);
	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0) {
		while ($row =$result->fetch_assoc()) {
	 					$temp = array();
	 					$temp['cat_id'] =$row['cat_id'];
	 					$temp['subcat_id'] =$row['subcat_id'];
	 					$temp['product_id'] =$row['product_id'];
	 					$temp['product_title'] =$row['product_title'];
	 					$temp['product_price'] = $row['product_price'];
	 					$temp['product_code'] = $row['product_code'];
	 					$temp['product_image'] ="http://192.168.43.126/Jaquar/Android/Products/".$row['product_image'];
	 					array_push($products, $temp);

	 		    
	 		}
	 					echo json_encode($products);

		
	}


}
function cartCount($user_id){
	$sql ="SELECT COUNT(product_id) AS total FROM cart WHERE user_id=$user_id";
	$result = mysqli_query($this->con,$sql);
	$row = mysqli_fetch_assoc($result);
     $count = $row['total'];
      echo $count;
}
function UpdateProfile($user_id,$user_name,$profile_pic){
	$s =$user_name.$user_id.".jpg";
	$sql ="UPDATE users SET user_name ='$user_name',user_profile_pic ='$s' WHERE user_id =$user_id";
	$upload_path="Uploads/$user_name$user_id.jpg";
	if (mysqli_query($this->con,$sql)) {
		file_put_contents($upload_path, base64_decode($profile_pic));
		echo 1;
		
	}
	else {
		echo 0;
	}

}
function FetchProfileDetails($user_id){
	$products =array();
	$sql ="SELECT * FROM users WHERE user_id =$user_id";
	$result = mysqli_query($this->con,$sql);
	$num_rows = mysqli_num_rows($result);
	if ($num_rows > 0) {
		while ($row =$result->fetch_assoc()) {
	 					$temp = array();
	 					$temp['user_email'] =$row['user_email'];
	 					$temp['user_name'] =$row['user_name'];
	 					$temp['user_profile_pic'] ="http://192.168.43.126/Jaquar/API/Uploads/".$row['user_profile_pic'];
	 					array_push($products, $temp);

	 		    
	 		}
	 					echo json_encode($products);

}

}
}

?>