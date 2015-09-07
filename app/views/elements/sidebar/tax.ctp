<ul class="nav nav-pills nav-stacked">
	<!-- <li><a href=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Add</a></li> -->
	<li><?php echo $this->Html->link('Edit',array('controller'=>'taxes', 'action'=>'edit',$sidebar->data['Tax']['id']), array('icon'=>'pencil'));?></li>
	<li><?php echo $this->Html->link('List',array('controller'=>'taxes', 'action'=>'index'), array('icon'=>'list'));?></li>
 	<li><?php echo $this->Html->link('Create',array('controller'=>'taxes', 'action'=>'add'), array('icon'=>'plus'));?></li>
 	<li><?php echo $this->Html->link('Delete',array('controller'=>'taxes', 'action'=>'delete',$sidebar->data['Tax']['id']), array('icon'=>'remove'));?></li>
</ul>

	