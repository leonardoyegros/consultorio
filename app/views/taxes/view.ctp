<div class="contacts view row">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="contact-data" class="active"><a href="#"><?php __("Tax Data")?></a></li>
		  <li role="audit-data"><a href="#">Audit Data</a></li>
		</ul>
		<div class="panel panel-default" role="contact-data">

			<dl>

				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $tax['Tax']['name']; ?>
					&nbsp;
				</dd>
					
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rate'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $tax['Tax']['rate']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Active'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo __($tax['Tax']['active']?"Yes":"No"); ?>
					&nbsp;
				</dd>
				
			</dl>

		</div>
		<div class="panel panel-default" role="audit-data">
			<dl>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Html->link($tax['User']['name'], array('controller' => 'users', 'action' => 'view', $tax['User']['id'])); ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $tax['Tax']['created']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $tax['Tax']['modified']; ?>
					&nbsp;
				</dd>
				
			</dl>
		</div>

	</div>
</div>





