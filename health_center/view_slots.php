<!-- <?php require('../config/autoload.php'); ?> -->

<?php
$dao=new DataAccess();
$hid=$_GET['hid'];
?>


    
    <div class="container_gray_bg" id="home_feat_1">
    <div class="container">
    <h1>Health Centers time slots</h1>
    	<div class="row">
            <div class="col-md-10">
                <table  border="1" class="table" style="margin-top:100px;align-items:center">
                    <tr>
                        
                      
                        <th>vaccine Name</th>
                        <th>date</th>
                        <th>Time solts</th>
                        <th>Time solts</th>
                        <th>Time solts</th>
                    </tr>
<?php
    
    $actions=array(
    // 'edit'=>array('label'=>'Edit','link'=>'editcenters.php','params'=>array('id'=>'hid'),
    // 'attributes'=>array('class'=>'btn btn-success')),
    
    // 'delete'=>array('label'=>'Delete','link'=>'editstudentsimage.php','params'=>array('id'=>'hid'),
    // 'attributes'=>array('class'=>'btn btn-success'))
    
    );

    $config=array(
        // 'srno'=>true,//order aayi varaan id 1 2 3 ...
//         'hiddenfields'=>array('hid'),
// 'actions_td'=>false,
//          'images'=>array(
//                         'field'=>'img',
//                         'path'=>'../uploads/',
//                         'attributes'=>array('style'=>'width:100px;'))
        
    );

   
   $join=array(
        'b_vaccines as v'=>array('v.vid=s.v_id','join'),

	// 'batch as bt'=>array('bt.batchid=s.batchid','join')
	
    );  
$fields=array('v.name','s.date','s.time_slot_1','s.time_slot_2','s.time_slot_3');

    $users=$dao->selectAsTable($fields,'slots1 as s',"c_id='$hid'",$join,$actions,$config);
    
    echo $users;
                    
                    
                   
    
?>
             
                </table>
            </div>    

            
        </div><!-- End row -->
    </div><!-- End container -->
    </div><!-- End container_gray_bg -->
    
    
