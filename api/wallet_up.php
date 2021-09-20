<?php 
require 'db.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['uid'] == '' or $data['wallet'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $wallet = strip_tags(mysqli_real_escape_string($con,$data['wallet']));
$uid =  strip_tags(mysqli_real_escape_string($con,$data['uid']));
$checkimei = mysqli_num_rows(mysqli_query($con,"select * from user where  `id`=".$uid.""));

if($checkimei != 0)
    {
		
		
       $con->query("update user set wallet = wallet+".$wallet." where id=".$uid."");
	   $con->query("insert into wallet_report(`uid`,`message`,`status`,`amt`)values(".$uid.",'Wallet Balance Added!!','Credit',".$wallet.")");
	   $wallet = $con->query("select * from user where id=".$uid."")->fetch_assoc();
        $returnArr = array("wallet"=>$wallet['wallet'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Wallet Update successfully!");
        
    
	}
    else
    {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Request To Update Own Device!!!!");  
    }
    
}

echo json_encode($returnArr);