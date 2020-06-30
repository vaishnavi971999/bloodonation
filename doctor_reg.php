<?php
session_start();


?>

<!DOCTYPE HTML>  
<html>
<head>
<title>blood-O-nation</title>
<style>
  
.error {color: #FF0000;}
</style>
<link href="css/style.css" rel="stylesheet">
</head>
<body>  

<?php

include("connect.php");
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


// define variables and set to empty values
$param_name = $nameErr = $emailErr = $usernameErr = $contactErr = $h_depErr = $aboutErr = $passwordErr =$con_passwordErr = $specializationErr = "";
$name = $username = $email = $contact = $h_dep = $about = $specialization = $password = $con_password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["username"])) {
    $usernameErr = "Name is required";
  } else {
    $username = test_input($_POST["username"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
      $usernameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["about"])) {
    $aboutErr = "State is required";
  } else {
    $about = test_input($_POST["about"]);
    // check if state only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$about)) {
      $aboutErr = "Only letters and white space allowed";
    }
  }
    
  if (empty($_POST["contact"])) {
    $contactErr = "Contact number is required";
  } else {
    $contact = ($_POST["contact"]);
    // check if contact number is well-formed
    
  }

  if (empty($_POST["h_dep"])) {
    $h_depErr = "Age is required";
  } else {
    $h_dep = test_input($_POST["h_dep"]);
  }

  if (empty($_POST["specialization"])) {
    $specializationErr = "Weight is required";
  } else {
    $specialization = test_input($_POST["specialization"]);
  }

  
  if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = $_POST["password"];
  }

  if (empty($_POST["con_password"])) {
    $con_passwordErr = "Confirmation of password is required";
  } else {
    $con_password = test_input($_POST["con_password"]);
  }
  
  

   if(isset($_POST["email"])){
    $sql ="SELECT id FROM `doctor` WHERE email='$email'";//query to check if email exits
   $result = mysqli_query($link,$sql);
   if(mysqli_num_rows($result)>0){ //
       $emailErr = "Email already exist";
  }
   
   if($con_password!=$password){
    $con_passwordErr = "Password and confirm password did not match"; }

   



if(empty($nameErr) && empty($emailErr) && empty($usernameErr) && empty($contactErr) && empty($h_depErr) && empty($aboutErr) && empty($specializationErr) && empty($passwordErr) && empty($con_passwordErr))
            {
                $sql = "INSERT INTO doctor(name,username,email,password,contact_number,health_department,specialization,about) VALUES(?,?,?,?,?,?,?,?)";
                if($stmt = mysqli_prepare($link, $sql))
             {
            // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "ssssisss", $param_name, $param_username, $param_email, $param_password, $param_contact, $param_h_dep, $param_specialization, $param_about);
            
            // Set parameters
                    $param_name = $name;
                    $param_username = $username;
                    $param_email = $email;
                    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
                    $param_contact = $contact;
                    $param_h_dep = $h_dep;
                    $param_specialization = $specialization;
                    $param_about = $about;
                    
                    
            
            // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                        header("location: home.html");
                    }
                    else{
                        echo "Something went wrong. Please try again later.";
                         }   

                } 
            }  
            
}     

}
?>


<div class="reg_form">
<h2 style="color:#1B1464">Donar registration form</h2>
<h4 style="color:#1e90ff"><b>1.The following information is collected to test your eligibility to become a donar.<br>2.Some specified laboratory test reports for will be required before blood donation. Cooperate with the recipient and their consultant doctor.<br>3. Your name, city, email id and contact number will be given to a recipent compatible to your blood group for donation.<b><br></h4>
<p><span class="error">* required field</span></p>
<form method="post" action="">  
  Name:<br> <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Username:<br> <input type="text" name="username">
  <span class="error">* <?php echo $usernameErr;?></span>
  <br><br>
  E-mail:<br> <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Contact number:<br> <input type="number" name="contact" rows="1" cols="10">
  <span class="error">* <?php echo $contactErr;?></span>
  <br><br>
  Health department:<br> 
  <input type="radio" name="h_dep" value="less">"Less than 18"<br>
  <input type="radio" name="h_dep" value="correct">"Between 18 and 60"<br>
  <input type="radio" name="h_dep" value="more">"More than 60" <br>
  <span class="error">* <?php echo $h_depErr;?></span>
  <br><br>
  Specialization:<br> <input type="text" name="specialization">
  <span class="error">* <?php echo $specializationErr;?></span>
  <br><br>
  About:<br> <input type="text" name="about">
  <span class="error">* <?php echo $aboutErr;?></span>
  <br><br>
  Password:<br>
  <input type="password" name="password"><br>
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  Confirm password:<br>
  <input type="password" name="con_password"><br>
  <span class="error">* <?php echo $con_passwordErr;?></span>
  <br><br>
  
  <input type="submit" name="submit" value="Submit">  
</form>
</div>


<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.js"></script>


</body>
</html>
