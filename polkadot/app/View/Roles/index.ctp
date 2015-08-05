<?php
$this -> start('main-content');

$this->Html->scriptStart(array('inline' => false));
?>

<?php 
  $this->Html->scriptEnd(); 
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Roles</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

          <div class="panel-heading">
            View
            <div class="pull-right">
            <?php
              echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-plus')),array('controller'=>'roles','action'=>'add'),array('class'=>'btn btn-success btn-xs ', 'escape' => false));
            ?>
            </div>
          </div>
      
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
          	              <tr>
                            <th>Name</th>
                            <th>Item Type</th>        
                            <th></th>
                            <th></th>
          	              </tr>
                        </thead>
                        <tbody>
	            	
            	            <?php foreach($roles as $role) 
            	            	{
            	            	?>
            		            
            		            	<tr>
            			                <td><?php echo $role['Role']['name']; ?></td>
                                  <td><?php echo $role['ItemType']['name']; ?></td>             							        
                                  <td><?php
                                      echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-pencil')),array('controller'=>'roles','action'=>'edit',$role['Role']['id']),array('class'=>'btn btn-warning btn-circle', 'escape' => false));
                                      ?>
                                  </td>
                                  <td><?php
                                      echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-times')),array('controller'=>'roles','action'=>'delete',$role['Role']['id']),array('class'=>'btn btn-danger btn-circle', 'escape' => false));
                                      ?>
                                  </td>
            		            
            	            	<?php
            					       }
            	            	?>
	            	
	            	        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            </div> <!-- /.panel-body --> 
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

</div>
<!-- /.row -->
<?php
$this -> end('main-content');
?>