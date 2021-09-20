<?php 
require 'db.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['name'] == '' or $data['email'] == '' or $data['mobile'] == ''   or $data['password'] == '' or $data['aid'] == '' or $data['address'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $name = strip_tags(mysqli_real_escape_string($con,$data['name']));
    $email = strip_tags(mysqli_real_escape_string($con,$data['email']));
    $mobile = strip_tags(mysqli_real_escape_string($con,$data['mobile']));
    $aid = strip_tags(mysqli_real_escape_string($con,$data['aid']));
    $address = strip_tags(mysqli_real_escape_string($con,$data['address']));
     $password = strip_tags(mysqli_real_escape_string($con,$data['password']));
$uid =  strip_tags(mysqli_real_escape_string($con,$data['uid']));
$checkimei = mysqli_num_rows(mysqli_query($con,"select * from rider where  `id`=".$uid.""));

if($checkimei != 0)
    {
		
        date_default_timezone_set('Asia/Kolkata');
        $timestamp = date("Y-m-d H:i:s");
       $con->query("update rider set name='".$name."',aid=".$aid.",address='".$address."',email='".$email."',mobile='".$mobile."',password='".$password."' where id=".$uid."");
            $c = $con->query("select * from rider where id='".$uid."'");
            $c = $c->fetch_assoc();
        $returnArr = array("rider"=>$c,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Profile Update successfully!");
        
    
	}
    else
    {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"This Rider Not Exists!!!!");  
    }
    
}

echo json_encode($returnArr);