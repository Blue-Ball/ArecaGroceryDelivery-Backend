<?php 
  require 'include/header.php';
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
 
<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">Update Setting</h4>
					
				</div>
				<div class="card-body">
					<div class="px-3">
						<form class="form" method="post" enctype="multipart/form-data">
							<div class="form-body row">
								

								<?php 
								$getkey = $con->query("select * from setting")->fetch_assoc();
								?>
                               <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">User Onesignal App Id</label>
									<input type="text" id="cname" class="form-control"  name="oid" value="<?php echo $getkey['one_key']; ?>" required >
								</div>
								</div>
								 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <div class="form-group">
									<label for="cname">User Onesignal Rest API KEY</label>
									<input type="text" id="cname" class="form-control"  name="ohash" value="<?php echo $getkey['one_hash']; ?>" required >
								</div>
								</div>
								 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Rider Onesignal App Id</label>
									<input type="text" id="cname" class="form-control"  name="rid" value="<?php echo $getkey['r_key']; ?>"  >
								</div>
								</div>
								 <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                <div class="form-group">
									<label for="cname">Rider Onesignal Rest API KEY</label>
									<input type="text" id="cname" class="form-control"  name="rhash" value="<?php echo $getkey['r_hash']; ?>"  >
								</div>
								</div>
									
								
								
								 <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
									<div class="form-group">
									<label for="cname">Currency</label>
									<input type="text" id="cname" class="form-control"  name="currency" value="<?php echo $getkey['currency'];?>" required >
								</div>
								</div>
								
								 <div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<?php 
								$tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
								$limit =  count($tzlist);
								?>
								<div class="form-group">
									<label for="cname">Select Timezone</label>
									<select name="stime" class="form-control" required>
									<option value="">Select Timezone</option>
									<?php 
									for($k=0;$k<$limit;$k++)
									{
									?>
									<option <?php echo $tzlist[$k];?> <?php if($tzlist[$k] == $getkey['timezone']) {echo 'selected';}?>><?php echo $tzlist[$k];?></option>
									<?php } ?>
									</select>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Order Min Value</label>
									<input type="text" id="cname" class="form-control"  name="omin" value="<?php echo $getkey['o_min'];?>" required >
								</div>
								</div>
								
								
								
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">TAX %</label>
									<input type="text" id="cname" class="form-control"  name="tax" value="<?php echo $getkey['tax'];?>" required >
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Website Title</label>
									<input type="text" id="cname" class="form-control"  name="title" value="<?php echo $getkey['title'];?>" required >
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">App Under Maintaince?</label>
									<select name="maintaince" class="form-control">
<option value="0" <?php if($getkey['maintaince'] == 0){echo 'selected';}?>>No</option>
<option value="1" <?php if($getkey['maintaince'] == 1){echo 'selected';}?>>Yes</option>
									</select>
								</div>
								</div>
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Website Logo</label>
									<input type="file"  class="form-control"  name="logo" >
									<br>
									<img src="<?php echo $getkey['logo'];?>" width="60" height="60"/>
								</div>
								</div>
								
								
								<div class="col-md-3 col-lg-3 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Website Favicon</label>
									<input type="file"  class="form-control"  name="favicon">
									<br>
									<img src="<?php echo $getkey['favicon'];?>" width="60" height="60"/>
								</div>
								</div>
								
								
								<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Privacy Policy</label>
									<textarea class="form-control" rows="5" name="p_data" style="resize: none;"><?php echo $getkey['privacy_policy'];?></textarea>
								</div>
								</div>
								
								<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">About Us</label>
									<textarea class="form-control" rows="5" name="a_data" style="resize: none;"><?php echo $getkey['about_us'];?></textarea>
								</div>
								</div>
								
								<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
								
								
									<label for="cname">Contact Us</label>
									<textarea class="form-control" rows="5" name="c_data" style="resize: none;"><?php echo $getkey['contact_us'];?></textarea>
								</div>
								</div>
								
								<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
								<div class="form-group">
								
								
									<label for="cname">Terms & Conditions</label>
									<textarea class="form-control" rows="5" name="terms" style="resize: none;"><?php echo $getkey['terms'];?></textarea>
								</div>
								</div>
								
