<div class="contacts view row">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="contact-data" class="active"><a href="#"><?php echo __('Sale Data', true)?></a></li>
		  <?php if(!empty($sale['SalesAttachment'])): ?>
		  <li role="files"><a href="#"><?php echo __('Files', true)?></a></li>
		  <?php endif;?>
		  <li role="audit-data"><a href="#"><?php echo __('Audit Data', true)?></a></li>
		</ul>
		<div class="panel panel-default" role="contact-data">
			<dl>
				<dt><?php echo __('Issue Date'); ?></dt>
				<dd>
					<?php echo h($sale['Sale']['issue_date']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Contact'); ?></dt>
				<dd>
					<?php echo $this->Html->link($sale['Contact']['name'], array('controller' => 'contacts', 'action' => 'view', $sale['Contact']['id'])); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Billed'); ?></dt>
				<dd>
					<?php echo $sale['Sale']['bill'] ? __("Yes", true) : __("No", true) ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Invoice Number'); ?></dt>
				<dd>
					<?php echo h($sale['Sale']['invoice_number']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Currency'); ?></dt>
				<dd>
					<?php echo $this->Html->link($sale['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $sale['Currency']['id'])); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Currency Price'); ?></dt>
				<dd>
					<?php echo h($sale['Sale']['currency_price']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Amount'); ?></dt>
				<dd>
					<?php echo $this->Format->number($sale['Sale']['amount'], 'money', array('symbol' => '') + $sale['Currency']); ?>
					&nbsp;
				</dd>
				
				<dt><?php echo __('Payment Term'); ?></dt>
				<dd>
					<?php echo __(ucfirst($sale['Sale']['payment_term']), true); ?>
					&nbsp;
				</dd>
				<?php if($sale['Sale']['payment_term']=='credit'):?>
				<dt><?php echo __('Overdue Date'); ?></dt>
				<dd>
					<?php echo h($sale['Sale']['overdue_date']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Overdue Amount'); ?></dt>
				<dd>
					<?php echo $this->Format->number($sale['Sale']['overdue_amount'], 'money', array('symbol' => '') + $sale['Currency']); ?>
					&nbsp;
				</dd>
				<?php endif;?>
			</dl>
			<div class="row">
				<div class="col-md-12">
					<h4>Items</h4>
					<table class="table table-responsive table-bordered">
					    <thead>
					      <tr>
					        <th class="pk"></th>
					        <th><?php echo __("Item");?></th>
					        <th class="numeric"><?php echo __("No Taxed");?></th>
					        <?php foreach ($taxes as $key => $tax):?>
					        <th class="numeric"><?php echo __($tax, true);?></th>
					        <?php $cols++; endforeach;?>
					        <th class="numeric"><?php echo __("SubTotal");?></th>
					      </tr>
					    </thead>
					    <tbody class="items">
					    	<?php 
					    		$total = 0;
					    		$i = 0;
					    	?>
					    	<?php foreach ($sale['SalesExpense'] as $key => $sale_expense):?>
					    	<tr>
					    		<td><?php echo $i+1;?></td>
					    		<td><?php echo $sale_expense['Expense']['name'];?></td>
					    		<?php $subtotal = 0; $cols=0;?>
					    		<?php foreach ($sale_expense['SalesExpensesPrice'] as $key2 => $tax):?>
						        <td class="numeric"><?php echo $this->Format->number($tax['price'],'money', array('symbol'=>'') + $sale['Currency']);?></td>
						        <?php $cols++; $subtotal+=$tax['price']; endforeach;?>
						        <?php $total += $subtotal;?>
						        <td class="numeric"><?php echo $this->Format->number($subtotal,'money', array('symbol'=>'') + $sale['Currency']);?></td>
					    	</tr>
					    	<?php $i++;endforeach;?>
					    	<tr>
					    		<th class="left" colspan="<?php echo $cols+2; ?>"><?php __("Total")?></th>
					    		<td><?php ?></td>
					    	</tr>
					    </tbody>
					   </table>	
					</div>
				</div>

				<div class="row">
				<?php if(!empty($sale['SalesAdvance'])):?>
				
				<div class="col-md-6">
					<h4><?php __("Advances")?></h4>
					<table class="table table-responsive table-bordered">
					    <thead>
					      <tr>
					        <th class="pk"></th>
					        <th><?php echo __("Collection");?></th>
					        <th><?php echo __("Amount");?></th>
					      </tr>
					    </thead>
					    <tbody class="items">
					    	<?php 
					    		$i = 0;
					    	?>
					    	<?php foreach ($sale['SalesAdvance'] as $key => $advance):?>
					    	<tr>
					    		<td><?php echo $i+1;?></td>
					    		<td><?php echo $advance['Collection']['number'];?></td>
						        <td class="numeric"><?php echo $this->Format->number($advance['amount'],'money', array('symbol'=>'') + $sale['Currency']);?></td>
					    	</tr>
					    	<?php $i++;endforeach;?>
					    </tbody>
					   </table>	
					</div>
				<?php endif;?>


				<?php if($sale['Sale']['payment_term'] == 'cash'):?>
				<div class="col-md-6">
					<h4><?php __("Fund Accounts")?></h4>
					<table class="table table-responsive table-bordered">
					    <thead>
					      <tr>
					        <th class="pk"></th>
					        <th><?php echo __("Fund Account");?></th>
					        <th><?php echo __("Amount");?></th>
					      </tr>
					    </thead>
					    <tbody class="items">
					    	<?php 
					    		$i = 0;
					    	?>
					    	<?php foreach ($sale['SalesFundAccount'] as $key => $sales_fund_account):?>
					    	<tr>
					    		<td><?php echo $i+1;?></td>
					    		<td><?php echo $sales_fund_account['FundAccount']['name'];?></td>
						        <td class="numeric"><?php echo $this->Format->number($sales_fund_account['amount'],'money', array('symbol'=>'') + $sale['Currency']);?></td>
					    	</tr>
					    	<?php $i++;endforeach;?>
					    </tbody>
					   </table>	
					</div>
				
				<?php endif;?>
				</div>

		</div>
		<div class="panel panel-default" role="audit-data">
			<dl>
				<dt><?php echo __('User'); ?></dt>
				<dd>
					<?php echo h($sale['User']['name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Created'); ?></dt>
				<dd>
					<?php echo h($sale['Sale']['created']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Modified'); ?></dt>
				<dd>
					<?php echo h($sale['Sale']['modified']); ?>
					&nbsp;
				</dd>
				
			</dl>
		</div>

		<div class="panel panel-default" role="files">
			<div class="row file_thumbs">
		      <?php 
		        $i = 0;
		        foreach ($sale['SalesAttachment'] as $key => $attachment):?>

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
		              <li><a attachment_id="<?php echo $attachment['Attachment']['id']?>" class="delete_item" href="<?php echo $this->Html->url(array('controller'=>'sales','action'=>'attachment_delete', $attachment['id']))?>"><?php echo __("Delete", true)?></a></li>
		            </ul>
		          </div>
		        </div>
		        <?php $i++;endforeach;?>
		    </div>
		</div>

	</div>
</div>


