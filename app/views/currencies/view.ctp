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
					<?php echo $currency['Currency']['name']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ask'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $currency['Currency']['buy_price']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bid'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $currency['Currency']['sale_price']; ?>
					&nbsp;
				</dd>
					
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Symbol'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $currency['Currency']['symbol']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Decimals'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $currency['Currency']['decimals']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Main'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo __($currency['Currency']['main'] ? "Yes": "No", true); ?>
					&nbsp;
				</dd>
			</dl>


		</div>
		<div class="panel panel-default" role="audit-data">
			<dl>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $currency['Currency']['created']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $currency['Currency']['modified']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Html->link($currency['User']['name'], array('controller' => 'users', 'action' => 'view', $currency['User']['id'])); ?>
					&nbsp;
				</dd>
				
			</dl>
		</div>

	</div>
</div>




