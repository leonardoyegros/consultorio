<?php 
	echo $this->Html->link('',array('controller'=>'documents', 'action'=>'add'), array('topbar'=>true,  'icon'=>'plus'));
    echo $this->Html->link('',array('controller'=>'documents', 'action'=>'edit',$topbar->data['Document']['id']), array('topbar'=>true, 'icon'=>'pencil', 'title'=>__('
    	Edit', true)));
    echo $this->Html->link('',array('controller'=>'documents', 'action'=>'delete',$topbar->data['Document']['id']), array('topbar'=>true, 'icon'=>'remove', 'title'=>__('Delete', true)));
    echo $this->Html->link('',array('controller'=>'documents', 'action'=>'index'), array('topbar'=>true, 'icon'=>'list', 'title'=>__('List', true)));
    // echo $this->Html->link('',array('controller'=>'documents', 'action'=>'add'), array('topbar'=>true,  'icon'=>'search'));
    // echo $this->Html->link('',array('controller'=>'documents', 'action'=>'add'), array('topbar'=>true,  'icon'=>'question-sign'));	
?>
<a href="http://www.getsiso.com/listar-documentos/" topbar="1" class="btn btn-default pull-left help" data-toggle="tooltip" data-placement="bottom" data-original-title="" title="<?php echo __("Help", true) ?>"><span class="glyphicon glyphicon-question-sign"></span></a>
	