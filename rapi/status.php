 <?php
require 'db.php';
 header( 'Content-Type: text/html; charset=utf-8' ); 
$data = json_decode(file_get_contents('php://input'), true);

$uid = $data['uid'];
$status = $data['status'];
if ($uid =='' or $status =='')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$con->query("update rider set a_status='".$status."' where id='".$uid."'");
     $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Status Changed Successfully!!!!!");    
}
echo json_encode($returnArr);
mysqli_close($con);
?>