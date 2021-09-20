<?php 
require 'db.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
$uid =  strip_tags(mysqli_real_escape_string($con,$data['uid']));
$checkimei = mysqli_num_rows(mysqli_query($con,"select * from user where  `id`=".$uid.""));

if($checkimei != 0)
    {
		
		
       $sel = $con->query("select * from wallet_report where uid=".$uid."");
$myarray = array();
while($row = $sel->fetch_assoc())
{
	$myarray[] = $row;
}
    $returnArr = array("data"=>$myarray,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Wallet Report Get Successfully!");
	}
    else
    {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Request To Update Own Device!!!!");  
    }
    
}

echo json_encode($returnArr);