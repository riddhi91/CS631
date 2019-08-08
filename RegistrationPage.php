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
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
		
			$("#ex_name").change(function(){
				var ex_name = $("#ex_name").val();
				$.ajax({
					url: 'guest.php',
					method: 'post',
					data: 'ex_name=' + ex_name
				}).done(function(Ins_id){
					console.log(Ins_id);
					Ins_id = JSON.parse(Ins_id);
					
					$('#Ins_id').empty();
					Ins_id .forEach(function(Ins_id){
			
						$('#Ins_id').append('<option value = ' +Ins_id.Ins_id + '>' + Ins_id.Ins_id + '</option>')
					})
				})
			})
		})
	</script>
	
<script type="text/javascript">	
	
	window.onload = function() {
    document.getElementById('Ins_id').focus();
    
    }
</script>	
</head>
<body>
<div class="headerClass" style="color: red"><h3>NJIT Fitness Club</h3></div>
<div class="container">
<form action="" method="POST"style="height:100%" autocomplete="off">
<table class="instructorTableClass">
<tr><th colspan="2"><h1 style="float:left">Member Registration</h1></th><tr>
<tr><td>Exercise Name</td>
<td>
<select id="ex_name" name="ex_name">
  <?php
  $sql= "select ex_name from exercise order by ex_name asc";
  $result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) { ?>
    	<option <?php if($_POST['ex_name']== $row['ex_name']) echo'selected'?> value=<?php echo $row['ex_name']?>> 
    	<?php echo $row['ex_name'];
    	?></option>
<?php
      }
      }//if
  ?>
  
</select>
</td>

</tr>
<tr><td>Instructor Id </td>
<td>
<select id = "Ins_id" name="Ins_id" autofocus >

  
</select>
</td>
<td  colspan="2"><input type="submit" name="submit" value="Submit" /></td>
</tr>
<tr><td>Member Id</td>
<td>
<select id="member_id" name="member_id">
  <?php
  $sql= "select member_id from members order by member_id asc";
  $result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) { ?>
    	<option <?php if($_POST['member_id']== $row['member_id']) echo'selected'?> value=<?php echo $row['member_id']?>> 
    	<?php echo $row['member_id'];
    	?></option>
<?php
      }
      }//if
  ?>
  
</select>
</td>

</tr>
<?php
 // $ans=-1;
if(isset($_POST['submit'])){
	
	$name=$_POST['ex_name'];
	$ins_id=$_POST['Ins_id'];
// Attempt select query execution
//echo $Member_Id;
	$sql = "SELECT * FROM instructor_class where Ins_id=".$ins_id ." and exercise_name='".$name."'";
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      	  $date=$row['date'];
      	  $time=$row['time'];
      	  break;
       }
       $sql1 = "select * from instructor_class where Ins_id=".$ins_id ." and exercise_name='".$name."' and date = '".$date."' and time='".$time ."'";
       $result=mysqli_query($conn, $sql1);
       $row = mysqli_fetch_assoc($result);
       $room= $row['room_id'];
       $s1=$row['seats'];
   //   echo $s1;
       
       $sql2="select * from room where room_id=".$room;
       $result=mysqli_query($conn, $sql2);
       $row = mysqli_fetch_assoc($result);
       $s2=$row['seats'];
       
       $ans= $s2-$s1;
      // $ava = $ava -1 ;
       if($ava <0)
           $ans=0;
        
      }//if
	else{
   		$date='No classes Scheduled';
   		$time='';
	}
	}
if(isset($_POST['submit1'])){
$name=$_POST['ex_name'];
$ins_id=$_POST['Ins_id'];
$memid=$_POST['member_id'];
$guest=$_POST['guest'];
$sql = "SELECT * FROM instructor_class where Ins_id=".$ins_id ." and exercise_name='".$name."'";
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      	  $date=$row['date'];
      	  $time=$row['time'];
      	  break;
       }
}

$sql4 = "select * from instructor_class where Ins_id=".$ins_id ." and exercise_name='".$name."' and date = '".$date."' and time='".$time ."'";
       $result=mysqli_query($conn, $sql4);
       $row = mysqli_fetch_assoc($result);
       $room= $row['room_id'];
       $s1=$row['seats'];
	$st=$s1+1;
	
	 $sql2="select * from room where room_id=".$room;
       $result=mysqli_query($conn, $sql2);
       $row = mysqli_fetch_assoc($result);
       $s2=$row['seats'];
       
       $ans= $s2-$s1;
      // $ava = $ava -1 ;
       if($ava <0)
           $ans=0;
		
 $sql3= "update instructor_class set seats= '".$st."' where Ins_id=".$ins_id ." and exercise_name='".$name."' and date = '".$date."' and time='".$time ."'";
// $sql3= "update instructor_class set seats= '13' where Ins_id=".$ins_id." and exercise_name='Cardio' and date = '2019-08-06' and time='05:30:00'";
  if(mysqli_query($conn, $sql3)){
    echo '<script language="javascript">';
	echo 'alert("Successfully Registered")';
	echo '</script>';
}
else {
echo '<script language="javascript">';
	echo 'alert("Successfully Registered")';
	echo '</script>';
} 
$sql6= "update membership set no_of_guest= ".$guest." where member_id=".$memid;
	// $sql3= "update instructor_class set seats= '13' where Ins_id=".$ins_id." and exercise_name='Cardio' and date = '2019-08-06' and time='05:30:00'";
  if(mysqli_query($conn, $sql6)){
   
}
}
	
	// Close connection
	mysqli_close($link);
?>

<tr><td>Date </td>
<td>
<label id="date" name="date" value="<?php if(isset($_POST['date'])){ echo $_POST['date'];} ?>" > <?php echo $date ?></label>
</td>
</tr>
<tr><td>Time</td>
<td>
<label id="time" name="time" value="<?php if(isset($_POST['time'])){ echo $_POST['time'];} ?>"  ><?php echo $time ?> </label>
</td>
</td>
</tr>
<tr><td>Available Seats</td><td><label id="seats" name="seats" value="<?php if(isset($_POST['seats'])){ echo $_POST['seats']-1 ;} ?>"><?php echo $ans ?></label></td></tr>
<tr><td>Number of Guest</td><td><input type="text" id="guest" name="guest" 
 value="<?php if(isset($_POST['guest'])){ echo $_POST['guest'];} ?>"/><td>

</td></tr>
<tr style="height:130px"><td colspan="2" class="submitButtonTdClass"><input type="submit" name="submit1" value="Register" /></td></tr><tr style="height:130px"><td colspan="2" class="submitButtonTdClass"><input type="reset" name="reset" value="Reset" /></td></tr>

</form>
</div>
<ul class="breadcrumb">
  <li><a href="Index.php">Home</a></li>
  <li>Member Registration</li>
</ul>
</body>
</html>
