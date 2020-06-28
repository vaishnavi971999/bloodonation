<?php
session_start();
include("connect.php");


$mail2=$_SESSION["email2"];

$delete = $name = $email = $city = $state = $gender = $age = $contact = $b_group = $hiv = $condition1 = $weight = $dec = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$delete = $_POST["delete"];  
$name = $_POST["name"];
$email = $_POST["email"];
$city = $_POST["city"];
$state = $_POST["state"];
$gender = $_POST["gender"];
$age = $_POST["age"];
$contact = $_POST["contact"];
$b_group = $_POST["b_group"];
$hiv = $_POST["hiv"];
$condition1 = $_POST["condition1"];
$weight = $_POST["weight"];
$dec = $_POST["register"];




if(empty($name) && empty($email) && empty($city) && empty($state) && empty($contact) && empty($age) && empty($weight) && empty($gender) && empty($b_group) && empty($hiv) && empty($condition1))
{
    echo "NO changes made in the form";
}

else if (!empty($delete)){

  $sql = "DELETE FROM donor WHERE email='$mail2'";

if (mysqli_query($link, $sql)) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record";
}
}

else if (!empty($name)){
    $sql = "UPDATE donor SET name='$name' WHERE email='$mail2'";

if (mysqli_query($link, $sql)) {
  echo "Name updated";
} else {
  echo "Error updating record ";
}
}

else if (!empty($email)){
    $sql = "UPDATE donor SET email='$email' WHERE email='$mail2'";

if (mysqli_query($link, $sql)) {
  echo "Email updated";
} else {
  echo "Error updating record ";
}
}

else if (!empty($city)){
    $sql = "UPDATE donor SET city='$city' WHERE email='$mail2'";

if (mysqli_query($link, $sql)) {
  echo "City updated";
} else {
  echo "Error updating record ";
}
}

else if (!empty($state)){
  $sql = "UPDATE donor SET state='$state' WHERE email='$mail2'";

if (mysqli_query($link, $sql)) {
echo "State updated";
} else {
echo "Error updating record ";
}
}

else if (!empty($gender)){
  $sql = "UPDATE donor SET gender='$gender' WHERE email='$mail2'";

if (mysqli_query($link, $sql)) {
echo "Gender updated";
} else {
echo "Error updating record ";
}
}

else if (!empty($age)){
  $sql = "UPDATE donor SET age='$age' WHERE email='$mail2'";

if (mysqli_query($link, $sql)) {
echo "Age updated";
} else {
echo "Error updating record ";
}
}

else if (!empty($weight)){
  $sql = "UPDATE donor SET weight='$weight' WHERE email='$mail2'";

if (mysqli_query($link, $sql)) {
echo "Weight updated";
} else {
echo "Error updating record ";
}
}

else if (!empty($contact)){
  $sql = "UPDATE donor SET contact='$contact' WHERE email='$mail2'";

if (mysqli_query($link, $sql)) {
echo "Contact updated";
} else {
echo "Error updating record ";
}
}

else if (!empty($b_group)){
  $sql = "UPDATE donor SET b_group='$b_group' WHERE email='$mail2'";

if (mysqli_query($link, $sql)) {
echo "Blood group updated";
} else {
echo "Error updating record ";
}
}

else if (!empty($hiv)){
  $sql = "UPDATE donor SET hiv='$hiv' WHERE email='$mail2'";

if (mysqli_query($link, $sql)) {
echo "HIV-AIDS test results updated";
} else {
echo "Error updating record ";
}
}

