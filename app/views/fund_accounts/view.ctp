<div class="contacts view row">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="contact-data" class="active"><a href="#"><?php __("Expense Data")?></a></li>
		  <li role="audit-data"><a href="#">Audit Data</a></li>
		</ul>
		<div class="panel panel-default" role="contact-data">

			<dl><?php $i = 0; $class = ' class="altrow"';?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $fundAccount['FundAccount']['id']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $fundAccount['FundAccount']['name']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Html->link($fundAccount['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $fundAccount['Currency']['id'])); ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo __($fundAccount['FundAccount']['active']?"Yes":"No"); ?>
					&nbsp;
				</dd>
				
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Category'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo __($types[$fundAccount['FundAccount']['category']], true); ?>
					&nbsp;
				</dd>
			</dl>


		</div>
		<div class="panel panel-default" role="audit-data">
			<dl>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Html->link($fundAccount['User']['name'], array('controller' => 'users', 'action' => 'view', $fundAccount['User']['id'])); ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $fundAccount['FundAccount']['created']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $fundAccount['FundAccount']['modified']; ?>
					&nbsp;
				</dd>
				
			</dl>
		</div>

	</div>
</div>


