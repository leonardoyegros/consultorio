	<table class="table table-responsive table-bordered">
		<thead>
			<tr>
							<th><?php echo $this->Paginator->sort('id');?></th>
							<th><?php echo $this->Paginator->sort('name');?></th>
							<th><?php echo $this->Paginator->sort('notes');?></th>
							<th><?php echo $this->Paginator->sort('module');?></th>
							<th><?php echo $this->Paginator->sort('status');?></th>
							<th><?php echo $this->Paginator->sort('user_id');?></th>
							<th><?php echo $this->Paginator->sort('created');?></th>
							<th><?php echo $this->Paginator->sort('modified');?></th>
							<th><?php echo $this->Paginator->sort('created_user_id');?></th>
						</tr>
		</thead>
		<tbody>
	<?php
	$i = 0;
	foreach ($tickets as $ticket):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $ticket['Ticket']['id']; ?>&nbsp;</td>
		<td><?php echo $ticket['Ticket']['name']; ?>&nbsp;</td>
		<td><?php echo $ticket['Ticket']['notes']; ?>&nbsp;</td>
		<td><?php echo $ticket['Ticket']['module']; ?>&nbsp;</td>
		<td><?php echo $ticket['Ticket']['status']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ticket['User']['name'], array('controller' => 'users', 'action' => 'view', $ticket['User']['id'])); ?>
		</td>
		<td><?php echo $ticket['Ticket']['created']; ?>&nbsp;</td>
		<td><?php echo $ticket['Ticket']['modified']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ticket['CreatedUser']['name'], array('controller' => 'created_users', 'action' => 'view', $ticket['CreatedUser']['id'])); ?>
		</td>
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
