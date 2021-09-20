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
                    <h4 class="card-title">Coupon List</h4>
                </div>
                <div class="card-body collapse show">
                    <div class="card-block card-dashboard">
                       
                        <table class="table table-striped table-bordered dom-jQuery-events">
                            <thead>
                                <tr>
								 <th>Sr No.</th>
                                    <th>Coupon Value</th>
                                    <th>Coupon Image</th>
									
									   <th>Coupon Discount?</th>
									  <th>Coupon Expiry Date</th>
									  <th>Coupon Order Min Value</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $sel = $con->query("select * from tbl_coupon");
                                $i=0;
                                while($row = $sel->fetch_assoc())
                                {
                                    $i= $i + 1;
                                ?>
                                <tr>
                                    
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row['c_title'];?></td>
                                    <td><img class="media-object round-media" src="<?php echo $row['c_img'];?>" alt="Generic placeholder image" style="height: 75px;"></td>
                                   
									<td><?php echo $row['c_value'];?></td>
									<td><?php echo $row['cdate'];?></td>
									<td><?php echo $row['min_amt'];?></td>
									<td>
									<a class="primary"  href="coupon.php?edit=<?php echo $row['id'];?>" data-original-title="" title="">
                                            <i class="ft-edit font-medium-3"></i>
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




          </div>
        </div>

      

      </div>
    </div>
    
    <?php 
  require 'include/js.php';
  ?>
    
  </body>


</html>