<?php 
  require 'include/header.php';
  ?>
  <body data-col="2-columns" class=" 2-columns ">
       <div class="layer"></div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">


      <!-- main menu-->
      <!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->
      <?php include('main.php'); ?>
      <!-- Navbar (Header) Ends-->

      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper"><!--Statistics cards Starts-->

<section id="dom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Delivery Boy List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                       
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Sr No.</th>
                                   
                                    <th>Delivery Boy Name</th>
                                   <th>Delivery Boy Mobile</th>
								    <th>Delivery Boy Email</th>
									 <th>Delivery Boy Area</th>
									  <th>Delivery Boy Address</th>
									   <th>Delivery Boy Status</th>
									   <th>Delivery Boy App Status(On/Off)</th>
									    <th>Delivery Boy Total Reject</th>
										<th>Delivery Boy Total Accept</th>
										<th>Delivery Boy Total Complete</th>
										
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $jj = $con->query("select * from rider");
                                $i=0;
                                while($rkl = $jj->fetch_assoc())
                                {
                                    $i = $i + 1;
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    
                                    <td><?php echo $rkl['name'];?></td>
                                   <td><?php echo $rkl['mobile'];?></td>
								   <td><?php echo $rkl['email'];?></td>
								   <td><?php $ad = $con->query("select * from area_db where id=".$rkl['aid']."")->fetch_assoc(); echo $ad['name'];?></td>
 <td><?php echo $rkl['address'];?></td> 								  
								  <td><?php if($rkl['status'] == 1){echo 'Active';}else {echo 'Deactive';}?></td> 
								    <td><?php if($rkl['a_status'] == 1) {echo 'On';}else {echo 'Off';}?></td> 
								   <td><?php echo $rkl['reject'];?></td>
								   <td><?php echo $rkl['accept'];?></td>
								   <td><?php echo $rkl['complete'];?></td>
                                    <td>
									<?php if($rkl['status'] == 0) {?>
									<a href="?status=1&rid=<?php echo $rkl['id'];?>">	<button class="btn btn-success"   data-original-title="" title="">
                                           Make Active
                                        </button></a>
									<?php } else { ?>
								<a	href="?status=0&rid=<?php echo $rkl['id'];?>">	<button class="btn btn-danger"  href="?status=0&rid=<?php echo $rkl['id'];?>" data-original-title="" title="">
                                            Make Deactive
                                        </button>
										</a>
									<?php } ?>
										</td>
                                   
                                </tr>
                               <?php } ?>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php 
if(isset($_GET['status']))
{
$status = $_GET['status'];
$id = $_GET['rid'];

  $con->query("update rider set status=".$status." where id=".$id."");  
?>
	 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.info('Delivery Boy Status Update Successfully!!');
	setTimeout(function()
	{
		window.location.href="riderlist.php";
	},1500);
    
  });
  </script>
  <?php
}
?>



          </div>
        </div>

        

      </div>
    </div>
   
    <?php 
  require 'include/js.php';
  ?>
   
  </body>


</html>