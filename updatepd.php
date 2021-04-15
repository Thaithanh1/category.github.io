<?php 
  include("menu.php");
  $id = $_GET['edit'];
  $query = pg_query($conn, "SELECT * FROM product WHERE product_id = $id");
  $row = pg_fetch_array($query);

  if(isset($_POST['update'])){
    $id       = $_GET['edit'];
    $toyName  =  $_POST['product_name'];
    $time     =  date("Y-m-d"); 
    $price    =  $_POST['price'];
    $cat      =  $_POST['cat_name'];
    $file1    =  $_FILES['Img'];
    $img      =  $file1['name'];
    $des      =  $_POST['des'];
    $supplier =  $_POST['supplier'];
    move_uploaded_file($file1['tmp_name'], "images/".$img);
    $sql= " UPDATE product SET image='$img', description='$des', price=$price, supplier='$supplier', date_modified='$time', cat_name='$cat', product_name='$toyName' WHERE product_id=$id";
    if ($query = pg_query($conn, $sql)) {
      header("location:product.php");
      function_alert('Added! success fully!');
    }
    else{
        echo '<script language="javascript">Error</script>';
    }
  }
?>
<div style="margin: 20px;border: 1px solid gray; text-align: center; width: 50%; position: absolute; left: 50%; transform: translateX(-50%);">
      <h2 style="margin:20px; color:#FF0094; ">Update a Toy</h2>
      <form method="POST" enctype="multipart/form-data">
        <label>Toy Name :</label>
        <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>"><br>

        <label>Image :</label>
        <input name="Img" type="file"><br>

        <label>Category :</label>
        <select name="cat_name" style="width: 30%; color:"black; background:"white">

          <?php 
            $sql1 = "SELECT * FROM category";
            $query1 = pg_query($conn, $sql1);
            while($option = pg_fetch_array($query1)){
          ?>
          <option value="<?= $option['cat_name'] ?>"></option>
          <?php } ?>

        </select><br>

        <label>Price :</label>
        <input type="text" name="price" pattern="[0-9]+" title="please enter number only" max="999" min="1" required="required" value="<?php echo $row['price']; ?>"><br>

        <label>Description :</label>
        <textarea name="des" cols="30"><?php echo $row['description'] ?></textarea><br>

        <input style="width: 20%; margin: 10px;" type="submit" name="update" value="Update">
      </form>
</div>
