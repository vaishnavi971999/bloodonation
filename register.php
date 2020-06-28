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
$param_name = $nameErr = $emailErr = $genderErr = $stateErr = $contactErr = $ageErr = $b_groupErr = $passwordErr =$con_passwordErr = $weightErr = $decErr = "";
$name = $email = $city = $state = $gender = $age = $contact = $b_group = $hiv = $condition1 = $password = $con_password = $weight = $dec = "";

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
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["state"])) {
    $stateErr = "State is required";
  } else {
    $state = test_input($_POST["state"]);
    // check if state only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$state)) {
      $stateErr = "Only letters and white space allowed";
    }
  }
    
  if (empty($_POST["contact"])) {
    $contactErr = "Contact number is required";
  } else {
    $contact = ($_POST["contact"]);
    // check if contact number is well-formed
    
  }

  if (empty($_POST["age"])) {
    $ageErr = "Age is required";
  } else {
    $age = test_input($_POST["age"]);
  }

  if (empty($_POST["weight"])) {
    $weightErr = "Weight is required";
  } else {
    $comment = test_input($_POST["weight"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if (empty($_POST["b_group"])) {
    $b_groupErr = "Gender is required";
  } else {
  $b_group = test_input($_POST["b_group"]);
  }
  
  
  $hiv = $_POST["hiv"];
  $condition1 = $_POST["condition1"];
  $city = $_POST["city"];

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
  
  if (empty($_POST["weight"])) {
    $weightErr = "Weight is required";
  } else {
    $weight = test_input($_POST["weight"]);
  }


   if(isset($_POST["email"])){
    $sql ="SELECT id FROM `donor` WHERE email='$email'";//query to check if email exits
   $result = mysqli_query($link,$sql);
   if(mysqli_num_rows($result)>0){ //
       $emailErr = "Email already exist";
  }
   
   if($con_password!=$password){
    $con_passwordErr = "Password and confirm password did not match"; }

    if (empty($_POST["register"])) {
      $decErr = "Declaration is required";
    } else {
      $dec = test_input($_POST["register"]);
    }



if(empty($nameErr) && empty($emailErr) && empty($stateErr) && empty($contactErr) && empty($ageErr) && empty($weightErr) && empty($genderErr) && empty($b_groupErr) && empty($passwordErr) && empty($con_passwordErr))
            {
                $sql = "INSERT INTO donor(name,email,city,state,contact,age,weight,gender,b_group,hiv,condition1,password) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                if($stmt = mysqli_prepare($link, $sql))
             {
            // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "ssssisssssss", $param_name, $param_email, $param_city, $param_state, $param_contact, $param_age, $param_weight, $param_gender, $param_b_group, $param_hiv, $param_condition, $param_password);
            
            // Set parameters
                    $param_name = $name;
                    $param_email = $email;
                    $param_city = $city;
                    $param_state = $state;
                    $param_contact = $contact;
                    $param_age = $age;
                    $param_weight = $weight;
                    $param_gender = $gender;
                    $param_b_group = $b_group; 
                    $param_hiv = $hiv; 
                    $param_condition = $condition1;
                    $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                        header("location: donor_details.php");
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
  E-mail:<br> <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  City:<br> <input type="text" name="city">
  <br><br>
  State:<br> <input type="text" name="state">
  <span class="error">* <?php echo $stateErr;?></span>
  <br><br>
  Contact number:<br> <input type="number" name="contact" rows="1" cols="10">
  <span class="error">* <?php echo $contactErr;?></span>
  <br><br>
  Age(in years):<br> 
  <input type="radio" name="age" value="less">"Less than 18"<br>
  <input type="radio" name="age" value="correct">"Between 18 and 60"<br>
  <input type="radio" name="age" value="more">"More than 60" <br>
  <span class="error">* <?php echo $ageErr;?></span>
  <br><br>
  Weight:<br>
  <input type="radio" name="weight" value="less">"Less than 50"<br>
  <input type="radio" name="weight" value="correct">"Greater than or equal to 50" <br>
  <span class="error">* <?php echo $weightErr;?></span>
  <br><br>
  Gender:<br>
  <input type="radio" name="gender" value="female">Female<br>
  <input type="radio" name="gender" value="male">Male<br>
  <input type="radio" name="gender" value="other">Other  <br>
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  Blood group:<br>
  <input type="radio" name="b_group" value="Ap">A+ve<br>
  <input type="radio" name="b_group" value="An">A-ve<br>
  <input type="radio" name="b_group" value="Bp">B+ve <br>
  <input type="radio" name="b_group" value="Bn">B-ve<br>
  <input type="radio" name="b_group" value="Op">O+ve<br>
  <input type="radio" name="b_group" value="On">O-ve<br>
  <input type="radio" name="b_group" value="ABp">AB+ve<br>
  <input type="radio" name="b_group" value="ABn">AB-ve<br>      
  <span class="error">* <?php echo $b_groupErr;?></span>
  <br><br>
  Are you tested positive for HIV/AIDS, HTLV or Hepatitis: <br>
  <input type="radio" name="hiv" value="positive">Positive<br>
  <input type="radio" name="hiv" value="negative">Negative<br>
  <br><br>
  Select appropriate blocks:<br>
  <input type="checkbox" name="condition1" value="checked1">Taking antibiotics for an infection (antibiotics for treating acne are fine)<br>
  <input type="checkbox" name="condition1" value="checked2">Currently taking Cellcept or have taken Cellcept in the last 6 weeks<br>
  <input type="checkbox" name="condition1" value="checked3">Currently using Avodart or Jalyn or have taken either in the last 6 months<br>
  <input type="checkbox" name="condition1" value="checked4">Have taken Absorica, Accutane, Amnesteem, Claravis, Myorisan, Propecia, Proscar, Sotret, Thalomid or Zenatane in the past 30 days or are currently taking any of these drugs<br>
  <input type="checkbox" name="condition1" value="checked5">Currently taking or have taken Arava, Aubagio, Erivedge or Odomzo in the last 2 years<br>
  <input type="checkbox" name="condition1" value="checked6">Have taken Soriatane in the past 3 years or taking Soriatane now<br>
  <input type="checkbox" name="condition1" value="checked7">Have ever taken Tegison<br>
  <input type="checkbox" name="condition1" value="checked8">None of the above<br><br>
  Password:<br>
  <input type="password" name="password"><br>
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>
  Confirm password:<br>
  <input type="password" name="con_password"><br>
  <span class="error">* <?php echo $con_passwordErr;?></span>
  <br><br>
  <b>DECLARATION: </b>
  <input type="checkbox" name="register" value="yes"> The following information provided is true. If any of the above information is found false, I will be held responsible.
  <span class="error">* <?php echo $decErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
</div>

<?php
$_SESSION["age1"]=$age;
$_SESSION["weight1"]=$weight;
$_SESSION["hiv1"]=$hiv;
$_SESSION["condition2"]=$condition1;
$_SESSION["email1"]=$email;
?>

<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.js"></script>


</body>
</html>
