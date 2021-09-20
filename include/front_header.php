<?php 
session_start();
require 'dbconfig.php';
?>
<?php
if($_SERVER['REQUEST_URI'] !='/activate.php')
{
    if(empty($_SESSION['username']))
    {

    }
    else 
    {
        ?>
        <script>
            window.location.href="dashboard.php";
        </script>
        <?php 
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="loading">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php
    if($_SERVER['REQUEST_URI'] !='/activate.php')   
    {   
      ?>
      <title>Login Page - <?php echo $fset['title'];?></title>
  <?php } else {?>
   <title>Verify Page - <?php echo $fset['title'];?></title>
<?php } ?>
<link rel="shortcut icon"  href="<?php echo $fset['favicon'];?>">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="app-assets/fonts/feather/style.min.css">
<link rel="stylesheet" type="text/css" href="app-assets/fonts/simple-line-icons/style.css">
<link rel="stylesheet" type="text/css" href="app-assets/fonts/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/perfect-scrollbar.min.css">
<link rel="stylesheet" type="text/css" href="app-assets/vendors/css/prism.min.css">

<link rel="stylesheet" type="text/css" href="app-assets/css/app.css">

</head>