
<!DOCTYPE html>
<?php
$conn = new mysqli("localhost","root","root","NJITFitness");
if($conn->connect_error){
    die("Connection Failed");
	}
?>



<html>
<head>
<title>External Employee</title>
<link rel="stylesheet" type="text/css" href="../Styles/Common1.css">

<style>
.bodyClass{
	height:100%;flex-grow: 0;flex-shrink: 0;display: flex;
}
.rightDivClass{
	flex-basis: 15%;flex-grow: 0;flex-shrink: 0;
}
.leftDivClass{
	flex-basis: 75%;flex-grow: 0;flex-shrink: 0;
}
.childOfLeftDiv{
	margin: 50px 17px;
}
.childOfRightDiv{
	margin: 50px 17px;
}
.hrefClass{
	border-radius:20px;
    margin: 10px 0px;
    padding: 10px 32px;
	background: #d8d4d4;
    color: white;
}

</style>
</head>
<body>
<div class="headerClass"><center><h2 style="color:red;">NJIT Fitness Club</h2></div>
<div class="bodyClass">
	<div class="leftDivClass">
		<div class="childOfLeftDiv"><img src="../Images/gym.jpg" height="70%" width="100%"/></div>
	</div> <br>
	<div class="rightDivClass"><br>
		<form action="" method="post">
		<table class="instructorTableClass">
		<tr>
		</td>
		<label><b> External Employee ID:</b></label></td>
		<td><select name="exe">
<?php
$sql = "select external_emp_id, wage from external_emp";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result))
{
?>
  		<option <?php if($_POST['exe']== $row['external_emp_id']) echo'selected'?> value=<?php echo $row['external_emp_id']?>><?php echo $row["external_emp_id"];
		?>
		</option>

<?php
}
?>

</select></td>
</tr>
<tr><td><input name= "submit" name="submit" type="submit" style="margin-right: 15px" value="Submit"/></td></tr>
<?php 
if(isset($_POST['submit'])){
$exe=$_POST['exe'];
echo $exe;
$sql4 = "select * from external_emp where external_emp_id=".$exe;
       $result=mysqli_query($conn, $sql4);
       $row = mysqli_fetch_assoc($result);
       $wage= $row['wage'];
       $hours=$row['hours'];
       $pay =$wage*$hours;


}
?>


<tr><td>Wage </td>
<td>
<label id="wage" name="wage" value="<?php if(isset($_POST['wage'])){ echo $_POST['wage'];} ?>" > <?php echo $wage ?></label>
</td>
</tr>
<tr><td>Hours </td>
<td>
<label id="hours" name="hours" value="<?php if(isset($_POST['hours'])){ echo $_POST['hours'];} ?>" > <?php echo $hours ?></label>
</td>
</tr>
<tr><td>Salary </td>
<td>
<label id="salary" name="salary" value="<?php if(isset($_POST['salary'])){ echo $_POST['salary'];} ?>" > <?php echo $pay ?></label>
</td>
</tr>

	</form>
</div>
<ul class="breadcrumb">
  <li><a href="Index.php">Home</a></li>
  <li>External Employee</li>
</ul>
</table>
</body>
</html>
