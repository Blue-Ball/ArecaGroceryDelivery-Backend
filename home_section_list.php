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
                    <h4 class="card-title">Section List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                       
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Sr No.</th>
                                   
                                    <th>Section Title</th>
                                   <th>Section Category</th>
                                   <th>Section SubCategory</th>
                                   <th>Section Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $jj = $con->query("select * from home");
                                $i=0;
                                while($rkl = $jj->fetch_assoc())
                                {
                                    $i = $i + 1;
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                    
                                    <td><?php echo $rkl['title'];?></td>
                                    <td><?php $ct = $con->query("select * from category where id=".$rkl['cid']."")->fetch_assoc();  echo $ct['catname'];?></td>
                                    <td><?php $ct = $con->query("select * from subcategory where id=".$rkl['sid']."")->fetch_assoc();  echo $ct['name'];?></td>
                                     <td><?php if($rkl['status'] == 1){echo 'Publish';}else {echo 'Unublish';}?></td>
                                    <td>
									
											<a class="info" data-original-title=""  href="home_section.php?eid=<?php echo $rkl['id'];?>" title="">
                                            <i class="ft-edit font-medium-3"></i>
                                        </a>
                                        
									<a class="danger" data-original-title=""  href="?dele=<?php echo $rkl['id'];?>" title="">
                                            <i class="ft-trash font-medium-3"></i>
                                        </a>
                                        
                                        
										
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
if(isset($_GET['dele']))
{
    $con->query("delete from home  where id=".$_GET['dele']."");
?>
	 <script type="text/javascript">
  $(document).ready(function() {
    toastr.options.timeOut = 4500; // 1.5s

    toastr.error('selected section deleted successfully.');
   setTimeout(function()
	{
		window.location.href="home_section_list.php";
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