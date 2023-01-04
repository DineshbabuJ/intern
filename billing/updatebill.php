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
    $billno=$_GET['billno'];
    $item_sql = "delete FROM billitem WHERE `menu_id`='$del' and `billno`='$billno'";
    $item_result = mysqli_query($conn, $item_sql);
    if (!$item_result) {
        echo "<div class='alert alert-danger col-md-8 dbresult' role='alert'>Error updating record: " . $conn->error."</div>";
    }
}

if(isset($_GET['billno']))
{
    $billno=$_GET['billno'];
    $sql = "SELECT * FROM bill WHERE `billno`='$billno'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $customer_id=$row['customer_id'];
    $total=$row['total'];
    $sql = "SELECT * FROM test_table WHERE `user_id`='$customer_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $fullname=$row['fullname'];
    $mobile=$row['mobile'];
    $balance=$row['balance'];
}


?>
   

   <div style="margin-top: 40px;width: 60%;margin-left: auto;margin-right: auto;">
        <div class="alert alert-success text-center" role="alert">
            Thank You For the Payment
        </div>
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
            <td><b>Available Balance:</b> </td>
            <td><span class="badge badge-info balance"><?php echo "Rs. ".$balance;?></span></td>
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
             $item_sql="SELECT * FROM billitem where billno='$billno'";
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
                        echo "<td><a href='updatebill.php?del=".$row['menu_id']."&billno=".$billno."'>Delete</a></td>";
                        echo "</tr>";
                        $total=$total+$row['amount'];
                        $i++;  
                    }
                    echo "<tr>";
                    echo "<td></td><td></td><td></td><td>Total</td><td>".$total."</td><td></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td></td><td></td><td></td><td>Status</td><td>Paid</td><td></td>";
                    echo "</tr>";

             }
            ?>
        </table>
    </div> 

    <div class="row" style="margin-top:40px;">   
    </div>
    
    


