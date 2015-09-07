	<table class="table table-responsive table-bordered">
		<thead>
			<tr>
							<th><?php echo $this->Paginator->sort('id');?></th>
							<th><?php echo $this->Paginator->sort('assigned_user_id');?></th>
							<th><?php echo $this->Paginator->sort('user_id');?></th>
							<th><?php echo $this->Paginator->sort('created');?></th>
							<th><?php echo $this->Paginator->sort('modified');?></th>
						</tr>
		</thead>
		<tbody>
	<?php
	$i = 0;
	foreach ($usersAssignedUsers as $usersAssignedUser):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $usersAssignedUser['UsersAssignedUser']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($usersAssignedUser['AssignedUser']['name'], array('controller' => 'users', 'action' => 'view', $usersAssignedUser['AssignedUser']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($usersAssignedUser['User']['name'], array('controller' => 'users', 'action' => 'view', $usersAssignedUser['User']['id'])); ?>
		</td>
		<td><?php echo $usersAssignedUser['UsersAssignedUser']['created']; ?>&nbsp;</td>
		<td><?php echo $usersAssignedUser['UsersAssignedUser']['modified']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
		</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
