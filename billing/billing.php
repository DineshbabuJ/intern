<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include 'header.php';
include 'connect.php';

if(isset($_GET['del']))
{
    $del=$_GET['del'];
    $item_sql = "delete FROM temp_billitem WHERE `menu_id`='$del'";
    $item_result = mysqli_query($conn, $item_sql);
    if (!$item_result) {
        echo "<div class='alert alert-danger col-md-8 dbresult' role='alert'>Error updating record: " . $conn->error."</div>";
    }
}

if(isset($_GET['id']))
{
    $customer_id=$_GET['id'];
    $sql = "SELECT * FROM test_table WHERE `user_id`='$customer_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $fullname=$row['fullname'];
    $mobile=$row['mobile'];
    $balance=$row['balance'];
}

if(isset($_POST['additem']))
{
    $menu_name=$_POST['menu_name'];
    $item_sql = "SELECT * FROM menu WHERE `menu_name`='$menu_name'";
    $item_result = mysqli_query($conn, $item_sql);
    $item_row = mysqli_fetch_assoc($item_result);
  
    if(!empty($item_row))
    {
        $menu_id=$item_row['menu_id'];
        $menu_name=$item_row['menu_name'];
        $price=$item_row['price'];
        $temp_sql="SELECT * FROM temp_billitem WHERE `menu_id`='$menu_id' and `customer_id`='$customer_id'";
        $temp_result = mysqli_query($conn, $temp_sql);
        $temp_row = mysqli_fetch_assoc($temp_result);
        if(!empty($temp_row))
        {
               $old_quantity=$temp_row['quantity'];
               $new_quantity=$old_quantity+1;
               $amount=$new_quantity*$temp_row['price'];
               $update_quantity = "UPDATE temp_billitem SET quantity='$new_quantity',amount='$amount' WHERE `menu_id`='$menu_id' and `customer_id`='$customer_id'";
               if ($conn->query($update_quantity) === FALSE) {
                  echo "<div class='alert alert-danger col-md-8 dbresult' role='alert'>Error updating record: " . $conn->error."</div>";
                }
        }
        else{
            $sql_bill = "INSERT INTO temp_billitem (`menu_id`,`customer_id`, quantity, menu_name, `price`, amount) VALUES ('$menu_id', '$customer_id', '1', '$menu_name', '$price', '$price')";
            $result_bill = mysqli_query($conn, $sql_bill);
            if (!$result_bill) {
                echo "<div class='alert alert-danger col-md-8 dbresult' role='alert'>Error updating record: " . $conn->error."</div>";
            }
        }
    }
    else
    {
     echo "<div class='alert alert-warning col-md-8 dbresult' role='alert'>No Item Found</div>";
    }
}
?>
   
 <script>
    function showlowbalance()
    {
        Swal.fire({
        title: 'Low Balance...',
        text: 'Recharge before you pay!'
        })
    }
    function additemsinfo()
    {
        Swal.fire({
        title: 'No Items...',
        text: 'Please add Item!'
        })
    }
</script>
   <div style="margin-top:40px;">
   <form action="billing.php?id=<?php echo $_GET['id'];?>" method="post">
    <table class="newmenu">
         <tr>
            <td>Menu:</td>
            <td><input type="text" name="menu_name"></td>
            <td><input type="submit" name="additem" value="Add"></td>
        </tr>
    </table>
    </form>
    </div>

    <div class="row" style="margin-top:40px;">   
    <table class="newmenu cust_details">
          <tr>
            <td><b>Customer Name:</b> </td>
            <td><?php echo $fullname;?></td>
        </tr>
        <tr>
            <td><b>Mobile Number:</b> </td>
            <td><?php echo $mobile;?></td>
        </tr>
        <tr>
            <td><b>Balance:</b> </td>
            <td><span class="badge badge-info balance"><?php echo "Rs. ".$balance;?></span></td>
            <td><a class="btn btn-success" href="topupuser.php?id=<?php echo $customer_id;?>">Recharge</a></td>
        </tr>
    </table>
    </div>

    
    <div class="row" style="margin-top:40px;">   
        
        <table class="billingtable newmenu">
            <tr>
            <th>S.no</th>
            <th>Quantity</th>
            <th class="item">Item</th>
            <th>Price</th>
            <th>Amount</th>
            <th>Delete</th>
            </tr>
            <?php
    
             $item_sql="SELECT * FROM temp_billitem where `customer_id`='$customer_id'";
             if ($conn){
                $item_result = mysqli_query($conn, $item_sql);
                    $i=1;
                    $total=0;
                    while ($row = mysqli_fetch_array($item_result)) {
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row['quantity']."</td>";
                        echo "<td>".$row['menu_name']."</td>";
                        echo "<td>".$row['price']."</td>";
                        echo "<td>".$row['amount']."</td>";
                        echo "<td><a href='billing.php?del=".$row['menu_id']."&id=".$_GET['id']."'>Delete</a></td>";
                        echo "</tr>";
                        $total=$total+$row['amount'];
                        $i++;  
                    }
                    echo "<tr>";
                    echo "<td></td><td></td><td></td><td>Total</td><td>".$total."</td><td></td>";
                    echo "</tr>";

             }
            ?>
        </table>
    </div> 
    <form action="savebill.php" method="post">
    <div class="row" style="margin-left:80%;margin-top:30px;">
    <input type="hidden" name="balance" value="<?php echo $balance; ?>"/>
      <input type="hidden" name="total" value="<?php echo $total; ?>"/>
      <input type="hidden" name="cutsomerid" value="<?php echo $customer_id;?>"/>
      <?php
        if ($i>1) {
            if ($total>$balance) {
                echo "<button class='btn btn-primary' type='button' onclick='showlowbalance();'>Pay Bill</button>";
            } else {
                echo "<button class='btn btn-primary' type='submit' name='savebill'>Pay Bill</button>";
            }
        }
        else{
            echo "<button class='btn btn-primary' type='button' onclick='additemsinfo();'>Pay Bill</button>";
        }
       
      ?>
    </div>
    </form>   
    


