<?php
include "header.php";
?>
<html>
    <head>
        <title>Test</title>
        <link rel="stylesheet" href="examplestyle.css">   
    </head>
    <body>
<?php
include 'connect.php';
if(isset($_POST['search']))
{
    $sql = "select * from test_table where mobile like '%".$_POST['mobileno']."%'";
}
else{
    $sql = "select * from test_table";
}
$result = mysqli_query($conn, $sql);
if ($conn) {
    $resultarray=array();
    $i=0;
    while ($row = mysqli_fetch_array($result)) {
        $resultarray[$i]["user_id"]= $row['user_id'] ;
        $resultarray[$i]["fullname"]=  $row['fullname'] ;
        $resultarray[$i]["mobile"]=  $row['mobile'];
        $resultarray[$i]["balance"]=  $row['balance'];
        $i++;
      
    }
    echo "<div style=\"margin-top:50px;\">";
    echo "<form method=\"post\" action=\"index.php\">";
    echo "<div class=\"row\" style=\"width:40%;\">";
    echo "<div class=\"col-md-6\">";
    echo "<input type=\"text\" name=\"mobileno\" placeholder=\"Search Mobile Number\"  class=\"form-control\">";
    echo "</div>";
    echo "<div class=\"col-md-6\">";
    echo "<button class=\"btn btn-primary\" type=\"submit\" name=\"search\">Search</button>";
    echo "</div>";
    echo "</div>";
    echo "</form>";
    
    echo "<h1>List of Customers</h1>";
    echo "<table class='usertable'>";
    echo "<tr><th>User ID</th><th> Name</th><th>Mobile Number</th><th>Available Balance</th><th>Recharge</th></tr>";
    for ($i=0;$i<count($resultarray);$i++) {
        echo "<tr>";
        echo "<td><a href='updateuser.php?id=".$resultarray[$i]['user_id']."'>".$resultarray[$i]['user_id']."</a></td>";
        echo "<td>".$resultarray[$i]['fullname']."</td>";
        echo "<td>".$resultarray[$i]['mobile']."</td>";
        echo "<td>".$resultarray[$i]['balance']."</td>";
        echo "<td><a href='topupuser.php?id=".$resultarray[$i]['user_id']."'>Recharge Amount</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

}
else
{
echo $conn->error;
}
mysqli_close($conn);
?>
</body>
</html>