<?php 
    echo $this->Html->link('',array('controller'=>'sales', 'action'=>'add'), array('topbar'=>true, 'icon'=>'plus', 'title'=>__('Add New', true)));
    // echo $this->Html->link('',array('controller'=>'sales', 'action'=>'index'), array('topbar'=>true,  'icon'=>'list'));
?>
<a href="#" topbar="1" icon="search" class="btn btn-default pull-left" data-toggle="tooltip" data-placement="bottom" data-original-title="" title=""><span class="glyphicon glyphicon-search"></span></a>
<a href="#" topbar="1" class="btn btn-default pull-left delete-multiple-index" data-toggle="tooltip" data-placement="bottom" data-original-title="" title="<?php echo __("Remove Selected", true) ?>"><span class="glyphicon glyphicon-remove"></span></a>
<a href="http://www.getsiso.com/listar-ventas/" topbar="1" class="btn btn-default pull-left help" data-toggle="tooltip" data-placement="bottom" data-original-title="" title="<?php echo __("Help", true) ?>"><span class="glyphicon glyphicon-question-sign"></span></a>