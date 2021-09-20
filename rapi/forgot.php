<?php 
require 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
if($data['email'] == '')
{
    $returnArr = array("ResponseCode"=>"401","Result"=>"false","ResponseMsg"=>"Something Went Wrong!");
}
else
{
    
    $search = $con->query("select * from rider where mobile='".$data['email']."'");
    if($search->num_rows != 0)
    {
        
 $returnArr = array("ResponseCode"=>"200","Result"=>"true");
    }
    else
  {
      $returnArr = array("ResponseCode"=>"401","Result"=>"false");
  }
}
echo json_encode($returnArr);
?>