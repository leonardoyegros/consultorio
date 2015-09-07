<ul class="nav nav-pills nav-stacked">
	<!-- <li><a href=""><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Add</a></li> -->
	<li><?php echo $this->Html->link('Edit',array('controller'=>'contacts', 'action'=>'edit',$sidebar->data['Contact']['id']), array('icon'=>'pencil'));?></li>
	<li><?php echo $this->Html->link('List',array('controller'=>'contacts', 'action'=>'index'), array('icon'=>'list'));?></li>
 	<li><?php echo $this->Html->link('Create',array('controller'=>'contacts', 'action'=>'add'), array('icon'=>'plus'));?></li>
 	<li><?php echo $this->Html->link('Delete',array('controller'=>'contacts', 'action'=>'delete',$sidebar->data['Contact']['id']), array('icon'=>'remove'));?></li>
</ul>

	