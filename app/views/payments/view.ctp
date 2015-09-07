<?php //print_r($payment); die();?>


<div class="contacts view row">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="contact-data" class="active"><a href="#"><?php __("Expense Data")?></a></li>
		  <?php if(!empty($payment['PaymentsAttachment'])): ?>
		  <li role="files"><a href="#"><?php echo __('Files', true)?></a></li>
		  <?php endif;?>
		  <li role="audit-data"><a href="#">Audit Data</a></li>
		</ul>
		<div class="panel panel-default" role="contact-data">

			<dl><?php $i = 0; $class = ' class="altrow"';?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $payment['Payment']['id']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Issue Date'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $payment['Payment']['issue_date']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Advance'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $payment['Payment']['advance'] ? __("Yes", true) : __("No", true); ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contact'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Html->link($payment['Contact']['name'], array('controller' => 'contacts', 'action' => 'view', $payment['Contact']['id'])); ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Number'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $payment['Payment']['number']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Notes'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $payment['Payment']['notes']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Format->number($payment['Payment']['amount'],'money', array('symbol'=>''));?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Currency'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Html->link($payment['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $payment['Currency']['id'])); ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Exchange Rate'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Format->number($payment['Payment']['exchange_rate'],'money', array('symbol'=>''));?>
					&nbsp;
				</dd>
				
			</dl>


			<div class="row">
				<div class="col-md-6">
					<h4><?php __("Fund Account")?></h4>
					<table class="table table-responsive table-bordered">
					    <thead>
					      <tr>
					        <th class="pk"></th>
					        <th><?php echo __("Fund Account");?></th>
					        <th class="numeric"><?php echo __("Amount");?></th>
					      </tr>
					    </thead>
					    <tbody class="items">
					    	<?php foreach ($payment['PaymentsFundAccount'] as $key => $fund_account):?>
					    	<tr>
					    		<td><?php echo $i+1;?></td>
					    		<td><?php echo $fund_account['FundAccount']['name'];?></td>
						        <td class="numeric"><?php echo $this->Format->number($fund_account['amount'],'money', array('symbol'=>'') + $payment['Currency']);?></td>
					    	</tr>
					    	<?php $i++;endforeach;?>
					    </tbody>
				   </table>	
				</div>

				<div class="col-md-6">
					<h4><?php __("Related Purchases")?></h4>
					<table class="table table-responsive table-bordered">
					    <thead>
					      <tr>
					        <th class="pk"></th>
					        <th><?php echo __("Purchase");?></th>
					        <th><?php echo __("Purchase Total");?></th>
					        <th class="numeric"><?php echo __("Amount");?></th>
					      </tr>
					    </thead>
					    <tbody class="items">
					    	<?php foreach ($payment['PurchasesPayment'] as $key => $purchase):?>
					    	<tr>
					    		<td><?php echo $i+1;?></td>
					    		<td><?php echo $purchase['Purchase']['invoice_number'];?></td>
					    		<td class="numeric"><?php echo $this->Format->number($purchase['Purchase']['total'],'money', array('symbol'=>'') + $payment['Currency']);?></td>
						        <td class="numeric"><?php echo $this->Format->number($purchase['amount'],'money', array('symbol'=>'') + $payment['Currency']);?></td>
					    	</tr>
					    	<?php $i++;endforeach;?>
					    </tbody>
				   </table>	
				</div>
			</div>



		</div>
		<div class="panel panel-default" role="audit-data">
			<dl>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Html->link($payment['User']['name'], array('controller' => 'users', 'action' => 'view', $payment['User']['id'])); ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $payment['Payment']['created']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $payment['Payment']['modified']; ?>
					&nbsp;
				</dd>				
			</dl>
		</div>

		<div class="panel panel-default" role="files">
			<div class="row file_thumbs">
		      <?php 
		        $i = 0;
		        foreach ($payment['PaymentsAttachment'] as $key => $attachment):?>

		        <?php 
		          $name = explode('.', $attachment['Attachment']['name']);
		        ?>

		        <div attachment_id="<?php echo $attachment['Attachment']['id']?>" id="file_<?php echo $attachment['Attachment']['id']?>" class="col-md-2 file">

		          <div class="file_thumb">
		            <span class="glyphicon glyphicon-file"></span>
		            <!-- <span class="extension"><?php echo !empty($name[1])?$name[1]:''?></span> -->
		          </div>
		          <div class="description">
		            <h5><?php echo $attachment['Attachment']['name']?></h5>

		          </div>
		          <div class="dropdown">
		            <button class="btn btn-default dropdown-toggle" type="button" id="file_action_<?php echo $i?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
		              Dropdown
		              <span class="caret"></span>
		            </button>
		            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		              <li><a target="_blank" href="<?php echo $this->Html->url('/')."upload/".$attachment['Attachment']['name']?>"><?php echo __("Preview", true)?></a></li>
		              <li><a attachment_id="<?php echo $attachment['Attachment']['id']?>" class="delete_item" href="<?php echo $this->Html->url(array('controller'=>'purchases','action'=>'attachment_delete', $attachment['id']))?>"><?php echo __("Delete", true)?></a></li>
		            </ul>
		          </div>
		        </div>
		        <?php $i++;endforeach;?>
		    </div>
		</div>

	</div>
</div>





