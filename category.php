<?php 
    include("menu.php");
    function function_alert($message) { 
         // Display the alert box  
        echo "<script>alert('$message');</script>"; 
    }

// Click Del icon
if(isset($_GET['del'])){ 
  $cat = $_GET['del'];
  $sql = "DELETE FROM category WHERE cat_name = $cat";
  if($query = pg_query($conn, $sql)){
    
    function_alert('Deleted success fully!');

    header('location:category.php');
  }
}


//Click Add
if(isset($_POST['add'])){
      $cat      =  $_POST['cat_name'];
      $des      =  $_POST['des'];
      $sql= "INSERT INTO category (cat_name, description) VALUES('$cat', '$des')";
      if ($query = pg_query($conn, $sql)) {
        header("location:category.php");
        function_alert('Added! success fully!');
      }
      else{
        echo '<script language="javascript">Error</script>';
      }
}      
 ?>
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
  <h2 style="text-align: center">Category Management</h2>       
  <table class="table table-striped">
    <thead>
      <tr>
          <th scope="col">Category Name</th>
          <th scope="col">Description</th>
          <th style="text-align: center;" scope="col" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $query = pg_query($conn, "SELECT * FROM category");
            while ($item = pg_fetch_array($query)){ 
        ?>
        <tr>
          <td><?=   $item['cat_name']       ?></td>
          <td><?=   $item['description']    ?></td>
          <td style="text-align: center;"><a href="update.php?edit=<?= $item['cat_name'] ?>"><span style="font-size: 20px;"><i style="color:#FF0094 ; " class="far fa-edit"></i></span></a></td>
          <td style="text-align: center;"><a href="category.php?del=<?= $item['cat_name'] ?>"><span style="font-size: 20px;"><i style="color:#FF0094 ; " class="far fa-trash-alt"></i></span></a></td>
        </tr>
        <?php } ?>       
    </tbody>
  </table>
</div>
<div style="margin: 20px;border: 1px solid gray; text-align: center; width: 50%; position: absolute; left: 50%; transform: translateX(-50%);">
      <h2 style="margin:20px; color:#FF0094; ">Add a new Toy</h2>
      <form method="POST" enctype="multipart/form-data">
        <label>Category Name :</label>
        <input type="text" name="cat_name"><br>

        <label>Description :</label>
        <textarea name="des" cols="30"></textarea><br>

        <input style="width: 20%; margin: 10px;" type="submit" name="add" value="Add Song">
      </form>
    </div>
