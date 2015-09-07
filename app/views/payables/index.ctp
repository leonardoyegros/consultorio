
	<table class="table table-responsive table-bordered">
		<thead>
			<tr>
				<th></th>
				<th><?php echo $this->Paginator->sort('purchase_id');?></th>
				<th><?php echo $this->Paginator->sort('contact_id');?></th>
				<th><?php echo $this->Paginator->sort('invoice_number');?></th>
				<th><?php echo $this->Paginator->sort('overdue_date');?></th>
				<th><?php echo $this->Paginator->sort('total');?></th>
				<th><?php echo $this->Paginator->sort('paid');?></th>
				<th><?php echo $this->Paginator->sort('currency_id');?></th>
			</tr>
		</thead>
		<tbody>
	<?php
	$i = 0;
	foreach ($payables as $payable):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td class="pk"><?php echo $this->Html->link('',array('controller'=>'purchases', 'action'=>'view',$payable['Payable']['id']), array('icon'=>'eye-open')); ?></td>
		<td><?php echo $this->Html->link(!empty($payable['Purchase']['invoice_number'])?$payable['Purchase']['invoice_number']:__("Number Not Defined", true), array('controller' => 'purchases', 'action' => 'view', $payable['Purchase']['id'])); ?></td>
		<td><?php echo $this->Html->link($payable['Contact']['name'], array('controller' => 'contacts', 'action' => 'view', $payable['Contact']['id'])); ?></td>
		<td><?php echo $payable['Payable']['invoice_number']; ?>&nbsp;</td>
		<td><?php echo $payable['Payable']['overdue_date']; ?>&nbsp;</td>
		<td class="numeric"><?php echo $this->Format->number($payable['Payable']['total'],'money', array('symbol' => '') + $payable['Currency']);?></td>
		<td class="numeric"><?php echo $this->Format->number($payable['Payable']['paid'],'money', array('symbol' => '') + $payable['Currency']);?></td>
		<td><?php echo $this->Html->link($payable['Currency']['symbol'], array('controller' => 'contacts', 'action' => 'view', $payable['Currency']['id'])); ?></td>
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
