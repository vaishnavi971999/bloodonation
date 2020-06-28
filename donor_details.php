<?php
session_start();
include("connect.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>blood-O-nation</title>
  </head>
<body>


<div class="container">
     
     <div class="jumbotron">
       
     

<?php
$test=0;
$mail=$_SESSION["email1"];
// Echo session variables that were set on previous page

if($_SESSION["age1"]!="correct"){
  $test=1;
  echo "Age not suitable for blood donation.";
  echo "<br>";
}
if($_SESSION["weight1"]!="correct"){
  $test=1;
  echo "Weight not suitable for blood donation.";
  echo "<br>";
}
if($_SESSION["hiv1"]!="negative"){
  $test=1;
  echo "With HIV-AIDS test being positive, you do not hold the eligibility of becoming a healthy donor.";
  echo "<br>";
}
if($_SESSION["condition2"]!="checked8"){
  $test=1;
  echo "For the drugs you have taken/are taking, you do not hold the eligibility of becoming a healthy donor.";
  echo "<br>";
}
if($test==1){
  $sql="DELETE FROM donor WHERE email='$mail'";

if (mysqli_query($link, $sql)) {
  echo "Your application will not be accepted.Thanks for showing interest in blood donation.Better luck next time.";
  echo "<br>";
  
} else {
  echo "Error";
}

}

if($test==0){
  echo "Registration successful!";
  echo "<br><br>";
  echo "You will be informed when a suitable recipient makes a request for blood.";
}


?>

</div>
 
<p><a class="btn btn-primary btn-lg" href="home.html" role="button">Back &raquo;</a></p>
     </div>

     <footer style="color:#0984e3; padding:50px;">
       <p>For more details, contact us:</p>
       <p>Email us at: bloodonation@gmail.com</p>
       <p>Ring us at: 1200 930 234</p>
     </footer>

   </div> <!-- /container -->



</body>
</html>