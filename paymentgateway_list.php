<?php 
  require 'include/header.php';
  ?>
<?php 
function resizeImage($resourceType,$image_width,$image_height,$resizeWidth,$resizeHeight) {
    // $resizeWidth = 100;
    // $resizeHeight = 100;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    $background = imagecolorallocate($imageLayer , 0, 0, 0);
        // removing the black from the placeholder
        imagecolortransparent($imageLayer, $background);

        // turning off alpha blending (to ensure alpha channel information
        // is preserved, rather than removed (blending with the rest of the
        // image in the form of black))
        imagealphablending($imageLayer, false);

        // turning on alpha channel information saving (to ensure the full range
        // of transparency is preserved)
        imagesavealpha($imageLayer, true);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}
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
<?php if(isset($_GET['edit'])) {
$sels = $con->query("select * from payment_list where id=".$_GET['edit']."");
if($sels->num_rows != 0)
{
$sels = $sels->fetch_assoc();

?>
<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Edit Payment Gateway</h4>
					
				</div>
				<div class="card-body">
					<div class="px-3">
						<form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">
								

								

								

								<div class="form-group">
									<label>Payment Gateway Image</label>
									<input type="file" name="f_up" class="form-control-file" id="projectinput8">
								</div>
								
								<div class="form-group">
								    <img src="<?php echo $sels['img'];?>" class="media-object round-media"  style="height: 75px;"/>
								    </div>

<div class="form-group">
									<label>Payment Gateway Creditinals Title</label>
									<input type="text" name="ctitle" class="form-control" value="<?php echo $sels['cred_title'];?>" id="ctitle"  required>
								</div>
								
								<div class="form-group">
									<label>Payment Gateway Creditinals Value</label>
									<input type="text" name="cvalue" class="form-control" value="<?php echo $sels['cred_value'];?>" id="cvalue" required>
								</div>
								
								<div class="form-group">
									<label>Payment Gateway Status</label>
									<select class="form-control" name="status" required>
									<option>select a status</option>
									<option value="1" <?php if($sels['status'] == 1){echo 'selected';}?>>Publish</option>
									<option value="0" <?php if($sels['status'] == 0){echo 'selected';}?> >Unpublish</option>
									</select>
								</div>
								
								<div class="form-group">
									<label>Show On Wallet Add Money?</label>
									<select class="form-control" name="w_show" required>
									<option>select a status</option>
									<option value="1" <?php if($sels['w_show'] == 1){echo 'selected';}?>>Publish</option>
									<option value="0" <?php if($sels['w_show'] == 0){echo 'selected';}?> >Unpublish</option>
									</select>
								</div>
								
							</div>

							<div class="form-actions">
								
								<button type="submit" name="up_cat" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Update Payment Gateway
								</button>
							</div>
							
							<?php 
							if(isset($_POST['up_cat'])){
							
							$ctitle = mysqli_real_escape_string($con,$_POST['ctitle']);
							$cvalue = mysqli_real_escape_string($con,$_POST['cvalue']);
							$status = $_POST['status'];
							$w_show = $_POST['w_show'];
							if(!empty($_FILES["f_up"]["name"]))
							{
							

        $fileName = $_FILES['f_up']['tmp_name'];
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "payment/";
        $fileExt = pathinfo($_FILES['f_up']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
		$new_width = $sourceImageWidth;
        $new_height = $sourceImageHeight;
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                imagejpeg($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;

            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                imagegif($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                break;

            case IMAGETYPE_PNG:
                
                $resourceType = imagecreatefrompng($fileName); 
                $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight,$new_width,$new_height);
                imagepng($imageLayer,$uploadPath."thump_".$resizeFileName.'.'. $fileExt);
                
                break;

            default:
                $imageProcess = 0;
                break;
        }
        
       $url = $uploadPath."thump_".$resizeFileName.".". $fileExt;
$con->query("update payment_list set img='".$url."',status=".$status.",cred_title='".$ctitle."',cred_value='".$cvalue."',w_show=".$w_show." where id=".$_GET['edit']."");
 
}
else 
{
    $con->query("update payment_list set status=".$status.",cred_title='".$ctitle."',cred_value='".$cvalue."',w_show=".$w_show." where id=".$_GET['edit']."");
}
?>
						
							<script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.info('Payment Gateway Update Successfully!!');
	setTimeout(function()
	{
		window.location.href="payment_list.php";
	},1500);
    
  });
  </script>
  <?php 
							}
							?>
						</form>
					</div>
				</div>
			</div>
		</div>

		
	</div>
<?php } 
else 
{
	?>
	<script type="text/javascript">
  
		window.location.href="payment_list.php";
	
  </script>
	<?php 
}
}else { ?>
<script type="text/javascript">
  
		window.location.href="payment_list.php";
	
  </script>
	<?php } ?>





          </div>
        </div>

        

      </div>
    </div>
    
    <?php 
  require 'include/js.php';
  ?>
    
 <script>
$('#ctitle').tagsinput('items');
$('#cvalue').tagsinput('items');
</script>
  </body>


</html>