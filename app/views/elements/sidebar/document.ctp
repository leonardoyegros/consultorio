<ul class="nav nav-pills nav-stacked">
	<!-- <li><a href=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Add</a></li> -->
	<li><?php echo $this->Html->link('Edit',array('controller'=>'documents', 'action'=>'edit',$sidebar->data['Document']['id']), array('icon'=>'pencil'));?></li>
	<li><?php echo $this->Html->link('List',array('controller'=>'documents', 'action'=>'index'), array('icon'=>'list'));?></li>
 	<li><?php echo $this->Html->link('Create',array('controller'=>'documents', 'action'=>'add'), array('icon'=>'plus'));?></li>
 	<li><?php echo $this->Html->link('Delete',array('controller'=>'documents', 'action'=>'delete',$sidebar->data['Document']['id']), array('icon'=>'remove'));?></li>
</ul>

	