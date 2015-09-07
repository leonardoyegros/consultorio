<?php 
	echo $this->Html->link('',array('controller'=>'purchases', 'action'=>'add'), array('topbar'=>true,  'icon'=>'plus'));
    echo $this->Html->link('',array('controller'=>'purchases', 'action'=>'edit',$topbar->data['Purchase']['id']), array('topbar'=>true, 'icon'=>'pencil', 'title'=>__('
    	Edit', true)));
    echo $this->Html->link('',array('controller'=>'purchases', 'action'=>'delete',$topbar->data['Purchase']['id']), array('topbar'=>true, 'icon'=>'remove', 'title'=>__('Delete', true)));
    echo $this->Html->link('',array('controller'=>'expenses', 'action'=>'index',$topbar->data['Expense']['id']), array('topbar'=>true, 'icon'=>'list', 'title'=>__('
    	List', true)));
?>
<a href="http://www.getsiso.com/listar-compras/" topbar="1" class="btn btn-default pull-left help" data-toggle="tooltip" data-placement="bottom" data-original-title="" title="<?php echo __("Help", true) ?>"><span class="glyphicon glyphicon-question-sign"></span></a>