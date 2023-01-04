<?php
//$myfile = fopen("userdetails.txt", "r") or die("Unable to open file!");
$userdetails= file_get_contents("newfile.txt");
//print_r($userdetails);
$userdetails=explode(":", $userdetails);
$username=$userdetails[0];
$password=$userdetails[1];
if($password==md5("pass123"))
{
    echo "Password correct";
}
echo "username: " . $username;
echo "<br/>password: " . $password;
fclose($myfile);
?>