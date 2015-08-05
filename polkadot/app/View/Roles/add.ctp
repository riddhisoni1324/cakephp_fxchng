<?php
$this -> start('main-content');
?>

<?php echo $this -> Form -> create('Role', array('controller' => 'roles', 'action' => 'add', 'role' => 'form')); ?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Role</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                Add

                <div class="pull-right">
                    <?php
                      echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-arrow-left')),array('controller'=>'roles','action'=>'index'),array('class'=>'btn btn-primary btn-xs ', 'escape' => false));
                    ?>
                </div>
            </div> <!-- /.panel-heading -->

            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Item Type</label>
                            <?php
                                echo $this -> Form -> input('item_type_id', array('options' => $item_types, 'class' => 'form-control m-b', 'label' => false, 'div' => false,'required' => 'required'));
                            ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="form-group">
                            <label>Name</label>
                            <?php
                            echo $this -> Form -> input('name', array('div' => false, 'label' => false, 'title' => 'Name', 'class' => 'form-control', 'required' => 'required', 'id' => 'name'));
                            ?>
                        </div>                     
                    </div> <!-- /.col-lg-12 (nested) -->
                </div> <!-- /.row (nested) -->

                <?php   echo $this -> Form -> input('Add', array('type' => 'submit', 'div' => false, 'label' => false, 'title' => 'Add', 'class' => 'btn btn-s-md btn-success', 'id' => 'add_submit'));  ?>                            

                <?php echo $this->Form->end(); ?>
                
            </div>   <!-- /.panel-body -->

        </div> <!-- /.panel -->
    </div>  <!-- /.col-lg-6 -->
</div>  <!-- /.row -->
<?php
$this -> end('main-content');
?>