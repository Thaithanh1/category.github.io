<?php
require_once ('../../db/dbhelper.php');

$id = $time = $address = $price =  $id_customer = '';
if (!empty($_POST)) {
	if (isset($_POST['time'])) {
		$time = $_POST['time'];
		$time = str_replace('"', '\\"', $time);
	}
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	if (isset($_POST['address'])) {
		$address = $_POST['address'];
		$address = str_replace('"', '\\"', $address);
	}
	if (isset($_POST['price'])) {
		$price = $_POST['price'];
		$price = str_replace('"', '\\"', $price);
	}
	if (isset($_POST['id_customer'])) {
		$id_customer = $_POST['id_customer'];
	}

	if (!empty($time)) {
		$time = date('Y-m-d H:s:i');
		if ($id == '') {
			$sql = 'insert into orderr (datetime, address, total_price, id_customer) values ("'.$time.'", "'.$address.'", "'.$price.'","'.$id_customer.'")';
		}else{
			$sql = 'update orderr set datetime = "'.$time.'",  total_price = "'.$price.'", address = "'.$address.'", id_customer = "'.$id_customer.'" where id = '.$id;
		}
		//Luu vao database
		execute($sql);
		header('Location: index.php');
		die();
	}
}
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = 'select * from orderr where id = '.$id;
	$product = executeSingleResult($sql);
	if($product != null) {
		$time = $product['datetime'];
		$price = $product['total_price'];
		$address = $product['address'];
		$id_customer = $product['id_customer'];
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Thêm/Sửa Danh Mục Sản Phẩm</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	<!-- Summernote -->
	<!-- include summernote css/js -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>
<body>
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a href="../category/" class="nav-link">Quản lý Danh Mục</a>
		</li>
		<li class="nav-item">
			<a href="index.php" class="nav-link">Quản lý Sản Phẩm</a>
		</li>
		<li class="nav-item">
			<a href="../order/" class="nav-link active">Quản lý Hoá Đơn</a>
		</li>
	</ul>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm/Sửa Đơn Hàng</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label for="usr">Ngày tháng:</label>
 						<input type="text" name="id" value="<?=$id?>" hidden="true">
						<input type="date('Y-m-d H:s:i')" required="true" class="form-control" id="time" name="time" value="<?=$time?>">
					</div>
					<div class="form-group">
						<label for="address">Địa chỉ:</label>
						<textarea class="form-control" rows="5" name="address" id="address"><?=$address?></textarea>
					</div>
					<div class="form-group">
						<label for="price">Tổng giá:</label>
						<input type="number" required="true" class="form-control" id="price" name="price" value="<?=$price?>">
					</div>
					
					<div class="form-group">
						<label for="content">Mã khách hàng:</label>
						<input type="text" required="true" class="form-control" id="id_customer" name="id_customer" value="<?=$id_customer?>">					
					</div>
					<button class="btn btn-success">Lưu</button>
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>