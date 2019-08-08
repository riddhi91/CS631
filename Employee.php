
<!DOCTYPE html>
<?php
$conn = new mysqli("localhost","root","root","NJITFitness");
if($conn->connect_error){
    die("Connection Failed");
	}
?>


<html>
<head>
<title>Employee</title>
<link rel="stylesheet" type="text/css" href="../Styles/Common.css">

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
		<label><b>Employee ID:</b></label><br>
		<select name="emp">
<?php
$sql = "select emp_id from employee";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result))
{
?>
  		<option <?php if($_POST['emp']== $row['emp_id']) echo'selected'?> value=<?php echo $row['emp_id']?>><?php echo $row["emp_id"];
		?>
		</option>

<?php
}
?>

</select><br><br>
<tr><td><input name= "submit" name="submit" type="submit" style="margin-right: 15px" value="Submit"/></td></tr>
<?php 
if(isset($_POST['submit'])){
$emp=$_POST['emp'];
//echo $emp;
$sql4 = "select  * from employee where emp_id=".$emp;
       $result=mysqli_query($conn, $sql4);
       $row = mysqli_fetch_assoc($result);
       $org= $row['salary'];
	//	echo $org;
		$val= ($org*0.1)+($org*0.05)+($org*0.03);
		$net = $org-$val;
		//echo $net;


}
?>


<tr><td>Original Salary </td>
<td>
<label id="org" name="org" value="<?php if(isset($_POST['org'])){ echo $_POST['org'];} ?>" > <?php echo $org ?></label>
</td>
</tr>
<tr><td>Net Pay </td>
<td>
<label id="net" name="net" value="<?php if(isset($_POST['net'])){ echo $_POST['net'];} ?>" > <?php echo $net ?></label>
</td>


	</form>

</div>
<ul class="breadcrumb">
  <li><a href="Index.php">Home</a></li>
  <li> Employee</li>
</ul>
</table>
</body>
</html>