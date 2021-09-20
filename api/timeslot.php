<?php 
require 'db.php';
$sel = $con->query("select * from timeslot");
$p = array();
while($row = $sel->fetch_assoc())
{
    $myarray['id'] = $row['id'];
	$myarray['mintime'] = date("g:i A", strtotime($row['mintime']));
	$myarray['maxtime'] = date("g:i A", strtotime($row['maxtime']));
	$p[] = $myarray;
}
$returnArr = array("data"=>$p,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Timeslot Founded!");
echo json_encode($returnArr);
?>

