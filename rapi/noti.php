<?php 
 
 require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
$uid = $data['uid'];

if ($uid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
	{
$sel = $con->query("select * from rnoti where rid=".$uid." order by id desc");
if($sel->num_rows != 0)
{
$myarray = array();
$p = array();
while($row = $sel->fetch_assoc())
{
    
    $myarray['id'] = $row['id'];
    $myarray['rid'] = $row['rid'];
    $myarray['msg'] = $row['msg'];
    $myarray['date'] = $row['date'];
    
    $p[] = $myarray;
}
$returnArr = array("data"=>$p,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Notification List Founded!");
}
else 
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Notification Not Founded!!");
}
	}
echo json_encode($returnArr);
?>