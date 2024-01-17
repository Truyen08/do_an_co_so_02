<?php
	session_start();
	include('db/connect.php');

?>

<?php
	include('include/topbar.php');
	include('include/menu.php');
	include('include/slider.php');

	if(isset($_GET['quanli'])){
		$tam = $_GET['quanli'];
	}else{
		$tam = '';
	}

	if($tam == 'danhmuc'){
		include('include/danhmuc.php');
	} else if ($tam == 'chitietsp'){
		include('include/chitietsp.php');
	} else if ($tam == 'giohang'){
		include('include/giohang.php');
	}else if($tam == 'timkiem'){
		include('include/timkiem.php');
	}
	else {
		include('include/home.php');
	}
	

	include('include/footer.php');
?>


