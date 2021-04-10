	<?php
session_start();

$con = mysqli_connect('localhost', 'root' );
if($con){
	echo"connection successful";
}else{
	echo "no connection";
}

$db = mysqli_select_db($con, 'db_tune');

if(isset($_POST['loginSubmit'])){
	$username=$_POST['name'];
	$password=$_POST['pass'];

	$sql="select * from tb_admin where a_name='$username'
	 and a_password='$password'";
	 $query= mysqli_query($con, $sql);

	 $row= mysqli_num_rows($query);
	 	if($row == 1){
	 		echo "login successful";
	 		$_SESSION['name'] =$username;
	 		header('location:home.php'); 
	 	}else{
	 		echo "login failed";
	 		header('location: home.php');
	 	}
	 
}

?>

