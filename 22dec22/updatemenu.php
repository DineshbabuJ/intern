<?php 
include "header.php";
include 'connect.php';

if (isset($_POST['update'])) {
	$menu_name = $_POST['menu_name'];
	$price = $_POST['price'];
	$menu_id=$_GET['id'];
		
			$sql = "UPDATE menu SET menu_name='$menu_name', price='$price' WHERE `menu_id`='$menu_id'";
			if ($conn->query($sql) === TRUE) {
              echo "<div class='alert alert-success col-md-8 dbresult' role='alert'>Record Updated Successfully!!</div>";
              } else {
                echo "<div class='alert alert-success col-md-8 dbresult' role='alert'>Error updating record: " . $conn->error."</div>";
              }
				
	} 

    if (isset($_GET['id']))
    {
        $menu_id=$_GET['id'];
        $sql = "SELECT * FROM menu WHERE `menu_id`='$menu_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $menu_name=$row['menu_name'];
        $price=$row['price'];
    }
?>
 <div class="row">
    <div class="col-md-8 text-center">
    <h1 class="text-center"> Update Menu Details </h1>
    </div>
</div>
<div class="row">
<div class="col-md-8" style="margin-right:auto;margin-left:auto;">

<div class="card">
  <div class="card-body">
<form action="updatemenu.php?id=<?php echo $_GET['id'];?>" method="post">
  <div class="form-group">
    <label for="Username">Menu Name:</label>
    <input type="text" class="form-control" placeholder="Menu Name" name="menu_name" value="<?php echo $menu_name;?>">
  </div>
  <div class="form-group">
    <label for="price">Price:</label>
    <input type="text" class="form-control" placeholder="Price" name="price" value="<?php echo $price;?>">
  </div>
  <div class="col-md-12 text-center"> <button type="submit" class="btn btn-primary" name="update">Update</button></div>
</form>
</div>
  </div>
</div>
</div>

<?php 
include "footer.php";
?>