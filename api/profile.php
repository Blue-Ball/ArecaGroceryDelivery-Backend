<?php 
require 'db.php';
header('Content-type: text/json');
$data = json_decode(file_get_contents('php://input'), true);
if($data['name'] == '' or $data['email'] == '' or $data['mobile'] == '' or $data['imei']==''  or $data['password'] == '' or $data['ccode'] == '')
{
    
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    $name = strip_tags(mysqli_real_escape_string($con,$data['name']));
    $email = strip_tags(mysqli_real_escape_string($con,$data['email']));
    $mobile = strip_tags(mysqli_real_escape_string($con,$data['mobile']));
	$ccode = strip_tags(mysqli_real_escape_string($con,$data['ccode']));
    $imei = strip_tags(mysqli_real_escape_string($con,$data['imei']));
     $password = strip_tags(mysqli_real_escape_string($con,$data['password']));
$uid =  strip_tags(mysqli_real_escape_string($con,$data['uid']));
$checkimei = mysqli_num_rows(mysqli_query($con,"select * from user where  `id`=".$uid.""));

if($checkimei != 0)
    {
		
		
       $con->query("update user set name='".$name."',email='".$email."',mobile='".$mobile."',password='".$password."',ccode='".$ccode."' where id=".$uid."");
            $c = $con->query("select * from user where id='".$uid."'");
            $c = $c->fetch_assoc();
            $dc = $con->query("select * from area_db where name='".$c['area']."'");
            $dc = $dc->fetch_assoc();
        $returnArr = array("user"=>$c,"d_charge"=>$dc['dcharge'],"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Profile Update successfully!");
        
    
	}
    else
    {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Request To Update Own Device!!!!");  
    }
    
}

echo json_encode($returnArr);