else if (!empty($condition1)){
  $sql = "UPDATE donor SET condition1='$condition1' WHERE email='$mail2'";

if (mysqli_query($link, $sql)) {
echo "Other medical conditions updated";
} else {
echo "Error updating record ";
}
}
header("location: donor_result.php");
}
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
<h3 style="color:#833471;">
The following given the full forms of abbrivations used:</h4>
  <h4 style="color:#009432;">checked1: Taking antibiotics for an infection (antibiotics for treating acne are fine)</h4>
  <h4 style="color:#009432;">checked2: Currently taking Cellcept or have taken Cellcept in the last 6 weeks</h4>
  <h4 style="color:#009432;">checked3: Currently using Avodart or Jalyn or have taken either in the last 6 months</h4>
  <h4 style="color:#009432;">checked4: Have taken Absorica, Accutane, Amnesteem, Claravis, Myorisan, Propecia, Proscar, Sotret, Thalomid or Zenatane in the past 30 days or are currently taking any of these drugs</h4>
  <h4 style="color:#009432;">checked5: Currently taking or have taken Arava, Aubagio, Erivedge or Odomzo in the last 2 years</h4>
  <h4 style="color:#009432;">checked6: Have taken Soriatane in the past 3 years or taking Soriatane now</h4>
  <h4 style="color:#009432;">checked7: Have ever taken Tegison</h4>
  <h4 style="color:#009432;">checked8: None of the above</h4><br>

  
  <h4 style="color:#009432;">less: Less than 18years</h4>
  <h4 style="color:#009432;">correct: Between 18 and 60years</h4>
  <h4 style="color:#009432;">more: More than 60years </h4><br>

  <h4 style="color:#009432;">less: Less than 50kgs</h4>
  <h4 style="color:#009432;">correct: Greater than or equal to 50kgs
</h4><br>

<h3 class="edit"  style="color:#833471;">The following are your account details:</h4>
<?php

$mail2=$_SESSION["email2"];
$sql = "SELECT name, email, city, state, contact, age, weight, gender, b_group, hiv, condition1 FROM donor WHERE email='$mail2'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "Name: " . $row["name"]."<br>". " Email: " . $row["email"]. "<br>" ." City: " .$row["city"]. "<br>"."State: " . $row["state"]."<br>"."Contact: " . $row["contact"]."<br>"."Age: " . $row["age"]."<br>"."Weight: " . $row["weight"]."<br>"."Gender: " . $row["gender"]."<br>"."Blood group: " . $row["b_group"]."<br>"."HIV-AIDS test result: " . $row["hiv"]."<br>"."Other medical details: " . $row["condition1"]."<br>";
  }
} else {
  echo "Error";
}


if (empty($_POST["register"])) {
    $decErr = "Declaration is required";
  } else {
    $dec = $_POST["register"];
  }
?>


<div class="reg_form">


<h2>Enter only those details that are to be edited form</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="">  


  Delete account:<br><input type="checkbox" name="delete" value="yes"> 
  <br><br>
  Name:<br> <input type="text" name="name">
  <br><br>
  E-mail:<br> <input type="text" name="email">
  <br><br>
  City:<br> <input type="text" name="city">
  <br><br>
  State:<br> <input type="text" name="state">
  <br><br>
  Contact number:<br> <input type="number" name="contact" rows="1" cols="10">
  <br><br>
  Age(in years):<br> 
  <input type="radio" name="age" value="less">"Less than 18"<br>
  <input type="radio" name="age" value="correct">"Between 18 and 60"<br>
  <input type="radio" name="age" value="more">"More than 60" <br>
  <br><br>
  Weight:<br>
  <input type="radio" name="weight" value="less">"Less than 50"<br>
  <input type="radio" name="weight" value="correct">"Greater than or equal to 50" <br>
  <br><br>
  Gender:<br>
  <input type="radio" name="gender" value="female">Female<br>
  <input type="radio" name="gender" value="male">Male<br>
  <input type="radio" name="gender" value="other">Other  <br>
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

  <b>DECLARATION: </b>
  <input type="checkbox" name="register" value="yes"> The following information provided is true. If any of the above information is found false, I will be held responsible.
  <span class="error">* <?php echo $decErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>
</div>



</body>
</html>