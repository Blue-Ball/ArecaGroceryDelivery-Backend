<?php 
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
function generate_random()
{
	require 'db.php';
	$six_digit_random_number = mt_rand(100000, 999999);
	$c_refer = $con->query("select * from user where code=".$six_digit_random_number."")->num_rows;
	if($c_refer != 0)
	{
		generate_random();
	}
	else 
	{
		return $six_digit_random_number;
	}
}
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
     $refercode = strip_tags(mysqli_real_escape_string($con,$data['refercode']));
     
     
    $checkmob = $con->query("select * from user where mobile='".$mobile."'");
    $checkemail = $con->query("select * from user where mobile='".$email."'");
   
    if($checkmob->num_rows != 0)
    {
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Mobile Number Already Used!");
    }
     else if($checkemail->num_rows != 0)
    {
        $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Email Address Already Used!");
    }
    else
    {
       if($refercode != '')
	   {
		 $c_refer = $con->query("select * from user where code=".$refercode."")->num_rows;
		 if($c_refer != 0)
		 {
			 $timestamp = date("Y-m-d H:i:s");
        $prentcode = generate_random();
		$wallet = $con->query("select * from setting")->fetch_assoc();
		$fin = $wallet['signupcredit'];
        $con->query("insert into user(`name`,`imei`,`email`,`mobile`,`rdate`,`password`,`ccode`,`code`,`refercode`,`wallet`)values('".$name."','".$imei."','".$email."','".$mobile."','".$timestamp."','".$password."','".$ccode."',".$prentcode.",".$refercode.",".$fin.")");
         $last_id = $con->insert_id;
		$con->query("insert into wallet_report(`uid`,`message`,`status`,`amt`)values(".$last_id.",'Sign up Credit Added!!','Credit',".$fin.")");
		$returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Registration successfully!");
		 }
		 else 
		 {
		$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Refer Code Not Found Please Try Again!!");
	   }
	   }
	   else 
	   {
        $timestamp = date("Y-m-d H:i:s");
        $prentcode = generate_random();
        $con->query("insert into user(`name`,`imei`,`email`,`mobile`,`rdate`,`password`,`ccode`,`code`)values('".$name."','".$imei."','".$email."','".$mobile."','".$timestamp."','".$password."','".$ccode."',".$prentcode.")");
    
        $returnArr = array("ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Registration successfully!");
	   }
    }
    
    
}

echo json_encode($returnArr);