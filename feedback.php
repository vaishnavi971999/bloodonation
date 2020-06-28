<?php
session_start();
?>

<!DOCTYPE HTML>  
<html>
<head>
<title>blood-O-nation</title>
<style>
  div {
  background-image: url('images/feedbackpage.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 50% 50%;
  background-position: right center;

}
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
$param_name = $nameErr = $emailErr = $contactErr = $natureErr = "";
$name = $email = $contact = $nature = $feedback = "";

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

   
  if (empty($_POST["contact"])) {
    $contactErr = "Contact number is required";
  } else {
    $contact = ($_POST["contact"]);
    // check if contact number is well-formed
    
  }

  if (empty($_POST["nature"])) {
    $natureErr = "Nature is required";
  } else {
    $nature = $_POST["nature"];
  }

  
  
  
  $feedback = $_POST["feedback"];
  



if(empty($nameErr) && empty($emailErr) && empty($natureErr) && empty($contactErr))
            {
                $sql = "INSERT INTO feedback(name,email,contact,nature,feedback) VALUES(?,?,?,?,?)";
                if($stmt = mysqli_prepare($link, $sql))
             {
            // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "ssiss", $param_name, $param_email, $param_contact, $param_nature, $param_feedback);
            
            // Set parameters
                    $param_name = $name;
                    $param_email = $email;
                    $param_contact = $contact;
                    $param_nature = $nature;
                    $param_feedback = $feedback;
                    
            
            // Attempt to execute the prepared statement
                    if(mysqli_stmt_execute($stmt)){
                    // Redirect to login page
                        header("location: feedback_final.html");
                    }
                    else{
                        echo "Something went wrong. Please try again later.";
                         }   

                } 
            }  
            
}     


?>


<div class="reg_form" style="padding-left:100px">
<h1 style="color:#1e90ff">Feedback form</h1>
<p><span class="error">* required field</span></p>
<form method="post" action="">  
  Name:<br> <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail:<br> <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Contact number:<br> <input type="number" name="contact" rows="1" cols="10">
  <span class="error">* <?php echo $contactErr;?></span>
  <br><br>
  Nature:<br> 
  <input type="radio" name="nature" value="donor">"Donor"<br>
  <input type="radio" name="nature" value="recipient">"Recipient"<br>
  <input type="radio" name="nature" value="others">"Others" <br>
  <span class="error">* <?php echo $natureErr;?></span>
  <br><br>
  Feedback:<br>
  <input type="text" name="feedback"><br>
  <br><br>
  
  <input type="submit" name="submit" value="Submit">  
</form>
</div>



<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.js"></script>


</body>
</html>
