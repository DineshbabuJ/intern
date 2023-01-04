<?php
include "connect.php";
if (isset($_POST['savebill'])) {
    $customerid=$_POST['cutsomerid'];
    $total=$_POST['total'];
    $balance=$_POST['balance'];
    $delete=true;
    $sql_bill = "INSERT INTO bill (`customer_id`, total) VALUES ('$customerid', '$total')";
    $result_bill = mysqli_query($conn, $sql_bill);
    if (!$result_bill) {
        echo "<div class='alert alert-danger col-md-8 dbresult' role='alert'>Error Inserting record: " . $conn->error."</div>";
    } else {
        $billno=$conn->insert_id;
        $item_sql="SELECT * FROM temp_billitem where `customer_id`='$customerid'";
        if ($conn) {
            $item_result = mysqli_query($conn, $item_sql);
            while ($itemrow = mysqli_fetch_array($item_result)) {
                $quantity = $itemrow['quantity'];
                $menu_name = $itemrow['menu_name'];
                $menu_id = $itemrow['menu_id'];
                $price = $itemrow['price'];
                $amount = $itemrow['amount'];
                $billitem_sql="INSERT INTO billitem (`billno`, menu_id, quantity, menu_name, price, amount) VALUES ('$billno', '$menu_id', '$quantity', '$menu_name', '$price', '$amount')";
                $billitem_result=mysqli_query($conn, $billitem_sql);
                if (!$billitem_result) {
                    die("Error: ".$conn->error);
                    $delete=false;
                }
            }
            if($delete)
            {
                $del_sql = "delete FROM temp_billitem where `customer_id`='$customerid'";
                $del_result = mysqli_query($conn, $del_sql);
                if (!$del_result) {
                    echo "<div class='alert alert-danger col-md-8 dbresult' role='alert'>Error Deleting record: " . $conn->error."</div>";
                }
                else{
                    $newtotal=$balance-$total;
                    $sql = "UPDATE test_table SET balance='$newtotal' WHERE `user_id`='$customerid'";
                    if ($conn->query($sql) === TRUE) {
                        echo "<div class='alert alert-success col-md-8 dbresult' role='alert'>Recharged Successfully!!</div>";
                    } else {
                        echo "<div class='alert alert-success col-md-8 dbresult' role='alert'>Error updating record: " . $conn->error."</div>";
                    }
                     header("Location:updatebill.php?billno=".$billno);
                }
            }
        }
    }
}