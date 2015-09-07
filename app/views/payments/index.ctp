	<table controller="Payment" class="table table-responsive table-bordered">
		<thead>
			<tr class="item">
				<th><?php echo $this->Paginator->sort('number');?></th>
				<th><?php echo $this->Paginator->sort('issue_date');?></th>
				<th><?php echo $this->Paginator->sort('advance');?></th>
				<th><?php echo $this->Paginator->sort('contact_id');?></th>
				<th><?php echo $this->Paginator->sort('amount');?></th>
				<th><?php echo $this->Paginator->sort('currency_id');?></th>
				<th class="pk"><input class="form-control select-all" type="checkbox"></th>
			</tr>
		</thead>
		<tbody>
	<?php
	$i = 0;
	foreach ($payments as $payment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr id="<?php echo $payment['Payment']['id']?>" class="item">
		<td><?php echo $this->Html->link(!empty($payment['Payment']['number'])?$payment['Payment']['number'] : __("Not Defined", true),array('controller'=>'payments', 'action'=>'view',$payment['Payment']['id'])); ?>&nbsp;</td>
		<td><?php echo $payment['Payment']['issue_date']; ?>&nbsp;</td>
		<td><?php echo !empty($payment['Payment']['advance']) ? __("Yes", true) : __("No"); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($payment['Contact']['name'], array('controller' => 'contacts', 'action' => 'view', $payment['Contact']['id'])); ?>
		</td>
		<td class="numeric"><?php echo $this->Format->number($payment['Payment']['amount'], 'money', array('symbol' => '') + $payment['Currency']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($payment['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $payment['Currency']['id'])); ?>
		</td>
		<td class="pk"><input id="<?php echo $document['Contact']['id']; ?>" class="form-control delete-index" type="checkbox"></td>
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
