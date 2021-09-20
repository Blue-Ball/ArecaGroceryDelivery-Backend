<?php 
require 'include/front_header.php';
?>
  <body data-col="1-column" class=" 1-column  blank-page blank-page">
      <div class="layer"></div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper nav-collapsed menu-collapsed">
      <div class="main-panel">
        <div class="main-content">
          <div class="content-wrapper"><!--Login Page Starts-->
		  
<section id="login">
    <div class="container-fluid">
        <div class="row full-height-vh">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="card gradient-purple-bliss text-center width-400">
                    <div class="card-img overlap">
                        <img alt="element 06" class="mb-1" src="<?php echo $fset['logo'];?>" width="100">
                    </div>
                    <div class="card-body">
					<section id="getmsg"></section>
                        <div class="card-block">
                            <h2 class="black font-weight-normal">Verify Code</h2>
                            <form method="post">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="inputEmail" id="inputEmail" placeholder="Envato Purchase Code " required >
                                    </div>
                                </div>

                               
								
								

                               

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button  id="sub_log" class="btn btn-pink btn-block btn-dark">Activate</button>
                                       
                                    </div> 
                                </div>
                            </form>
                        </div>
                       
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
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    
   <?php 
   require 'include/js.php';
   ?>
   
  </body>


</html> 