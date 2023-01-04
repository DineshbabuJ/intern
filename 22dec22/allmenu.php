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

$sql = "select * from menu";
$result = mysqli_query($conn, $sql);
if ($conn) {
    $resultarray=array();
    $i=0;
    while ($row = mysqli_fetch_array($result)) {
        $resultarray[$i]["menu_id"]= $row['menu_id'] ;
        $resultarray[$i]["menu_name"]=  $row['menu_name'] ;
        $resultarray[$i]["price"]=  $row['price'];
        $i++;
      
    }
    mysqli_close($conn);
    echo "<div style=\"margin-left:80%\"><a class=\"btn btn-primary\" href=\"newmenu.php\">Add Menu</a></div>";

    echo "<div style=\"margin-top:50px;\">";
    echo "<h1>Available Menu</h1>";
    echo "<table class='usertable'>";
    echo "<tr><th>ID</th><th> Name</th><th>Price</th></tr>";
    for ($i=0;$i<count($resultarray);$i++) {
        echo "<tr>";
        echo "<td><a href='updatemenu.php?id=".$resultarray[$i]['menu_id']."'>".$resultarray[$i]['menu_id']."</a></td>";
        echo "<td>".$resultarray[$i]['menu_name']."</td>";
        echo "<td>".$resultarray[$i]['price']."</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";

}
else
{
echo $conn->error;
}

?>
</body>
</html>