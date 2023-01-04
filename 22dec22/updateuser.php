<?php 
include "header.php";
include 'connect.php';


if (isset($_GET['id']))
{
$user_id=$_GET['id'];
$sql = "SELECT * FROM test_table WHERE `user_id`='$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$username=$row['user_id'];
$fullname=$row['fullname'];
$mobile=$row['mobile'];
$balance=$row['balance'];
}



if (isset($_POST['update'])) {
	$fullname = $_POST['fullname'];
	$mobile = $_POST['mobile'];
	$user_id=$_GET['id'];
		
			$sql = "UPDATE test_table SET fullname='$fullname', mobile='$mobile' WHERE `user_id`='$user_id'";
			if ($conn->query($sql) === TRUE) {
              echo "<div class='alert alert-success col-md-8 dbresult' role='alert'>Record Updated Successfully!!</div>";
              } else {
                echo "<div class='alert alert-success col-md-8 dbresult' role='alert'>Error updating record: " . $conn->error."</div>";
              }
				
	} 
?>
 <div class="row">
    <div class="col-md-8 text-center">
    <h1 class="text-center"> Update Customer Details </h1>
    </div>
</div>
<div class="row">
<div class="col-md-8" style="margin-right:auto;margin-left:auto;">

<div class="card">
  <div class="card-body">
<form action="updateuser.php?id=<?php echo $_GET['id'];?>" method="post">
  <div class="form-group">
    <label for="Username">Customer Name:</label>
    <input type="text" class="form-control" placeholder="User Name" name="fullname" value="<?php echo $fullname;?>">
  </div>
  <div class="form-group">
    <label for="Mobile">Mobile:</label>
    <input type="text" class="form-control" placeholder="Mobile Number" name="mobile" value="<?php echo $mobile;?>">
  </div>
  <div class="form-group">
  <label for="Amount">Balance:</label>
  <span class="badge badge-info balance"><?php echo "Rs.".$balance;?></span>
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