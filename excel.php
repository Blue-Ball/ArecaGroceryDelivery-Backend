<?php 
  require 'include/header.php';
  $getkey = $con->query("select * from setting")->fetch_assoc();
define('ONE_KEY',$getkey['one_key']);
define('ONE_HASH',$getkey['one_hash']);
define('r_key',$getkey['r_key']);
define('r_hash',$getkey['r_hash']);
  ?>
  <body data-col="2-columns" class=" 2-columns ">
       <div class="layer"></div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">


     
     <?php include('main.php'); ?>
     

      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper"><!--Statistics cards Starts-->

<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
			
                <div class="card-header">
                    <h4 class="card-title">Order List Export</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                     <div>
                         <form method="post">
                             <div class="form-body row">
                             <div class="col-md-3">
                             <div class="form-group">
                                 
                                 <input type="date" name="start_date" class="form-control" required/>
                                 
                             </div>
                             </div>
                             
                              <div class="col-md-3">
                             <div class="form-group">
                                 <input type="date" name="end_date" class="form-control" required/>
                                 
                             </div>
                             </div>
                             
                              <div class="col-md-3">
                             <div class="form-group">
                                 <select name="status" class="form-control" required>
                                     <option value="">select a status</option>
                                     <option value="pending">pending</option>
                                     <option value="completed">completed</option>
                                 </select>
                                 
                             </div>
                             </div>
                             
                              <div class="col-md-3">
                             <div class="form-group">
                                 <input type="submit" name="sub_filter" class="btn btn-primary" value="check order"/>
                                 
                             </div>
                             </div>
                             </div>
                         </form>
                     </div>
                     <?php 
                     if(isset($_POST['sub_filter']))
                     {
                         
                     $start_date = $_POST['start_date'];
                     $end_date = $_POST['end_date'];
                     $status = $_POST['status'];
                     ?>
                        <table class="table table-striped" id="example">
                            <thead>
                                <tr>
								 <th>Sr No.</th>
                                    <th>Date</th>
                                     <th>Order ID</th>
                                     <th>Customer Name</th>
                                     <th>Customer Address</th>
                                     <th>Customer Email</th>
                                     <th>Customer Mobile</th>
                                     <th>Product Name</th>
                                     <th>Total Price</th>
                                     <th>Delivery Charge</th>
									  <th>Coupon Discount</th>
									  <th>Delivery Boy Name</th>
									  <th>Delivery Boy Mobile</th>
									  <th>Delivery Boy Email</th>
									  <th>Delivery Boy Address</th>
									  
                                     <th>Status</th>
                                 
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sel = $con->query("select * from orders where status ='".$status."' and order_date >='".$start_date."' and order_date <='".$end_date."' order by id desc");
                                $i=0;
                                while($row = $sel->fetch_assoc())
                                {
                                    $add = $con->query("select * from address where id=".$row['address_id']."")->fetch_assoc();
                                    $user = $con->query("select * from user where id=".$row['uid']."")->fetch_assoc();
                                    
                                     $dc = $con->query("select * from area_db where name='".$add['area']."'")->fetch_assoc();
                                    
                                    $i = $i + 1;
                                ?>
                                <tr>
                                    
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['order_date'];?></td>
									
                                    <td><?php echo $row['id'];?></td>
                                    <td><?php echo $add['name'];?></td>
                                    <td><?php echo $add['hno'].','.$add['society'].','.$add['landmark'].','.$add['area'].'-'.$add['pincode'];?></td>
                                    <td><?php echo $user['email'];?></td>
                                    <td><?php echo $user['mobile'];?></td>
                                    
                                    <td><?php echo $pname = str_replace('$;',' ---',$row['pname']); ?></td>
                                    
                                    <td style="min-width:100px;"><?php echo $row['total'].' '.$fset['currency'];?></td>
                                    <td><?php echo $dc['dcharge'].' '.$fset['currency'];?></td>
									<td><?php echo $row['cou_amt'].' '.$fset['currency'];?></td>
                                   <td><?php $rdata = $con->query("select * from rider where id=".$row['rid']."")->fetch_assoc(); if($rdata['name'] == '') {echo '';}else {echo $rdata['name'];}?>
                                    </td>
                                    
                                     <td><?php $rdata = $con->query("select * from rider where id=".$row['rid']."")->fetch_assoc(); if($rdata['mobile'] == '') {echo '';}else {echo $rdata['mobile'];}?>
                                    </td>
                                    
                                     <td><?php $rdata = $con->query("select * from rider where id=".$row['rid']."")->fetch_assoc(); if($rdata['email'] == '') {echo '';}else {echo $rdata['email'];}?>
                                    </td>
                                    
                                     <td><?php $rdata = $con->query("select * from rider where id=".$row['rid']."")->fetch_assoc(); if($rdata['address'] == '') {echo '';}else {echo $rdata['address'];}?>
                                    </td>
                                    
									<td><?php echo ucfirst($row['status']);?></td>
                                 
                                   
                                </tr>
                               <?php  }?>
                            </tbody>
                            
                        </table>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>




          </div>
        </div>

      

      </div>
    </div>
    
  <?php require 'include/js.php';?>
    
  </body>
  
  

  <script>
       $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            
            'excelHtml5'
           
        ]
    } );
  </script>
 
<style>
#example_wrapper
{
    overflow:auto;
}
    td p {
   /* border-bottom: 1px solid #dee2e6;*/
    /* padding: 0% !important; */
    margin: 0px;
   /* font-size:11px;*/
}
td.manage_td
{
padding: 0% !important;
}
table
{
   /* font-size:12px;*/
}
}
</style>

</html>