<?php 
    // echo $this->Html->link('',array('controller'=>'purchases', 'action'=>'add'), array('topbar'=>true, 'icon'=>'plus', 'title'=>__('Add New', true)));
?>
<?php 
    echo $this->Html->link('',array('controller'=>'purchases', 'action'=>'index'), array('topbar'=>true, 'icon'=>'list', 'title'=>__('List', true)));
?>
<a href="http://www.getsiso.com/crear-compra/" topbar="1" class="btn btn-default pull-left help" data-toggle="tooltip" data-placement="bottom" data-original-title="" title="<?php echo __("Help", true)?>"><span class="glyphicon glyphicon-question-sign"></span></a>