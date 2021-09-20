<?php 
require 'db.php';
 
$data = json_decode(file_get_contents('php://input'), true);


$rid = $data['rid'];
if ($rid == '')
{
$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went wrong  try again !");
}
else 
{
	$pok = array();
	$p =0 ;
	$riderdata = $con->query("select * from rider where id=".$rid."")->fetch_assoc();
	$pok['total_complete_order'] = $riderdata['complete'];
	$pok['total_reject_order'] = $riderdata['reject'];
	$pok['rider_status'] = $riderdata['a_status'];
	$pok['total_accept_order'] = $riderdata['accept'];
	$sale = $con->query("select sum(`total`) as total_earn from orders where rid=".$rid." and status='completed'")->fetch_assoc();
     if($sale['total_earn'] == '')
	 {
		 $p =0;
	 }
	 else 
	 {
		 $p = number_format((float)$sale['total_earn'], 2, '.', '');
	 }
	 $pok['total_sale'] = $p;
	 $returnArr = array("order_data"=>$pok,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Status Get Successfully!!!!!");    
}
echo json_encode($returnArr);
mysqli_close($con);
?>
