<?php 
	echo $this->Html->link('',array('controller'=>'fund_accounts', 'action'=>'add'), array('topbar'=>true,  'icon'=>'plus'));
    echo $this->Html->link('',array('controller'=>'fund_accounts', 'action'=>'edit',$topbar->data['FundAccount']['id']), array('topbar'=>true, 'icon'=>'pencil', 'title'=>__('Edit', true)));
    echo $this->Html->link('',array('controller'=>'fund_accounts', 'action'=>'delete',$topbar->data['FundAccount']['id']), array('topbar'=>true, 'icon'=>'remove', 'title'=>__('Delete', true)));
    echo $this->Html->link('',array('controller'=>'fund_accounts', 'action'=>'index'), array('topbar'=>true, 'icon'=>'list', 'title'=>__('List', true)));
?>
<a href="http://www.getsiso.com/listar-cuentas-de-fondo/" topbar="1" class="btn btn-default pull-left help" data-toggle="tooltip" data-placement="bottom" data-original-title="" title="<?php echo __("Help", true) ?>"><span class="glyphicon glyphicon-question-sign"></span></a>