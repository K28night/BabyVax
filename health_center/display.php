<!-- <?php require('../config/autoload.php'); ?> -->

<?php
$pid=$_GET['hid'];
$dao=new DataAccess();

?>


    
    <div class="container_gray_bg" id="home_feat_1">
    <div class="container">
    <h1>Appointment Report</h1>
    	<div class="row">
            <div class="col-md-10">
                <table  border="1" class="table" style="margin-top:60px;align-items:center">
                    <tr>
                        
                      
                        <th>Appointment Id</th>
                        <th>Parent Name</th>
                        <th>Child Name</th>
                        <th>Health Center Name</th>
                        <th>vaccine Name</th>
                        <th>Apoointment Date</th>
                        <th>Time solts</th>
                        <th>Appointment Status</th>
                    </tr>
<?php
    
    $actions=array(
    // 'edit'=>array('label'=>'Edit','link'=>'editcenters.php','params'=>array('id'=>'hid'),
    // 'attributes'=>array('class'=>'btn btn-success')),
    
    // 'delete'=>array('label'=>'Delete','link'=>'editstudentsimage.php','params'=>array('id'=>'hid'),
    // 'attributes'=>array('class'=>'btn btn-success'))
    
    );

    $config=array(
      
        
    );

   
   $join=array(
       
    );  
$fields=array('id','p_name','b_name','c_name','v_name','date','time_slot','status');

    $users=$dao->selectAsTable($fields,'appointments',"c_id='$pid'",$join,$actions,$config);
    
    echo $users;
                    
                    
                   
    
?>
             
                </table>
            </div>    

            
        </div><!-- End row -->
    </div><!-- End container -->
    </div><!-- End container_gray_bg -->
    
    