<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Sign Up Credit</label>
									<input type="text" id="cname" class="form-control"  name="signupcredit" value="<?php echo $getkey['signupcredit'];?>" required >
								</div>
								</div>
								
								<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
								<div class="form-group">
									<label for="cname">Refer Credit</label>
									<input type="text" id="cname" class="form-control"  name="refercredit" value="<?php echo $getkey['refercredit'];?>" required >
								</div>
								</div>

							

								
							</div>
	
							<div class="form-actions">
								
								<button type="submit" name="sub_cat" class="btn btn-raised btn-raised btn-primary">
									<i class="fa fa-check-square-o"></i> Update Setting
								</button>
							</div>
							
							<?php 
							if(isset($_POST['sub_cat'])){
							$oid = $_POST['oid'];
							$ohash = $_POST['ohash'];
							$rid = $_POST['rid'];
							$rhash = $_POST['rhash'];
							$title = mysqli_real_escape_string($con,$_POST['title']);
							$p_data = $_POST['p_data'];
							$a_data = $_POST['a_data'];
							$c_data = $_POST['c_data'];
							$omin = $_POST['omin'];
							$signupcredit = $_POST['signupcredit'];
							$refercredit = $_POST['refercredit'];
							$timezone = $_POST['stime'];
							$terms = $_POST['terms'];
							$maintaince = $_POST['maintaince'];
							$currency = mysqli_real_escape_string($con,$_POST['currency']);
							$data = $con->query("select * from setting")->fetch_assoc();
							if($_FILES["favicon"]["name"] == '')
							{
								$favicon = $data['favicon'];
							}
							else 
							{
								$fileName = $_FILES['favicon']['tmp_name'];
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "website/";
        $fileExt = pathinfo($_FILES['favicon']['name'], PATHINFO_EXTENSION);
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
        
        $favicon = $uploadPath."thump_".$resizeFileName.".". $fileExt; 
							}
							
							
							if($_FILES["logo"]["name"] == '')
							{
								$logo = $data['logo'];
							}
							else 
							{
								$fileName = $_FILES['logo']['tmp_name'];
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = time();
        $uploadPath = "website/";
        $fileExt = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
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
        
        $logo = $uploadPath."thump_".$resizeFileName.".". $fileExt; 
							}
							
							
							$tax = $_POST['tax'];
							
							
$con->query("update setting set one_key='".$oid."',one_hash='".$ohash."',r_key='".$rid."',favicon='".$favicon."',logo='".$logo."',title='".$title."',tax=".$tax.",r_hash='".$rhash."',currency='".$currency."',privacy_policy='".$p_data."',about_us='".$a_data."',contact_us='".$c_data."',terms='".$terms."',o_min=".$omin.",`timezone`='".$timezone."',maintaince=".$maintaince.",refercredit=".$refercredit.",signupcredit=".$signupcredit." where id=1");


?>
						
							<script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.success('Setting Change Successfully!!');
    setTimeout(function()
	{
		window.location.href="setting.php";
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
	





          </div>
        </div>

        

      </div>
    </div>
   
   <?php 
  require 'include/js.php';
  ?>
    <script src="https://cdn.ckeditor.com/4.5.1/standard/ckeditor.js"></script>
 <script>
 CKEDITOR.editorConfig = function (config) {
    config.language = 'es';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.toolbarCanCollapse = true;

};
CKEDITOR.replace('p_data');


 CKEDITOR.editorConfig = function (config) {
    config.language = 'es';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.toolbarCanCollapse = true;

};
CKEDITOR.replace('a_data');

CKEDITOR.editorConfig = function (config) {
    config.language = 'es';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.toolbarCanCollapse = true;

};
CKEDITOR.replace('c_data');

CKEDITOR.editorConfig = function (config) {
    config.language = 'es';
    config.uiColor = '#F7B42C';
    config.height = 300;
    config.toolbarCanCollapse = true;

};
CKEDITOR.replace('terms');

 
 </script>
  </body>


</html>