<?php 
  include("menu.php");
  $cat = $_GET['edit'];
  $query = pg_query($conn, "SELECT * FROM category WHERE cat_name = $cat");
  $row = pg_fetch_array($query);

  if(isset($_POST['update'])){
    $cat      =  $_POST['cat_name'];
    $des      =  $_POST['des'];
    $sql= " UPDATE category SET description='$des'cat_name='$cat' WHERE cat_name=$cat";
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
        <label>Category Name :</label>
        <input type="text" name="cat_name" value="<?php echo $row['cat_name']; ?>"><br>

        <label>Description :</label>
        <textarea name="des" cols="30"><?php echo $row['description'] ?></textarea><br>

        <input style="width: 20%; margin: 10px;" type="submit" name="update" value="Update">
      </form>
</div>
