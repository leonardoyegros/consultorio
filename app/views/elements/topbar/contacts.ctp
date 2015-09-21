<?php 
    echo $this->Html->link('',array('controller'=>'contacts', 'action'=>'add'), array('topbar'=>true, 'icon'=>'plus', 'title'=>__('Add New', true)));
    // echo $this->Html->link('',array('controller'=>'contacts', 'action'=>'index', '?'=>array('export'=>true)), array('topbar'=>true, 'icon'=>'save-file', 'title'=>__('Export', true)));
    // echo $this->Html->link('',array('controller'=>'contacts', 'action'=>'index', '?'=>array('print'=>true)), array('topbar'=>true, 'icon'=>'print', 'title'=>__('Print', true)));
    // echo $this->Html->link('',array('controller'=>'contacts', 'action'=>'add'), array('topbar'=>true,  'icon'=>'question-sign'));
?>
<a href="http://www.getsiso.com/listar-contactos/" topbar="1" class="btn btn-default pull-left help" data-toggle="tooltip" data-placement="bottom" data-original-title="" title="<?php echo __("Help", true) ?>"><span class="glyphicon glyphicon-question-sign"></span></a>

