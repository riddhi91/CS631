<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
$conn = new mysqli("localhost","root","root","NJITFitness");
if($conn->connect_error){
    die("Connection Failed");
	}
?>
<html>
<head>
<title>Exercise Management</title>
<link rel="stylesheet" type="text/css" href="../Styles/Common.css">
</head>
<body>
<div class="headerClass" style="color: red"><h3>NJIT Fitness Club</h3></div>
<div class="container">
<form method="POST" style="margin:0px" autocomplete="off">
<table class="instructorTableClass">
<tr><th colspan="2"><h1 style="float:left">Schedule a new Class</h1></th><tr>
<tr><td>Intructor Id</td><td><input type="text" id="instructorId" name="instructorId" 
 value="<?php if(isset($_POST['instructorId'])){ echo $_POST['instructorId'];} ?>"/><td>

</td></tr>
<tr><td>Exercise Name</td><td>
<select id="ex_name" name="ex_name" >
<?php
  $sql= "select ex_name from exercise order by ex_name asc";
  $result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) { ?>
    	<option <?php if($_POST['ex_name']== $row['ex_name']) echo'selected'?> value=<?php echo $row['ex_name']?>> <?php echo $row['ex_name'];?></option>
<?php
      }
      }//if
  ?>

</select>
</td></tr>
<tr><td>Class Id</td><td><input type="number" id="classId" name="classId" min="1" max="10" value="<?php if(isset($_POST['classId'])){ echo $_POST['classId'];} ?>"/></td></tr>
<tr><td>Date</td><td><input type="Date" id="date" name="date" min="<?php date('Y-m-d');?>" value="<?php if(isset($_POST['date'])){ echo $_POST['date'];} ?>"/></td></tr>
<tr><td>Time</td><td><input type="time" id="time" name="time" value="<?php if(isset($_POST['time'])){ echo $_POST['time'];} ?>"/></td></tr>
<tr><td>Room No</td>
<td>
<select id="room" name="room">
<?php
  $sql= "select room_id from room order by room_id asc";
  $result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) { ?>
    	<option <?php if($_POST['room']== $row['room_id']) echo'selected'?> value=<?php echo $row['room_id']?>> <?php echo $row['room_id'];?></option>
<?php
      }
      }//if
  ?>
  </select>
</td>
</tr>
<tr style="height:130px"><td colspan="2" class="submitButtonTdClass"><input type="submit" name="submit" value="Submit" /></td>
</tr>
</form>
<?php
   
if(isset($_POST['submit'])){
	$instructorId=$_POST['instructorId'];
	$ex_name=$_POST['ex_name'];
	$classId=$_POST['classId'];
	$date=$_POST['date'];
	$time=$_POST['time'].":00";
	$room=$_POST["room"];
	$count=0;
	$sql = "SELECT date,time FROM instructor_class where Ins_id=".$instructorId;
	$sql1 = "SELECT date,time FROM instructor_class where room_id=".$room;
	
	$result = mysqli_query($conn,$sql);
	$result1= mysqli_query($conn,$sql1);
	if ((mysqli_num_rows($result) > 0)) {
		while($row = mysqli_fetch_assoc($result)) {
		if($row['date']==$date && $row['time']==$time){
			$count=1;
			echo '<script language="javascript">';
			echo 'alert("Instructor is busy at this date and time ")';
			echo '</script>';
			break;
			}
			}
			}
	if ((mysqli_num_rows($result1) > 0)) {
			while($row1= mysqli_fetch_assoc($result1)) {
			if($row1['date']==$date && $row1['time']==$time){
				$count=1;
				echo '<script language="javascript">';
				echo 'alert("Class Room is occupied at this time and date ")';
				echo '</script>';
				break;
			}//if
       }//while
      }//elseif
	
	if ($count==0){
	
			$sql2="select Ins_name from instructor where Ins_id=".$instructorId;
       		$result2=mysqli_query($conn, $sql2);
       		$row2 = mysqli_fetch_assoc($result2);
       		if($row2['Ins_name']){
            	$instructorId=$_POST['instructorId'];
            	$sql4="insert into instructor_class(exercise_name,ex_class_id,Ins_id,room_id,date,time,seats) values('".$ex_name."',".$classId.",".$instructorId.",'".$room."','".$date."','".$time."','0')";
				if (mysqli_query($conn, $sql4)){
					//echo $count;
					echo '<script language="javascript">';
					echo 'alert("Registered ")';
					echo '</script>';
				}
				else
					echo mysqli_error($conn);
       		}
       
   			else{
   		
   				echo '<script language="javascript">';
				echo 'alert("Instructor not Registered ")';
				echo '</script>';
   				}
   		}
	mysqli_close($link);
}
?>


</div>
<ul class="breadcrumb">
  <li><a href="Index.php">Home</a></li>
  <li>Instructor</li>
</ul>
</body>
</html>
