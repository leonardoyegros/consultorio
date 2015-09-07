<?php 
	echo $this->Html->link('',array('controller'=>'expenses', 'action'=>'add'), array('topbar'=>true,  'icon'=>'plus'));
    echo $this->Html->link('',array('controller'=>'expenses', 'action'=>'edit',$topbar->data['Expense']['id']), array('topbar'=>true, 'icon'=>'pencil', 'title'=>__('
    	Edit', true)));
    echo $this->Html->link('',array('controller'=>'expenses', 'action'=>'delete',$topbar->data['Expense']['id']), array('topbar'=>true, 'icon'=>'remove', 'title'=>__('Delete', true)));
    echo $this->Html->link('',array('controller'=>'expenses', 'action'=>'index',$topbar->data['Expense']['id']), array('topbar'=>true, 'icon'=>'list', 'title'=>__('
    	List', true)));
?>
<a href="http://www.getsiso.com/listar-expensas/" topbar="1" class="btn btn-default pull-left help" data-toggle="tooltip" data-placement="bottom" data-original-title="" title="<?php echo __("Help", true) ?>"><span class="glyphicon glyphicon-question-sign"></span></a>