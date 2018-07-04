<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$conn = mysqli_connect('localhost','root','chocolate','cocoa_bgi');

if(isset($_POST['action']) && $_POST['action']=='delete' && isset($_POST['reportId'])){
	$response = mysqli_query($conn, "DELETE FROM bgi_reports WHERE id=".$_POST['reportId']);
	if($response){
		unset($_SESSION['adhoc_report']);
		echo 'success::Report has been Deleted Successfully';
	} else {
		echo 'error::Report not deleted. Try Again';
	}
} 
else  {
// get report name and setting from session
$reportName = $_SESSION['reportName'];
$reportSettings = json_encode($_SESSION['adhoc_report']);
// get current user id and save with report setting, to provide report access to authorized person
$userid = $_SESSION['userid'];

if(isset($_POST['reportId']) && !empty($_POST['reportId'])){
	$rep_id = $_POST['reportId'];
	$response = mysqli_query($conn, "UPDATE bgi_reports SET `name`='$reportName', `setting`='$reportSettings',`user_id`='$userid' WHERE `id`='$rep_id'");

	if($response){
		echo 'success::Report has been Edited Successfully';
	} else {
		echo 'error::Report not Edited';
	}
} else {
	if(isset($_POST['sect']) && $_POST['sect']=='fsft'){
		$fsft = 1;
	} elseif(isset($_POST['sect']) && $_POST['sect']=='all') {
		$fsft = 2;
	} else 
		$fsft = 0;
	$date = date('Y-m-d H:i:s');
	$response = mysqli_query($conn, "INSERT INTO bgi_reports (`name`, `setting`, `user_id`, `fsft`, `created_date`) VALUE ('$reportName', '$reportSettings', '$userid', '$fsft', '$date')");

	if($response){
		echo 'success::Report has been Saved Successfully';
	} else {
		echo 'error::Report not saved';
	}
}


}
?>