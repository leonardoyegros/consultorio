<?php 
    // echo $this->Html->link('',array('controller'=>'sales', 'action'=>'add'), array('topbar'=>true, 'icon'=>'plus', 'title'=>__('Add New', true)));
    echo $this->Html->link('',array('controller'=>'sales', 'action'=>'index'), array('topbar'=>true,  'icon'=>'list', 'title'=>__("List", true)));
?>
<a href="http://www.getsiso.com/crear-venta/" topbar="1" class="btn btn-default pull-left help" data-toggle="tooltip" data-placement="bottom" data-original-title="" title="<?php echo __("Help", true) ?>"><span class="glyphicon glyphicon-question-sign"></span></a>
