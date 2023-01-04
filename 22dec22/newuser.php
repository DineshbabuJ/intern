<?php
include "header.php";
include "connect.php";
if (isset($_POST['adduser'])) {
    $fullname=$_POST['fullname'];
    $mobile=$_POST['mobile'];
    $balance=$_POST['balance'];
  
    $sql = "INSERT INTO test_table (fullname, mobile, `balance`) VALUES ('$fullname', '$mobile', '$balance')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $user_id=$conn->insert_id;
        header("Location: updateuser.php?id=".$user_id);
    }
    else{
      echo $conn->error;
    }
}
?>
<script type="text/javascript">
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
 </script> 
<div class="row">
    <div class="col-md-8 text-center">
    <h1 class="text-center"> Add Customer </h1>
    </div>
</div>
<div class="row">
<div class="col-md-8" style="margin-right:auto;margin-left:auto;">

<div class="card">
  <div class="card-body">
<form action="newuser.php" method="post">
  <div class="form-group">
    <label for="Username">Customer Name:</label>
    <input type="text" class="form-control" placeholder="User Name" name="fullname">
  </div>
  <div class="form-group">
    <label for="Mobile">Mobile:</label>
    <input type="text" class="form-control" placeholder="Mobile Number" name="mobile" onkeypress="return isNumber(event);">
  </div>
  <div class="form-group">
  <label for="Amount">Topup Amount:</label>
    <input type="text" class="form-control" placeholder="Topup Amount" name="balance">
  </div>
  <div class="col-md-12 text-center"> <button type="submit" class="btn btn-primary" name="adduser">Submit</button></div>
</form>
</div>
  </div>
</div>
</div>
<?php
include "footer.php";
?>

