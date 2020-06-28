<?php
session_start();
include("connect.php");

$b_group1=$_SESSION["b_group"];
$city1=$_SESSION["city"];
$test=0;
 
$sql="SELECT name,email,contact,city FROM donor WHERE b_group='$b_group1'AND city='$city1'";
$result=mysqli_query($link,$sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $test=1;
    echo "The following donors match recipient's requirements:";
    echo "<br><br>";
    while($row = mysqli_fetch_assoc($result)) {
      echo "Name: " . $row["name"]."<br>". "Email id: " . $row["email"]. "<br> "."Contact: " . $row["contact"]. "<br>"."City: " . $row["city"]."<br><br><br>";
    }
  } else {
    echo "No match found";
  }

  


?>
