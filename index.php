<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
<title>Exercise Management</title>
<link rel="stylesheet" type="text/css" href="../Styles/Common.css">
<style> 
.bodyClass{
	height:100%;flex-grow: 0;flex-shrink: 0;display: flex;
        
}
.rightDivClass{
	flex-basis: 25%;flex-grow: 0;flex-shrink: 0;
        margin-top: 15%;
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
.headerClass{
    color:red;
    text-align: center;
}

</style>
</head>
<body >
    <div class="headerClass" ><h1 >NJIT Fitness Club</h1></div>
<div class="bodyClass">
	<div class="leftDivClass">
		<div class="childOfLeftDiv"><img src="../Images/HomeImage.jpg" height="70%" width="100%"/></div>
	</div>
	<div class="rightDivClass">
		<div class="childOfRightDiv">
			<div class="hrefClass"><a  href="External_emp.php">Calculate Wage for External Employee</a></div>
			<div class="hrefClass"><a  href="Employee.php">View Employee's Salary</a></div>
		<!--	<div class="hrefClass"><a  href="GuestPage.php">Guest Registration</a></div>-->
			<div class="hrefClass"><a  href="registrationpage.php">Register Class</a></div>
			<div class="hrefClass"><a  href="Instructor.php">Schedule Class</a></div>
		</div>
	</div>
</div>
</body>
</html>
