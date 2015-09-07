<div class="contacts view row">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="contact-data" class="active"><a href="#"><?php __("Collection");?></a></li>
		  <?php if(!empty($collection['CollectionsAttachment'])): ?>
		  <li role="files"><a href="#"><?php echo __('Files', true)?></a></li>
		  <?php endif;?>
		  <li role="audit-data"><a href="#"><?php __('Audit Data')?></a></li>
		</ul>
		<div class="panel panel-default" role="contact-data">
			<dl><?php $i = 0; $class = ' class="altrow"';?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $collection['Collection']['id']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Issue Date'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $collection['Collection']['issue_date']; ?>
					&nbsp;
				</dd>
				<?php if($collection['Collection']['advance']):?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Advance'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php __("Yes"); ?>
					&nbsp;
				</dd>
				<?php endif;?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Contact'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Html->link($collection['Contact']['name'], array('controller' => 'contacts', 'action' => 'view', $collection['Contact']['id'])); ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Number'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $collection['Collection']['number']; ?>
					&nbsp;
				</dd>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $collection['Collection']['amount']; ?>
					&nbsp;
				</dd>
				<?php if($collection['Collection']['void']):?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo __("Cancelled", true); ?>
					&nbsp;
				</dd>
				<?php endif;?>
<!-- 				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Exchange Rate'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $collection['Collection']['exchange_rate']; ?>
					&nbsp;
				</dd>	 -->			
			</dl>
			<div class="row">
				<?php if(!empty($collection['SalesCollection'])):?>
				<div class="col-md-6">
					<h4><?php __("Receivables")?></h4>
					<table class="table table-responsive table-bordered">
					    <thead>
					      <tr>
					        <th class="pk"></th>
					        <th><?php echo __("Sale");?></th>
					        <th><?php echo __("Total");?></th>
					        <th><?php echo __("Total Paid");?></th>
					        <th><?php echo __("Paid");?></th>
					      </tr>
					    </thead>
					    <tbody class="items">
					    	<?php 
					    		$total = 0;
					    		$i = 0;
					    	?>
					    	<?php foreach ($collection['SalesCollection'] as $key => $sale_collection):?>
					    	<tr>
					    		<td><?php echo $i+1;?></td>
					    		<td><?php echo $html->link($sale_collection['Sale']['invoice_number'], array('controller'=>'sales', 'action'=>'view',$sale_collection['Sale']['id']));?></td>
					    		<td class="numeric"><?php echo $this->Format->number($sale_collection['Sale']['amount'],'money', array('symbol'=>'') + $collection['Currency']);?></td>					    		
					    		<td class="numeric"><?php echo $this->Format->number($sale_collection['Sale']['paid'],'money', array('symbol'=>'') + $collection['Currency']);?></td>					    		
					    		<td class="numeric"><?php echo $this->Format->number($sale_collection['amount'],'money', array('symbol'=>'') + $collection['Currency']);?></td>					    		
					    	</tr>
					    	<?php $i++;endforeach;?>
					    </tbody>
					   </table>	
				</div>
				<?php endif;?>
				<div class="col-md-6">
					<h4><?php __("Fund Accounts")?></h4>
					<table class="table table-responsive table-bordered">
					    <thead>
					      <tr>
					        <th class="pk"></th>
					        <th><?php echo __("Fund Account");?></th>
					        <th><?php echo __("Amount");?></th>
					        <th><?php echo __("Exchange Rate");?></th>
					      </tr>
					    </thead>
					    <tbody class="items">
					    	<?php 
					    		$total = 0;
					    		$i = 0;
					    	?>
					    	<?php foreach ($collection['CollectionsFundAccount'] as $key => $cfa):?>
					    	<tr>
					    		<td><?php echo $i+1;?></td>
					    		<td><?php echo $cfa['FundAccount']['name']?></td>
					    		<td class="numeric"><?php echo $this->Format->number($cfa['amount'],'money', array('symbol'=>'') + $collection['Currency']);?></td>	
					    		<td class="numeric"><?php echo $this->Format->number($cfa['currency_price'],'money', array('symbol'=>'') + $collection['Currency']);?></td>					    		
					    	</tr>
					    	<?php $i++;endforeach;?>
					    </tbody>
					   </table>	
				</div>
			</div>

				

		</div>
		<div class="panel panel-default" role="audit-data">
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $collection['User']['name']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $collection['Collection']['created']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $collection['Collection']['modified']; ?>
				&nbsp;
			</dd>
		</div>

		<div class="panel panel-default" role="files">
			<div class="row file_thumbs">
		      <?php 
		        $i = 0;
		        foreach ($collection['CollectionsAttachment'] as $key => $attachment):?>

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




