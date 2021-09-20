 <?php 
 
 require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
$uid = $data['uid'];

$aid = $data['aid'];

if($uid == '' or $aid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$count = $con->query("select * from user where id=".$uid." and status = 1")->num_rows;
	if($count != 0)
	{
		$check = $con->query("select * from address where uid=".$uid." and id = ".$aid."")->num_rows;
		if($check != 0)
		{
			//$con->query("Delete from address where uid=".$uid." and id = ".$aid."");
			$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"For Demo purpose all  Insert/Update/Delete are DISABLED.");
		}
		else 
		{
			$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Sorry You Not Delete Someone Address!!");
		}
	}
	else 
	{
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"User Either Not Exit OR Deactivated From Admin!");
	}
}
echo json_encode($returnArr);
mysqli_close($con);
?> 