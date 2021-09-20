 <?php 

require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
 
$uid = $data['uid'];
if($uid == '')
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{ 
$count = $con->query("select * from user where id=".$uid."")->num_rows;
if($count != 0)
{
$wallet = $con->query("select * from user where id=".$uid."")->fetch_assoc();
$curr = $con->query("select signupcredit,refercredit from setting")->fetch_assoc();
$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Wallet Balance Get Successfully!","code"=>$wallet['code'],"signupcredit"=>$curr['signupcredit'],"refercredit"=>$curr['refercredit']);
}
else 
{
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Not Exist User!");
}
}
echo json_encode($returnArr);

