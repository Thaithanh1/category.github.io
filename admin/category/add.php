<?php
require_once ('../../db2/dbhelper.php');

$id = $name = $description= '';
if (!empty($_POST)) {
	$name = '';
	if (isset($_POST['name'])) {
		$name = $_POST['name'];
		$name = str_replace('""', '\\"', $name);
	}
	if (isset($_POST['description'])) {
		$description = $_POST['description'];
		$description = str_replace('""', '\\"', $description);
	}
	if (isset($_POST['id'])) {
		$id = $_POST['id'];
	}
	if (!empty($name)) {
		if ($id == '') {
			$sql = 'insert into category(name, description) values ("'.$name.'", "'.$description.'")';
		}else{
			$sql = 'update category set name = "'.$name.'",  updated_at="'.$upddated_at.'" where id = '.$id;
		}
		//Luu vao database
		execute($sql);
		header('Location: index.php');
		die();
	}
}

if (isset($_GET['cat_name'])) {
	$name = $_GET['cat_name'];
	$sql = 'select * from category where cat_name ='.$name;
	$category = executeSingleResult($sql);
	if ($category != null) {
		$name = $category['cat_name'];
		$description = $category['description']	
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add/Repair Category</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a href="index.php" class="nav-link">Category Management</a>
		</li>
		<li class="nav-item">
			<a href="../product/" class="nav-link">Product Management</a>		
		</li>
		<li class="nav-item">
			<a href="../order/" class="nav-link">Order Management</a>
		</li>
	</ul>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Add/Repair Category</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
						<label for="usr">Name:</label>
						<input required="true" type="text" class="form-control" id="name" name="name" value="<?=$name?>">
					</div>
					<div class="form-group">
						<label for="des">Description:</label>
						<input required="true" type="text" class="form-control" id="description" name="description" value="<?=$description?>">
					</div>
					<button class="btn btn-success">Save</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>