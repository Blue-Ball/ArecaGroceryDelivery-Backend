<?php 
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['rid'] == '')
{ 
 $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");    
}
else
{
 $rid =  strip_tags(mysqli_real_escape_string($con,$data['rid']));
 
  $sel = $con->query("select * from orders where rid=".$rid." and status ='completed' order by id desc");
  
  if($sel->num_rows != 0)
  {
  $result = array();
  $pp = array();
  while($row = $sel->fetch_assoc())
    {
 $oid = $row['oid']; 
    $a = explode('$;',$row['pname']);    
    $b =  explode('$;',$row['pprice']);
    $c = explode('$;',$row['ptype']);
    $d = explode('$;',$row['qty']);
    $e = explode('$;',$row['pid']);
     $k=array();
    for($i=0;$i<count($a);$i++)
    {
        $getimage = $con->query("select * from product where id=".$e[$i]."");
        $getimage = $getimage->fetch_assoc();
        $k[$i] = array("product_name"=>$a[$i],"product_price"=>number_format((float)$b[$i], 2, '.', ''),"product_weight"=>$c[$i],"product_qty"=>$d[$i],"product_image"=>$getimage['pimg'],"discount"=>$getimage['discount']);
    }
    $result['productinfo'] = $k;
    
    if($row['p_method'] == 'Pickup myself' and $row['status'] != 'completed' and $row['status'] != 'cancelled')
    {
        $status = $row['p_method'];
    }
    else 
    {
    $status =$row['status'];
    }
	
	$result['status'] = $status;
	$c = $con->query("select * from address where id='".$row['address_id']."'");
      $c = $c->fetch_assoc();
	  $cc = $con->query("select * from user where id='".$row['uid']."'");
      $cc = $cc->fetch_assoc();
	  
$dc = $con->query("select * from area_db where name='".$c['area']."'");
            $dc = $dc->fetch_assoc();
			 
			
			if($p_method == 'Pickup myself')
			{
				$px = 0;
			}
			else 
			{
				
			$px = $dc['dcharge'];
			}
			
			$result['d_charge'] = $px;
			
	$result['p_method'] = $row['p_method'];
    $result['total'] =$row['total'] ;
    $result['odate'] = $row['order_date'];
	$result['orderid'] = $row['id'];
    $result['timesloat'] = $row['timesloat'];
	$result['sign'] = $row['photo'];
	$result['astatus'] = $row['a_status'];
	$result['delivery'] = $c['hno'].','.$c['society'].','.$c['area'].'-'.$c['pincode']; 
	$result['email'] = $cc['email'];
	$result['mobile'] = $cc['mobile'];
	$result['name'] = $c['name'];
	$pp[] = $result;
    }
   
   
      
            
    $returnArr = array("order_data"=>$pp,"ResponseCode"=>"200","Result"=>"true","ResponseMsg"=>"Order Get successfully!");
  }
  else 
  {
	$returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"No Pending Order Found!");   
  }
}
echo json_encode($returnArr);