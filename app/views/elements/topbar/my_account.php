<?php
	echo $this->Html->link('',array('controller'=>'sales', 'action'=>'add'), array('topbar'=>true,  'icon'=>'plus', "title"=>__("Add", true)));
    echo $this->Html->link('',array('controller'=>'sales', 'action'=>'edit',$topbar->data['Sale']['id']), array('topbar'=>true, 'icon'=>'pencil', 'title'=>__('
    	Edit', true)));
    echo $this->Html->link('',array('controller'=>'sales', 'action'=>'delete',$topbar->data['Sale']['id']), array('confirm'=>__("Do you realy want to delete this?", true), 'topbar'=>true, 'icon'=>'remove', 'title'=>__('Delete', true)));
    echo $this->Html->link('',array('controller'=>'sales', 'action'=>'index'), array('topbar'=>true,  'icon'=>'list', "title"=>__("List", true)));
?>
<a href="http://www.getsiso.com/listar-ventas/" topbar="1" class="btn btn-default pull-left help" data-toggle="tooltip" data-placement="bottom" data-original-title="" title="<?php echo __("Help", true) ?>"><span class="glyphicon glyphicon-question-sign"></span></a>