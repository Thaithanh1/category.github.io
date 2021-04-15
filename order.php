<?php 
    include("menu.php");
    function function_alert($message) { 
         // Display the alert box  
        echo "<script>alert('$message');</script>"; 
    }

// Click Del icon
if(isset($_GET['del'])){ 
  $id = $_GET['del'];
  $sql = "DELETE FROM orders WHERE orderid = $id";
  if($query = pg_query($conn, $sql)){
    
    function_alert('Deleted success fully!');

    header('location:order.php');
  }
}


//Click Add
if(isset($_POST['add'])){
      $cName  =  $_POST['customer_name'];
      $date     =  date("Y-m-d"); 
      $price    =  $_POST['price'];
      $cAddress      =  $_POST['customer_address'];
      $cPhone    =  $_POST['customer_phone'];
      $pay    = $_POST['pay']
      $sql= "INSERT INTO orders (customer_name, customer_address, total_price, date_modified, customer_phone, pay) VALUES($cName, $cAddress, $price, $date, $cPhone, $pay)";
      if ($query = pg_query($conn, $sql)) {
        header("location:order.php");
        function_alert('Added! success fully!');
      }
      else{
        echo '<script language="javascript">Error</script>';
      }
}      
 ?>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 <style type="text/css">
   input{
    border: none;
    outline:none; 
    width: 30%;
  }
  th, tr{
    text-align: center;
  }
  input:hover[type="submit"] 
    {
      background: #3188ee;
    }
  
 </style>
 <div class="container">
   <div class="panel panel-primary">
			<div class="panel-heading">
  <h2 style="text-align: center">Order Management</h2>       
  <table class="table table-striped">
    <thead>
      <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Address</th>
          <th scope="col">CellPhone</th>
          <th scope="col">TotalPrice</th>
          <th scope="col">Updated_at</th>
          <th scope="col">Pay</th>
          <th style="text-align: center;" scope="col" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $query = pg_query($conn, "SELECT * FROM orders");
            while ($item = pg_fetch_array($query)){ 
        ?>
        <tr>
          <th scope="row"><?= $item['orderid'] ?></th>
          <td><?=   $item['customer_name']   ?></td>
          <td><?=   $item['customer_address']       ?></td>
          <td><?=   $item['customer_phone']       ?></td>
          <td><?= number_format($item['total_price'],2) ?> $</td>
          <td><?= $item['date_modified'] ?></td>
          <td><?=   $item['pay']  ?></td>
          <td style="text-align: center;"><a href="updatedr.php?edit=<?= $item['orderid'] ?>"><span style="font-size: 20px;"><i style="color:#FF0094 ; " class="far fa-edit"></i></span></a></td>
          <td style="text-align: center;"><a href="order.php?del=<?= $item['orderid'] ?>"><span style="font-size: 20px;"><i style="color:#FF0094 ; " class="far fa-trash-alt"></i></span></a></td>
        </tr>
        <?php } ?>       
    </tbody>
  </table>
	   </div>
	 </div>
</div>
<div style="margin: 20px;border: 1px solid gray; text-align: center; width: 50%; position: absolute; left: 50%; transform: translateX(-50%);">
      <h2 style="margin:20px; color:#FF0094; ">Add a new Order</h2>
      <form method="POST" enctype="multipart/form-data">
        <label>Customer Name :</label>
        <input type="text" name="customer_name"><br>
        
        <label>Address :</label>
        <input type="text" name="customer_address"><br>
        
        <label>CellPhone :</label>
        <input type="text" name="customer_phone"><br>
        
         <label>TotalPrice :</label>
        <input type="text" name="price" pattern="[0-9]+" title="please enter number only" max="999" min="1" required="required"><br>

        <label>Pay :</label>
        <select name="pay" style="width: 30%; color:#FF0094; background:#343A40; ">
          
          <option>CreditCard</option>
          <option>PayPall</option>
          <option>Momo</option>
          <option>Visa</option>
          <option>BIDV</option>

        </select><br>

       

        <input style="width: 20%; margin: 10px;" type="submit" name="add" value="Add ">
      </form>
    </div>
