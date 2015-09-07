<?php 
	echo $this->Html->link('',array('controller'=>'payments', 'action'=>'add'), array('topbar'=>true,  'icon'=>'plus'));
    echo $this->Html->link('',array('controller'=>'payments', 'action'=>'edit',$topbar->data['Payment']['id']), array('topbar'=>true, 'icon'=>'pencil', 'title'=>__('
    	Edit', true)));
    echo $this->Html->link('',array('controller'=>'payments', 'action'=>'delete',$topbar->data['Payment']['id']), array('topbar'=>true, 'icon'=>'remove', 'title'=>__('Delete', true)));
    // echo $this->Html->link('',array('controller'=>'payments', 'action'=>'index'), array('topbar'=>true,  'icon'=>'list'));	
?>
<a href="http://www.getsiso.com/listar-pagos/" topbar="1" class="btn btn-default pull-left help" data-toggle="tooltip" data-placement="bottom" data-original-title="" title="<?php echo __("Help", true) ?>"><span class="glyphicon glyphicon-question-sign"></span></a>