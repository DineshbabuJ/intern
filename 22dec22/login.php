<?php
if (isset($_POST['login'])) {
    $username="admin";
    $password="pass123";
    if ($username==$_POST['username']&&$password==$_POST['password']) {
        session_start();
        $_SESSION['user']=$username;
        header("Location: index.php");
    }
    else{
        echo "username and password does not match";
    }
}

?>
<!DOCTYPE html>   
<html>   
<head>  
<title> Login Page </title>  
<style>   
Body {  
  font-family: Calibri, Helvetica, sans-serif;  
  background-color: lightgoldenrodyellow;  
}  
button {   
    background-color: #0e9413;
    width: 50%;
    color: #f2efe9;
    padding: 15px;
    margin: 10px 0px;
    border: none;
    cursor: pointer;
    margin-left: 125px; 
         }   

 input[type=text], input[type=password] {   
        width: 100%;   
        margin: 8px 0;  
        padding: 12px 20px;   
        display: inline-block;   
        border: 2px solid green;   
        box-sizing: border-box;   
    }  
 button:hover {   
        opacity: 0.7;   
    }   
  .cancelbtn {   
        width: auto;   
        padding: 10px 18px;  
        margin: 10px 5px;  
    }   
        
     
 .container {   
        padding: 25px;   
        background-color: lightblue; 
        width: 40%;
    margin-right: auto;
    margin-left: auto; 
    }   
</style>   
</head>    
<body>    
    <center> <h1> Login Form </h1> </center>   
    <form method="post" action="login.php">  
        <div class="container">   
            <label>Username : </label>   
            <input type="text" placeholder="Enter Username" name="username" required>  
            <label>Password : </label>   
            <input type="password" placeholder="Enter Password" name="password" required>  
            <button type="submit" name="login">Login</button>   
        </div>   
    </form>     
</body>     
</html>  
