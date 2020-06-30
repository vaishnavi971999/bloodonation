<?php
session_start();
include("connect.php");
?>
<!DOCTYPE HTML>  
<html>
<head>
<title>blood-O-nation</title>
<style>
.error {color: #FF0000;}
#main_wrapper{
    text-align: center;
    width:500px;
    margin:0 auto;
    background:white;
    padding:5px;
    border-radius:2px solid #0c7ae9;
  }
.login_emo{
    text-align: center;
    width: 150px;
    text-align:center;
  }
.form{
    text-align: center;
    width:250px;
    margin:0 auto;
  }
.inputvalues{
    text-align: center;
    width:230px;
    margin:0 auto;
    padding:5px;
  }
</style>
</head>
<body>  

<?php


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


// define variables and set to empty values
$nameErr = $emailErr = $passwordErr = $incorrect_password = "";
$name = $email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    // if(isset($_POST["username"] && isset($_POST["password"]))){
    $sql = "SELECT id from donor where name='$name' and email='$email' and password='$password'";
    $result = mysqli_query($link,$sql);

    if(mysqli_num_rows($result)>0){
        session_start();
        header("location:donor_edit.php");
    }
    else
    {
        echo '<script type="text/javascript"> alert("Invalid credentials")</script>';
    }

}




?>
<div id="main_wrapper">
<h2>Donar Sign up Form</h2>
<img src="images/login1.jpg" class="login_emo"><br>
<p><span class="error">* required field</span></p>
<form method="post" action="">  
  Name<br><input type="text" name="name"class="inputvalues">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail<br><input type="text" name="email" class="inputvalues">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Password<br><input type="password" name="password" class="inputvalues">
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
$_SESSION["email2"]=$email;
?>

</body>
</html>

