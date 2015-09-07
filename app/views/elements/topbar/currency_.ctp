<?php 
    echo $this->Html->link('',array('controller'=>'currencies', 'action'=>'index'), array('topbar'=>true, 'icon'=>'list','data-toggle'=>"tooltip", 'title'=>__("List", true)));;
?>
<a href="http://www.getsiso.com/crear-moneda/" topbar="1" class="btn btn-default pull-left help" data-toggle="tooltip" data-placement="bottom" data-original-title="" title="<?php echo __("Help", true) ?>"><span class="glyphicon glyphicon-question-sign"></span></a>