<?php require('../config/autoload.php'); ?>

<?php
$dao=new DataAccess();
?>
<?php include('header.php'); ?>

    
    <div class="container_gray_bg" id="home_feat_1">
    <div class="container">
    	<div class="row">
            <div class="col-md-10">
                <table  border="1" class="table" style="margin-top:100px;">
                    <tr>
                        
                        <th>SId</th>
                        <th>Sname</th>
                        <th>SImage</th>
                        <th>EDIT/DELETE</th>
                    </tr>
<?php
    
    $actions=array(
    'edit'=>array('label'=>'Edit','link'=>'editstudentsimage.php','params'=>array('id'=>'sid'),
    'attributes'=>array('class'=>'btn btn-success')),
    
    'delete'=>array('label'=>'Delete','link'=>'editstudentsimage.php','params'=>array('id'=>'sid'),
    'attributes'=>array('class'=>'btn btn-success'))
    
    );

    $config=array(
        'srno'=>true,//order aayi varaan id 1 2 3 ...
        'hiddenfields'=>array('sid'),
'actions_td'=>false,
         'images'=>array(
                        'field'=>'simage',
                        'path'=>'../uploads/',
                        'attributes'=>array('style'=>'width:100px;'))
        
    );

   
   $join=array(
    //     'dept as dt'=>array('dt.dno=s.dno','join'),

	// 'batch as bt'=>array('bt.batchid=s.batchid','join')
	
    );  
$fields=array('sid','sname','simage');

    $users=$dao->selectAsTable($fields,'student05 as s',1,$join,$actions,$config);
    
    echo $users;
                    
                    
                   
    
?>
             
                </table>
            </div>    

            
            
            
            
        </div><!-- End row -->
    </div><!-- End container -->
    </div><!-- End container_gray_bg -->
    
    
