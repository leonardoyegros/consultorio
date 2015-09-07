<ul class="nav nav-pills nav-stacked">
	<!-- <li><a href=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Add</a></li> -->
	<li><?php echo $this->Html->link('Edit',array('controller'=>'sales', 'action'=>'edit',$sidebar->data['Sale']['id']), array('icon'=>'pencil'));?></li>
	<li><?php echo $this->Html->link('List',array('controller'=>'sales', 'action'=>'index'), array('icon'=>'list'));?></li>
 	<li><?php echo $this->Html->link('Create',array('controller'=>'sales', 'action'=>'add'), array('icon'=>'plus'));?></li>
 	<li><?php echo $this->Html->link('Delete',array('controller'=>'sales', 'action'=>'delete',$sidebar->data['Sale']['id']), array('icon'=>'remove'));?></li>
</ul>

	