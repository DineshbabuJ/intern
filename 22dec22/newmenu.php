<?php
include "header.php";
include "connect.php";
if (isset($_POST['addmenu'])) {
    $menu_name=$_POST['menu_name'];
    $price=$_POST['price'];
  
    $sql = "INSERT INTO menu (menu_name, price) VALUES ('$menu_name', '$price')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $menu_id=$conn->insert_id;
        header("Location: updatemenu.php?id=".$menu_id);
    }
    else{
      echo $conn->error;
    }
}
?>
<div class="row">
    <div class="col-md-8 text-center">
    <h1 class="text-center"> Add Customer </h1>
    </div>
</div>
<div class="row">
<div class="col-md-8" style="margin-right:auto;margin-left:auto;">

<div class="card">
  <div class="card-body">
<form action="newmenu.php" method="post">
  <div class="form-group">
    <label for="Username">Menu Name:</label>
    <input type="text" class="form-control" placeholder="Menu Name" name="menu_name">
  </div>
  <div class="form-group">
    <label for="Mobile">Price:</label>
    <input type="text" class="form-control" placeholder="Price" name="price">
  </div>
  <div class="col-md-12 text-center"> <button type="submit" class="btn btn-primary" name="addmenu">Submit</button></div>
</form>
</div>
  </div>
</div>
</div>
<?php
include "footer.php";
?>

