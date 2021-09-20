
<?php 

require 'include/dbconfig.php';

$pid = $_POST['pid'];
$c = $con->query("select * from orders where id=".$pid."")->fetch_assoc();
$uinfo = $con->query("select * from address where id=".$c['address_id']."")->fetch_assoc();
$user = $con->query("select * from user where id=".$c['uid']."")->fetch_assoc();
 

?>
<input type='button' id='btn' class="btn btn-primary text-right" value='Print' onclick='printDiv();' style="float:right;">
<div id="divprint">
<h5><b>Order Id :- <?php echo $pid;?></b></h5>
<h5><b>Customer Name :- <?php echo $uinfo['name'];?></b></h5>
<h5><b>Customer Mobile :- <?php echo $user['mobile'];?></b></h5>
<h5><b>Address :- <?php echo $uinfo['hno'].','.$uinfo['society'].','.$uinfo['area'].'-'.$uinfo['pincode'];?></b></h5>
<h5><b>Landmark:- <?php echo $uinfo['landmark'];?></b></h5>

<h5><b>Payment Method :- <?php echo $c['p_method'];?></b></h5>

<h5><b>Delivery Date :- <?php echo str_replace('--','',$c['ddate']);?></b></h5>
<h5><b>Delivery Slot :- <?php echo $c['timesloat'];?></b></h5>
<?php 
if($c['p_method'] == 'Cash on delivery' or $c['p_method'] == 'Cash On Delivery' or $c['p_method'] == 'Pickup myself' or $c['p_method'] == 'Pickup Myself')
{
}
else
{
	?>
	<h5><b>Transaction Id :- <?php echo $c['tid'];?></b></h5>
	<?php 
}
?>
<div class="table-responsive">
<table class="table">
<tr>
<th>Sr No.</th>
<th>Prodct Name</th>
<th>Prodct Image</th>
<th>Discount</th>
<th>Prodct Type</th>
<th>Prodct Price</th>
<th>Product Qty</th>
<th>Product Total</th>
</tr>
<?php 
$prid = explode('$;',$c['pid']);
$qty = explode('$;',$c['qty']);
$ptype = explode('$;',$c['ptype']);
$pprice = explode('$;',$c['pprice']);
$pcount = count($qty);

$op = 0;
$subtotal = 0;
	 $ksub = array();
	 
for($i=0;$i<$pcount;$i++)
{
	$op = $op + 1;
$pinfo = $con->query("select * from product where id=".$prid[$i]."")->fetch_assoc();
$discount = $pprice[$i] * $pinfo['discount']*$qty[$i] /100;
	?>
<tr>
<td><?php echo $op;?></td>
<td><?php echo $pinfo['pname'];?></td>
<td><img src="<?php echo $pinfo['pimg'];?>" width="100px"/></td>
<td><?php echo $pinfo['discount'];?></td>
<td><?php echo $ptype[$i];?></td>
<td><?php echo $pprice[$i];?></td>
<td><?php echo $qty[$i];?></td>
<td><?php echo ($pprice[$i] * $qty[$i]) - $discount;?></td>
</tr>
<?php


        $ksub [] = $subtotal  + ($qty[$i] * $pprice[$i]) - $discount;
        
} ?>
</table>
</div>
<?php
$subtotal = number_format((float)array_sum($ksub), 2, '.', '');
$tax = number_format((float) $subtotal * $c['tax']/100, 2, '.', '');
$coupon = $c['cou_amt'];
 $wallet = $c['wal_amt'];
?>
<ul class="list-group">
  <li class="list-group-item">
    <span class="badge bg-primary float-right budge-own" ><?php echo $c['p_method'];?></span> Payment Method
  </li>
  <li class="list-group-item">
    <span class="badge bg-info float-right budge-own" ><?php echo $subtotal?></span> Sub Total Price
  </li>
  
   <li class="list-group-item">
    <span class="badge bg-info float-right budge-own" ><?php echo $tax;?></span> Tax
  </li>
  <?php 
  if($coupon != 0)
  {
  ?>
   <li class="list-group-item">
    <span class="badge bg-info float-right budge-own" ><?php echo $coupon;?></span> Coupon Discount
  </li>
  <?php } ?>
  
  <?php 
  if($wallet != 0)
  {
  ?>
   <li class="list-group-item">
    <span class="badge bg-info float-right budge-own" ><?php echo $wallet;?></span> Wallet
  </li>
  <?php } ?>
  
  <li class="list-group-item">
    <span class="badge bg-info float-right budge-own" ><?php echo $c['total']- (($subtotal+$tax) - ($coupon + $wallet));?></span> Delivery Charge
  </li>
  
   <li class="list-group-item">
    <span class="badge bg-info float-right budge-own" ><?php echo $c['total'];?></span> Net Amount
  </li>
  <li class="list-group-item">
    <span class="badge bg-warning float-right budge-own" ><?php echo $c['status'];?></span> Order Status
  </li>
 
</ul>
</div>