<div class="usersAssignedUsers view">
<h2><?php  __('Users Assigned User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usersAssignedUser['UsersAssignedUser']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Assigned User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($usersAssignedUser['AssignedUser']['name'], array('controller' => 'users', 'action' => 'view', $usersAssignedUser['AssignedUser']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($usersAssignedUser['User']['name'], array('controller' => 'users', 'action' => 'view', $usersAssignedUser['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usersAssignedUser['UsersAssignedUser']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usersAssignedUser['UsersAssignedUser']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Users Assigned User', true), array('action' => 'edit', $usersAssignedUser['UsersAssignedUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Users Assigned User', true), array('action' => 'delete', $usersAssignedUser['UsersAssignedUser']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $usersAssignedUser['UsersAssignedUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users Assigned Users', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users Assigned User', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Assigned User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
