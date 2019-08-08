<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
if(isset($_POST['submit'])){
	$Member_Id=$_POST['memId'];
	
	$conn = new mysqli("localhost","root","root","NJITFitness");
if($conn->connect_error){
    die("Connection Failed");
}
// Attempt select query execution
//echo $Member_Id;
	$sql = "SELECT * FROM membership where member_id=".$Member_Id;
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		//echo $row['no_of_guest'];
      	  $num=$row["no_of_guest"];
       }
      }//if
	else{
   		$num= ' Enter a valid Member ID';
	}
	// Close connection
	mysqli_close($link);
}
?>

<html>
<head>
<title>Exercise Mangement</title>
<link rel="stylesheet" type="text/css" href="../Styles/Common.css">
</head>
<body>
    <div class="headerClass" style="color: red"><h3>NJIT Fitness Club</h3></div>
<div class="container">
<form  method="POST"  style="height:100%">
<table class="instructorTableClass">
<tr><th colspan="2"><h2 style="float:left">Guest Registration</h2></th><tr>
<tr><td>Member Id</td><td><input type="text" id="memId" name="memId" 
value="<?php if(isset($_POST['memId'])){echo $_POST['memId'];} ?>"
 /></td></tr>


<tr style="height:130px"><td colspan="2" class="submitButtonTdClass"><input type="submit" name ="submit" value="Submit" /></td></tr>


<tr><td>Number of guest for your membership</td><td><label id="l1" ><?php echo $num ?></label ></td></tr>
</form>
</div>


<ul class="breadcrumb">
  <li><a href="Index.php">Home</a></li>
  <li>Guest</li>
</ul>


</body>
</html>