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

    
    
    <div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Update Dynamic Section</h4>
					
				</div>
				<div class="card-body">
					<div class="px-3">
					    <?php 
					    if(isset($_GET['eid']))
					    {
					        $data = $con->query("select * from home where id=".$_GET['eid']."")->fetch_assoc();
					    ?>
					    <form class="form" action="#" method="post">
							<div class="form-body">
								

								

								
								<div class="form-group">
									<label for="cname">Title</label>
									<input type="text" id="pimg" class="form-control"  value="<?php echo $data['title'];?>" placeholder="Enter Title" name="pimg" required>
								</div>
								
                                		<div class="form-group">
											<label for="projectinput6">Select Category</label>
											<select id="cat_change" name="catname" class="form-control" required>
												<option value="" selected="">Select Category</option>
												<?php 
												$sk = mysqli_query($con,"select * from category");
												while($h = mysqli_fetch_assoc($sk))
												{
												?>
												<option value="<?php echo $h['id'];?>" <?php if($h['id'] == $data['cid']){echo 'selected';}?>><?php echo $h['catname'];?></option>
												<?php } ?>
												
											</select>
										</div>
										
										<div class="form-group">
											<label for="projectinput6">Select SubCategory</label>
											<select id="sub_list" name="subcatname" class="form-control" required>
												<option value="" selected="">Select Category</option>
												<?php 
												$sk = mysqli_query($con,"select * from subcategory where cat_id=".$data['cid']."");
												while($h = mysqli_fetch_assoc($sk))
												{
												?>
												<option value="<?php echo $h['id'];?>" <?php if($h['id'] == $data['sid']){echo 'selected';}?>><?php echo $h['name'];?></option>
												<?php } ?>
												
												
											</select>
										</div>
										
										<div class="form-group">
											<label for="projectinput6">Status?</label>
											<select id="sub_list" name="status" class="form-control" required>
												<option value="" selected="">Select Status</option>
												<option value="1" <?php if($data['status'] == 1){echo 'selected';}?>>Yes</option>
												<option value="0" <?php if($data['status'] == 0){echo 'selected';}?> >No</option>
												
												
											</select>
										</div>

								
								
							</div>

							<div class="form-actions">
								
								<button type="submit" name="edit_product" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Update Section
								</button>
							</div>
						</form>
						
						
					    <?php 
					    if(isset($_POST['edit_product']))
					    {
					        
					   $title = mysqli_real_escape_string($con,$_POST['pimg']);
$sid = $_POST['subcatname'];
$cid = $_POST['catname'];
$status = $_POST['status'];
$id = $_GET['eid'];
		$con->query("update home set title='".$title."',cid=".$cid.",sid=".$sid.",status=".$status." where id=".$id."");
	
		?>
		 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s
    toastr.info('Updated select Section Successfully!!!');
   setTimeout(function(){ window.location.href="home_section_list.php"; }, 1500);

  });
  </script>
		<?php 
	
		}
		?>
		<?php 
					    }
					    else 
					    {
					    ?>
						<form class="form" action="#" method="post">
							<div class="form-body">
								

								

								
								<div class="form-group">
									<label for="cname">Title</label>
									<input type="text" id="pimg" class="form-control"  placeholder="Enter Title" name="pimg" required>
								</div>
								
                                		<div class="form-group">
											<label for="projectinput6">Select Category</label>
											<select id="cat_change" name="catname" class="form-control" required>
												<option value="" selected="">Select Category</option>
												<?php 
												$sk = mysqli_query($con,"select * from category");
												while($h = mysqli_fetch_assoc($sk))
												{
												?>
												<option value="<?php echo $h['id'];?>"><?php echo $h['catname'];?></option>
												<?php } ?>
												
											</select>
										</div>
										
										<div class="form-group">
											<label for="projectinput6">Select SubCategory</label>
											<select id="sub_list" name="subcatname" class="form-control" required>
												<option value="" selected="">Select SubCategory</option>
												
												
											</select>
										</div>
										
										<div class="form-group">
											<label for="projectinput6">Status?</label>
											<select id="sub_list" name="status" class="form-control" required>
												<option value="" selected="">Select Status</option>
												<option value="1">Yes</option>
												<option value="0">No</option>
												
												
											</select>
										</div>

								
								
							</div>

							<div class="form-actions">
								
								<button type="submit" name="sub_product" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Save Section
								</button>
							</div>
						</form>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

		<?php
		if(isset($_POST['sub_product']))
		{
$title = mysqli_real_escape_string($con,$_POST['pimg']);
$sid = $_POST['subcatname'];
$cid = $_POST['catname'];
$status = $_POST['status'];
		$con->query("insert into home(`title`,`cid`,`sid`,`status`)values('".$title."',".$cid.",".$sid.",".$status.")");
	
		?>
		 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s
    toastr.info('Insert New Section Successfully!!!');
   setTimeout(function(){ window.location.href="home_section.php"; }, 1500);

  });
  </script>
		<?php 
	
		}
		?>
	</div>







          </div>
        </div>

         

      </div>
    </div>
    
  <?php 
  require 'include/js.php';
  ?>
   
    <script>
   $(document).on('change','#cat_change',function()
	{
		var value = $(this).val();
		
		$.ajax({
			type:'post',
			url:'getsub.php',
			data:
			{
				catid:value
			},
			success:function(data)
			{
				$('#sub_list').html(data);
			}
		});
	});
	</script>
    
  </body>


</html>