<?php
$this -> start('main-content');
?>

<?php 
    echo $this -> Form -> create('Role', array('controller' => 'roles', 'action' => 'edit', 'data-validate' => 'parsley', 'role' => 'form'));
    echo $this -> Form -> input('id', array('div' => false,'type'=>'hidden','default'=>$selected['Role']['id'], 'label' => false, 'class' => 'form-control', 'required' => 'required', 'id' => 'id')); 
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Role</h1>
    </div>    <!-- /.col-lg-12 -->
</div> <!-- /.row -->

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                Edit

                <div class="pull-right">
                    <?php
                      echo $this->Html->link($this->Html->tag('i', '',array('class' => 'fa fa-arrow-left')),array('controller'=>'roles','action'=>'index'),array('class'=>'btn btn-primary btn-xs ', 'escape' => false));
                    ?>
                </div>
            </div>   <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="form-group">
                            <label>Item Type</label>
                            <?php
                            echo $this -> Form -> input('item_type_id', array('options' => $item_types,'default'=>$selected['Role']['item_type_id'], 'class' => 'form-control m-b', 'label' => false, 'div' => false));
                            ?>
                        </div> 

                        <div class="form-group">
                            <label>Name</label>
                            <?php
                            echo $this -> Form -> input('name', array('div' => false,'default'=>$selected['Role']['name'], 'label' => false, 'title' => 'Name', 'class' => 'form-control', 'required' => 'required', 'id' => 'name'));
                            ?>
                        </div>                       

                        <?php   echo $this -> Form -> input('Save', array('type' => 'submit', 'div' => false, 'label' => false, 'title' => 'Save', 'class' => 'btn btn-s-md btn-warning', 'id' => 'save-submit'));  ?> 

                        <?php echo $this->Form->end(); ?>       

                    </div> <!-- /.col-lg-6 (nested) -->                

                </div>  <!-- /.row (nested) -->
            </div>   <!-- /.panel-body -->
        </div>     <!-- /.panel -->
    </div> <!-- /.col-lg-6 -->
</div> <!-- /.row -->
<?php
$this -> end('main-content');
?>