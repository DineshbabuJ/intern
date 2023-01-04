<?php 
include "header.php";
include 'connect.php';


if (isset($_POST['addamount'])) {
	         $user_id=$_GET['id'];
            $availbal = "SELECT balance as amount FROM test_table WHERE `user_id`='$user_id'";
            $bal_result = mysqli_query($conn, $availbal);
            $bal_row = mysqli_fetch_assoc($bal_result);
            $amount = $bal_row['amount'];
            $total=$amount+$_POST['topup'];
			$sql = "UPDATE test_table SET balance='$total' WHERE `user_id`='$user_id'";
			if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success col-md-8 dbresult' role='alert'>Recharged Successfully!!</div>";
              } else {
                echo "<div class='alert alert-success col-md-8 dbresult' role='alert'>Error updating record: " . $conn->error."</div>";
              }
				
	} 

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
?>

 <div class="row">
    <div class="col-md-8 text-center">
    <h1 class="text-center"> Recharge Amount </h1>
    </div>
</div>

<div class="row">
<div class="col-md-8" style="margin-right:auto;margin-left:auto;">

<div class="card">
  <div class="card-body">
<form action="topupuser.php?id=<?php echo $_GET['id'];?>" method="post">
  <div class="form-group">
    <label for="Username">Customer Name:</label>
    <input type="text" class="form-control" placeholder="User Name" name="username" disabled value="<?php echo $fullname;?>">
  </div>
  <div class="form-group">
    <label for="Mobile">Mobile:</label>
    <input type="text" class="form-control" placeholder="Mobile Number" name="mobile" disabled value="<?php echo $mobile;?>">
  </div>
  <div class="form-group">
  <label for="Amount">Balance:</label>
  <span class="badge badge-info balance"><?php echo "Rs.".$balance;?></span>
  </div>
  <div class="form-group">
    <label for="Mobile">Amount to topup:</label>
    <input type="text" class="form-control" placeholder="Amount To Topup" name="topup">
  </div>

  <div class="col-md-12 text-center"> <button type="submit" name="addamount" class="btn btn-primary">Topup</button></div>
</form>
</div>
  </div>
</div>
</div>

<?php 
include "footer.php";
?>