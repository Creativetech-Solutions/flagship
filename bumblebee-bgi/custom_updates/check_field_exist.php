<?php
mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

if(isset($_POST['ref_no']) && !empty($_POST['ref_no'])){

	$ref_no = $_POST['ref_no'];
	$sql = "SELECT COUNT(*) FROM bgi_reservations WHERE tour_ref_no = '$ref_no'";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	if(isset($row[0]) && $row[0] > 0)
		$response = ['type'=>'warning', 'message'=>'Reference number already exist', 'exist'=>1];
	else 
		$response = ['type'=>'success', 'message'=>'', 'exist'=>0];
}
else 
	$response = ['type'=>'success', 'message'=>'', 'exist'=>0];

echo json_encode($response);

?>