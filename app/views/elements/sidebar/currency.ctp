<ul class="nav nav-pills nav-stacked">
	<!-- <li><a href=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Add</a></li> -->
	<li><?php echo $this->Html->link('Edit',array('controller'=>'currencies', 'action'=>'edit',$sidebar->data['Currency']['id']), array('icon'=>'pencil'));?></li>
	<li><?php echo $this->Html->link('List',array('controller'=>'currencies', 'action'=>'index'), array('icon'=>'list'));?></li>
 	<li><?php echo $this->Html->link('Create',array('controller'=>'currencies', 'action'=>'add'), array('icon'=>'plus'));?></li>
 	<li><?php echo $this->Html->link('Delete',array('controller'=>'currencies', 'action'=>'delete',$sidebar->data['Currency']['id']), array('icon'=>'remove'));?></li>
</ul>

	