<?php
require_once ('../../db/dbhelper.php');
require_once ('../../common/utility.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Quản lý Sản Phẩm</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cndjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<ul class="nav nav-tabs">
	  <li class="nav-item">
	  	<a class="nav-link" href="../category/">Quản lý Danh Mục</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link active" href="#">Quản lý Sản Phẩm</a>
	  </li>
	  <li class="nav-item">
	  	<a class="nav-link" href="../order/">Quản lý Hoá Đơn</a>
	  </li>
	</ul>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Quản lý Sản Phẩm</h2>
			</div>
			<div class="panel-body">
				<a href="add.php">
					<buttom class="btn btn-success" style="margin-bottom: 15px;">Thêm Sản Phẩm</buttom>
				</a>

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>STT</th>
			<th>Hình Ảnh</th>
			<th>Tên Sản Phẩm</th>
			<th>Giá Bán</th>
			<th>Danh Mục</th>
			<th>Ngày Cập Nhật</th>
			<th width="50px"></th>
			<th width="50px"></th>
		</tr>
	</thead>
	<tbody>
		<?php
		//lay danh sach danh muc tu database
		$limit = 15;
		$page = 1;
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
		}
		if ($page <= 0 ) {
			$page = 1;
		}
		$firstIndex = ($page-1)*$limit;
		$sql = 'select product.id, product.title, product.price, product.thumbnail, product.updated_at, category.name category_name from product left join category on product.id_category = category.id'.' limit '.$firstIndex.','.$limit;
		$productList = executeResult($sql);
		$sql = 'select count(id) as total from product where 1 ';
		$countResult = executeSingleResult($sql);
		$number = 0;
		if ($countResult != null) {
		$count = $countResult['total'];
		$number = ceil($count/$limit);

		}
		$index = 1;
		foreach ($productList as $item){
			echo'
				<tr>
					<td>'.(++$firstIndex).'</td>
					<td><img src="'.$item['thumbnail'].'" style="max-width:100px" /></td>
					<td>'.$item['title'].'</td>
					<td>'.$item['price'].'</td>
					<td>'.$item['category_name'].'</td>
					<td>'.$item['updated_at'].'</td>
					<td>
						<a href="add.php?id='.$item['id'].'"><buttom class="btn btn-warning">Sửa</buttom></a>
					</td>
					<td>
						<buttom class="btn btn-danger" onclick="deleteProduct('.$item['id'].')">Xoá</buttom>
					</td>
				</tr>';
		}
		?>
	</tbody>
</table>
			 <!--Bai toan phan trang-->
			 <?=pagination($number, $page, '')?>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function deleteProduct(id){
			var option = confirm('Bạn có muốn xoá sản phẩm này không');
			if (!option) {
				return;
			}
			console.log(id)
			//ajax - lenh post
			$.post('ajax.php', {
				'id': id,
				'action': 'delete',
			}, function(data){
				location.reload()
			}
			)
		}
	</script>
</body>
