<div class="contacts view row">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="contact-data" class="active"><a href="#"><?php __("Expense Data")?></a></li>
		  <li role="audit-data"><a href="#">Audit Data</a></li>
		</ul>
		<div class="panel panel-default" role="contact-data">

			<dl><?php $i = 0; $class = ' class="altrow"';?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo strtoupper($expense['Expense']['name']); ?>
					&nbsp;
				</dd>
				<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $expense['Expense']['type']; ?>
					&nbsp;
				</dd> -->
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sales Enabled'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo __($expense['Expense']['sales_enabled']?"Yes": "No", true);; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Purchases Enabled'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo __($expense['Expense']['purchases_enabled']?"Yes": "No", true);; ?>
					&nbsp;
				</dd>

				<!-- <?php if(!empty($expense['ExpensesTax'])):?> -->
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Taxes'); ?></dt>
				<dd>
				<?php $taxes = '';?>
				<?php 
					foreach ($expense['ExpensesTax'] as $key => $tax):
						$taxes[] = $tax['Tax']['name'];
					endforeach;
					echo implode(", ", $taxes);
				?>	
				</dd>			
				<!-- <?php endif;?> -->

				<!-- <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Buy Price'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $expense['Expense']['buy_price']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sell Price'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $expense['Expense']['sell_price']; ?>
					&nbsp;
				</dd> -->
			</dl>


		</div>
		<div class="panel panel-default" role="audit-data">
			<dl>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Html->link($expense['User']['name'], array('controller' => 'users', 'action' => 'view', $expense['User']['id'])); ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $expense['Expense']['created']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $expense['Expense']['modified']; ?>
					&nbsp;
				</dd>
				
				
			</dl>
		</div>

	</div>
</div>


