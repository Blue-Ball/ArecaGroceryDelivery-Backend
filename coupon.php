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
$sels = $con->query("select * from tbl_coupon where id=".$_GET['edit']."");
$sels = $sels->fetch_assoc();
?>
<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Edit Coupon</h4>
					
				</div>
				<div class="card-body">
					<div class="px-3">
						<form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">
								

								

								<div class="row">
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Image</label>
									<input type="file" name="f_up" class="form-control-file" id="projectinput8" >
									<br>
									<img src="<?php echo $sels['c_img'];?>" width="100" height="100"/>
								</div>
								</div>
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Expiry Date</label>
									<input type="date" name="cdate" value="<?php echo $sels['cdate'];?>" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
								
									<label for="cname">Coupon Code </label>
									<div class="row">
								<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
									<input type="text" id="ccode" value="<?php echo $sels['c_title'];?>" class="form-control" onkeypress="return isNumberKey(event)" 
    maxlength="8" name="ccode" oninput="this.value = this.value.toUpperCase()" required >
									</div>
									
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
									<button id="gen_code" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i></button>
									</div>
									</div>
								</div>
								</div>
								
								
                             
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon title </label>
									<input type="text"  class="form-control" value="<?php echo $sels['ctitle'];?>"  name="ctitle" required >
								</div>
							</div>
							

  

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Status </label>
									<select name="cstatus" class="form-control" required>
									<option value="">Select Coupon Status</option>
									<option value="1" <?php if($sels['status'] == 1){echo 'selected';}?>>Publish</option>
									<option value="0" <?php if($sels['status'] == 0){echo 'selected';}?>>Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Min Order Amount</label>
									<input type="number" id="cname" value="<?php echo $sels['min_amt'];?>" class="form-control"  name="minamt" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
								</div>
								
							
 <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Value </label>
									<input type="number" id="cname" class="form-control"  value="<?php echo $sels['c_value'];?>" name="cvalue" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
							</div>

<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Description </label>
									<textarea class="form-control" rows="5" name="cdesc" style="resize: none;"><?php echo $sels['c_desc'];?></textarea>
								</div>
							</div>							
								
							</div>

								
							</div>

							<div class="form-actions">
								
								<button type="submit" name="up_cat" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Save
								</button>
							</div>
							
							<?php 
							if(isset($_POST['up_cat'])){
							$ccode = mysqli_real_escape_string($con,$_POST['ccode']);
							$cdate = $_POST['cdate'];
							$minamt = $_POST['minamt'];
							$cstatus = $_POST['cstatus'];
							$cvalue = $_POST['cvalue'];
							$cdesc = $_POST['cdesc'];
							$ctitle = mysqli_real_escape_string($con,$_POST['ctitle']);
							
							
							if(!empty($_FILES["f_up"]["name"]))
							{
							

        $fileName = $_FILES['f_up']['tmp_name'];
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "coupon/";
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
$con->query("update tbl_coupon set c_title='".$ccode."',c_img='".$url."',min_amt=".$minamt.",ctitle='".$ctitle."',cdate='".$cdate."',c_value=".$cvalue.",status=".$cstatus.",c_desc='".$cdesc."' where id=".$_GET['edit']."");
 
}
else 
{
    $con->query("update tbl_coupon set c_title='".$ccode."',ctitle='".$ctitle."',min_amt=".$minamt.",cdate='".$cdate."',c_value=".$cvalue.",status=".$cstatus.",c_desc='".$cdesc."' where id=".$_GET['edit']."");
}
?>
						
							 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.info('Coupon Update Successfully!!');
	setTimeout(function()
	{
		window.location.href="couponlist.php";
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
<?php } else { ?>
<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Add Coupon</h4>
					
				</div>
				<div class="card-body">
					<div class="px-3">
						<form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body">
								

								

								

								<div class="row">
<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Image</label>
									<input type="file" name="f_up" class="form-control-file" id="projectinput8" required>
								</div>
								</div>
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Expiry Date</label>
									<input type="date" name="cdate" class="form-control" id="projectinput8" required>
								</div>
								</div>
								
								
								
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
								<div class="form-group">
								
									<label for="cname">Coupon Code </label>
									<div class="row">
								<div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
									<input type="text" id="ccode" class="form-control" onkeypress="return isNumberKey(event)" 
    maxlength="8" name="ccode" required  oninput="this.value = this.value.toUpperCase()">
									</div>
									
								<div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
									<button id="gen_code" class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i></button>
									</div>
									</div>
								</div>
								</div>
								
								
                             
							
							 <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon title </label>
									<input type="text"  class="form-control"  name="ctitle" required >
								</div>
							</div>

  	

<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Status </label>
									<select name="cstatus" class="form-control" required>
									<option value="">Select Coupon Status</option>
									<option value="1">Publish</option>
									<option value="0">Unpublish</option>
									
									</select>
								</div>
							</div>	
							
							<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">

								<div class="form-group">
									<label>Coupon Min Order Amount</label>
									<input type="number" id="cname"  class="form-control"  name="minamt" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
								</div>
								
 <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Value</label>
									<input type="number" id="cname" class="form-control"  name="cvalue" step="1"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57" required >
								</div>
							</div>

<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Coupon Description </label>
									<textarea class="form-control" rows="5" name="cdesc" style="resize: none;"></textarea>
								</div>
							</div>							
								
							</div>

							<div class="form-actions">
								
								<button type="submit" name="sub_cat" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-gift"></i> Save Coupon
								</button>
							</div>
							
							<?php 
							if(isset($_POST['sub_cat'])){
							$ccode = mysqli_real_escape_string($con,$_POST['ccode']);
							$cdate = $_POST['cdate'];
							$minamt = $_POST['minamt'];
							$ctitle = mysqli_real_escape_string($con,$_POST['ctitle']);
							$cstatus = $_POST['cstatus'];
							$cvalue = $_POST['cvalue'];
							$cdesc = $_POST['cdesc'];
							
							
        $fileName = $_FILES['f_up']['tmp_name'];
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "coupon/";
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
$con->query("insert into tbl_coupon(`c_img`,`c_desc`,`c_value`,`c_title`,`status`,`cdate`,`ctitle`,`min_amt`)values('".$url."','".$cdesc."','".$cvalue."','".$ccode."',".$cstatus.",'".$cdate."','".$ctitle."',".$minamt.")");
?>
						
							 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s
    
    toastr.info('Insert Coupon Code Successfully!!!');
    
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
	<?php } ?>





          </div>
        </div>

        

      </div>
    </div>
    
    <?php 
  require 'include/js.php';
  ?>
    
	 <script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
 <script>
 function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

 CKEDITOR.editorConfig = function (config) {
    config.language = 'es';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.toolbarCanCollapse = true;

};
CKEDITOR.replace('cdesc');

$(document).ready(function()
{
	$(document).on('click','#gen_code',function()
	{
		$('#ccode').val(makeid(8));
		return false;
	});
	
});

</script>
 
  </body>


</html>