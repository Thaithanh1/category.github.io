<?php
require_once ('../../db/dbhelper.php');

$id = $title = $price = $thumbnail = $content = $id_category = '';
if (!empty($_POST)) {
	if (isset($_POST['title'])) {
		$title = $_POST['title'];
		$title = str_replace('"', '\\"', $title);
	}
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	if (isset($_POST['price'])) {
		$price = $_POST['price'];
		$price = str_replace('"', '\\"', $price);
	}
	if (isset($_POST['thumbnail'])) {
		$thumbnail = $_POST['thumbnail'];
		$thumbnail = str_replace('"', '\\"', $thumbnail);
	}
	if (isset($_POST['content'])) {
		$content = $_POST['content'];
		$content = str_replace('"', '\\"', $content);
	}
	if (isset($_POST['id_category'])) {
		$id_category = $_POST['id_category'];
	}

	if (!empty($title)) {
		$created_at = $updated_at = date('Y-m-d H:s:i');
		if ($id == '') {
			$sql = 'insert into product (title, thumbnail, price, content, id_category, created_at, updated_at) values ("'.$title.'", "'.$thumbnail.'", "'.$price.'", "'.$content.'", "'.$id_category.'", "'.$created_at.'", "'.$updated_at.'")';
		}else{
			$sql = 'update product set title = "'.$title.'", updated_at = "'.$updated_at.'", price = "'.$price.'", thumbnail = "'.$thumbnail.'", content = "'.$content.'", id_category = "'.$id_category.'" where id = '.$id;
		}
		//Luu vao database
		execute($sql);
		header('Location: index.php');
		die();
	}
}
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = 'select * from product where id = '.$id;
	$product = executeSingleResult($sql);
	if($product != null) {
		$title = $product['title'];
		$price = $product['price'];
		$thumbnail = $product['thumbnail'];
		$id_category = $product['id_category'];
		$content = $product['content'];
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
			<a href="../order/" class="nav-link">Quản lý Hoá Đơn</a>
		</li>
	</ul>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Thêm/Sửa Sản Phẩm</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label for="usr">Tên Sản Phẩm:</label>
						<input type="text" name="id" value="<?=$id?>" hidden="true">
						<input type="text" required="true" class="form-control" id="title" name="title" value="<?=$title?>">
					</div>
					<div class="form-group">
						<label for="price">Chọn danh mục:</label>
						<select class="form-control" id="id_category" name="id_category">
							<option>-- Lựa chọn Danh Mục --</option>
							<?php
								$sql = 'select * from category';
								$productList = executeResult($sql);
								foreach ($productList as $item ) {
									if ($item['id'] == $id_category) {
										echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';
									}else{
										echo '<option selected value="'.$item['id'].'">'.$item['name'].'</option> ';
									}
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="price">Giá bán:</label>
						<input type="number" required="true" class="form-control" id="price" name="price" value="<?=$price?>">
					</div>
					<div class="form-group">
						<label for="thumbnail">Thumbnail:</label>
						<input  type="text" required="true" class="form-group" id="thumbnail"  name="thumbnail" value="<?=$thumbnail?>" onchange="updateThumbnail()">
						<img src="<?=$thumbnail?>" style="max-width: 200px" id="img_thumbnail">
					</div>
					<div class="form-group">
						<label for="content">Nội dung:</label>
						<textarea class="form-control" rows="5" name="content" id="content"><?=$content?></textarea>
					</div>
					<button class="btn btn-success">Lưu</button>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		function updateThumbnail() {
			$('#img_thumbnail').attr('src', $('#thumbnail').val())
		}
		$( function() {
			//doi website load noi dung ==> xu ly phan js
			$('#content').summernote({
				height: 150, //set editable area's height
				codemirror: { //codemirror options
					theme: 'monokai'
				}
			})
		})
	</script>
</body>
</html>