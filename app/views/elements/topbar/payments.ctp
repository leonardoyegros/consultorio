<?php 
    echo $this->Html->link('',array('controller'=>'payments', 'action'=>'add'), array('topbar'=>true, 'icon'=>'plus', 'title'=>__('Add New', true)));
?>
<a href="#" topbar="1" icon="search" class="btn btn-default pull-left" data-toggle="tooltip" data-placement="bottom" data-original-title="" title=""><span class="glyphicon glyphicon-search"></span></a>
<a href="#" topbar="1" class="btn btn-default pull-left help" data-toggle="tooltip" data-placement="bottom" data-original-title="" title=""><span class="glyphicon glyphicon-question-sign"></span></a>
<a href="http://www.getsiso.com/listar-pagos/" topbar="1" class="btn btn-default pull-left help" data-toggle="tooltip" data-placement="bottom" data-original-title="" title="<?php echo __("Help", true) ?>"><span class="glyphicon glyphicon-question-sign"></span></a>