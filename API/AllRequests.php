<?php 
require_once'../Android/DbOperations.php';
$db =new DbOperation();
if ($_SERVER['REQUEST_METHOD'] =='POST') {
	if (isset($_POST['shop_by_category'])) {
			$db->FetchCategoty();
	}
	if (isset($_POST['sub_category']) AND isset($_POST['cat_id'])) {
		$db->FetchSubCategory($_POST['cat_id']);
	}
	if (isset($_POST['products']) AND isset($_POST['cat_id']) AND isset($_POST['parent_id'])) {
		$db->FetchProducts($_POST['cat_id'],$_POST['parent_id']);
		
	}
	if (isset($_POST['SingleProduct'])) {
		$db->FetchSingleProduct($_POST['cat_id'],$_POST['subcat_id'],$_POST['product_id']);
		
	}
	if (isset($_POST['whishlist'])) {
		$res = $db->AddWhishlist($_POST['user_id'],$_POST['product_id']);
		echo $res;
		
	}
	if (isset($_POST['checkwhishlist'])) {
		$result =$db->CheckWhishlist($_POST['user_id'],$_POST['product_id']);
		echo $result;
	}
	if (isset($_POST['removefromwhishlist'])) {
		$res =$db->RemoveFromWhishList($_POST['user_id'],$_POST['product_id']);
		echo $res;
		
	}
	if (isset($_POST['cartwhishlist'])) {
		$res =$db->CartWhishlist($_POST['user_id'],$_POST['product_id']);
		echo $res;
		
	}
	if (isset($_POST['addtocart'])) {
		$res = $db->AddToCart(
			$_POST['user_id'],
			$_POST['product_id'],
			$_POST['product_name'],
			$_POST['product_image'],
			$_POST['product_code'],
			$_POST['product_single_price'],
			$_POST['product_quantity'],
			$_POST['product_total_price']

		);
		echo $res;
		
	}
	if (isset($_POST['getcartProduct'])) {
		$res =$db->GetCartProducts($_POST['user_id']);
		echo $res;
		
	}
	if (isset($_POST['UpdateItem'])) {
		$res  =$db->UpdateItem($_POST['user_id'],
								$_POST['product_id'],
								$_POST['product_quantity'],
								$_POST['total_price']

	);	
	echo $res;	
	}
	if (isset($_POST['RemoveFromCart'])) {
		$res =$db->RemoveFromCart($_POST['user_id'],$_POST['product_id']);
		echo $res;
		
	}
	if (isset($_POST['TotalPrice'])) {
		$res =$db->TotalPrice($_POST['user_id']);
		echo $res;
		
	}
	if (isset($_POST['newArrivals'])) {
		$res =$db->NewArrivals();
		echo $res;
		
	}
	if (isset($_POST['WhishlistProducts'])) {
		$res =$db->WhishlistProducts($_POST['user_id']);
		echo $res;
		
	}
	if (isset($_POST['getWhishCount'])) {
		$res =$db->WhishListCount($_POST['user_id']);
		echo $res;
		
	}
	if (isset($_POST['SearchForProducts'])) {
		$res =$db->SearchForProducts($_POST['key']);
		echo $res;
		
	}
	if (isset($_POST['HomeProducts'])) {
		$res = $db->HomeProducts();
		echo $res;
		
	}
	if (isset($_POST['cartcount'])) {
		$res = $db->cartCount($_POST['user_id']);
		echo $res;
		
	}
	if (isset($_POST['UpdateProfile'])) {
		$res = $db->UpdateProfile($_POST['user_id'],$_POST['user_name'],$_POST['profile_pic']);
		echo $res;
		
	}
	if (isset($_POST['fetchprofiledetails'])) {
		$res =$db->FetchProfileDetails($_POST['user_id']);
		echo $res;
		
	}
	
}

?>