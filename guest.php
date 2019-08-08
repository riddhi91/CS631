<?php 
	require 'DBConnect.php';
	if(isset($_POST['ex_name'])) {
		//echo $_POST['ex_name'];
		$db = new DBConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT Ins_id FROM instructor_class WHERE exercise_name = '" . $_POST['ex_name'] . "'");
		$stmt->execute();
		$Ins_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($Ins_id);
	}
 ?>