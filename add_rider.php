<?php 
  require 'include/header.php';
  ?>
  


  <body data-col="2-columns" class=" 2-columns ">
      <div class="layer"></div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">


     
      <?php include('main.php'); ?>
      <!-- Navbar (Header) Ends-->

      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper"><!--Statistics cards Starts-->

<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Add Delivery Boy</h4>
					
				</div>
				<div class="card-body">
					<div class="px-3">
						<form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">
								

								

								<div class="form-group">
									<label for="cname">Delivery Boy Name</label>
									<input type="text" id="aname" class="form-control" placeholder="Enter Delivery Boy Name"  name="cname" required >
								</div>
								
								<div class="form-group">
									<label for="cname">Delivery Boy Mobile Number(Only Digit)</label>
									<input type="text" id="dcharge"   class="form-control" pattern="[0-9]+"  placeholder="Enter Delivery Boy Mobile Number" name="dcharge" required >
								</div>
								
									<div class="form-group">
									<label for="cname">Delivery Boy Email Address</label>
									<input type="email"   class="form-control"   placeholder="Enter Delivery Boy Email Address" name="email" required >
								</div>
								
								<div class="form-group">
									<label for="cname">Delivery Boy Password</label>
									<input type="text"   class="form-control"   placeholder="Enter Delivery Boy Password" name="password" required >
								</div>
								
 	<div class="form-group">
									<label for="cname">Select A Area</label>
									<select name="area_id" class="form-control" required>
									    <option value="">Select A Area</option>
									    <?php
									    $sr = $con->query("select * from area_db");
									    while($r = $sr->fetch_assoc())
									    {
									    ?>
									    <option value="<?php echo $r['id'];?>"><?php echo $r['name'];?></option>
									    <?php } ?>
									</select>
								</div>
								
									<div class="form-group">
									<label for="cname">Delivery Boy  Address</label>
								<textarea style="resize: none;" class="form-control" name="raddress"></textarea>
								</div>
								
									<div class="form-group">
									<label for="cname">Status</label>
									<select name="status" class="form-control">
									    <option value="1">Active</option>
									    <option value="0">Deactive</option>
									</select>
								</div>


							

								
							</div>

							<div class="form-actions">
								
								<button type="submit" name="sub_cat" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-motorcycle"></i> Save  Delivery Boy
								</button>
							</div>
							
							<?php 
							if(isset($_POST['sub_cat'])){
							$cname = mysqli_real_escape_string($con,$_POST['cname']);
							$status = $_POST['status'];
							$dcharge = $_POST['dcharge'];
							$password = $_POST['password'];
							$email = $_POST['email'];
							$raddress = $_POST['raddress'];
							$area_id = $_POST['area_id'];
						$check_email = $con->query("select * from rider where email='".$email."'")->num_rows;
						$check_mobile = $con->query("select * from rider where mobile='".$dcharge."'")->num_rows;
						if($check_email != 0)
						{
							?>
							<script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.info('Email Address Already Used.');

   setTimeout(function()
	{
		window.location.href="add_rider.php";
	},1500);
	
  });
  </script>
							<?php 
						}
						else if($check_mobile != 0)
						{
							?>
						<script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.error('Mobile Number Already Used.');

   setTimeout(function()
	{
		window.location.href="add_rider.php";
	},1500);
	
  });
  </script>	
							<?php 
						}
						else 
						{
$con->query("insert into rider(`name`,`mobile`,`email`,`aid`,`status`,`address`,`password`)values('".$cname."','".$dcharge."','".$email."',".$area_id.",".$status.",'".$raddress."','".$password."')");
?>
						
							 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.info('Insert Delivery Boy Successfully!!!');

   setTimeout(function()
	{
		window.location.href="add_rider.php";
	},1500);
	
  });
  </script>
  <?php 
							}
							}
							?>
						</form>
					</div>
				</div>
			</div>
		</div>

		
	</div>
	


 


          </div>
        </div>

        

      </div>
    </div>
    
   <?php 
  require 'include/js.php';
  ?>
    

  </body>


</html>