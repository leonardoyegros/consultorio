<div class="contacts view row">
	<div class="col-md-12">
		<ul class="nav nav-tabs">
		  <li role="contact-data" class="active"><a href="#">Contact Data</a></li>
		  <?php if($contact['Contact']['autoinvoice']):?>
		  <li role="autoinvoicing"><a href="#">Autoinvoicing</a></li>
		  <?php endif;?>
		  <li role="audit-data"><a href="#">Audit Data</a></li>
		</ul>
		<div class="panel panel-default" role="contact-data">
			<h3><?php echo h($contact['Contact']['name']); ?></h3>

			<dl>
				<dt><?php echo __('Document'); ?></dt>
				<dd>
					<?php echo h($contact['Contact']['document_id']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Country'); ?></dt>
				<dd>
					<?php echo h($contact['Country']['name']); ?>
					&nbsp;
				</dd>
				<!-- <dt><?php echo __('City'); ?></dt>
				<dd>
					<?php echo h($contact['City']['name']); ?>
					&nbsp;
				</dd> -->
				<dt><?php echo __('Address'); ?></dt>
				<dd>
					<?php echo h($contact['Contact']['address']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Mobile'); ?></dt>
				<dd>
					<?php echo h($contact['Contact']['mobile']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Phone'); ?></dt>
				<dd>
					<?php echo h($contact['Contact']['phone']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Email'); ?></dt>
				<dd>
					<?php echo h($contact['Contact']['email']); ?>
					&nbsp;
				</dd>
			</dl>
		</div>
		<div class="panel panel-default" role="autoinvoicing">
			<dl>
				<dt><?php echo __('Repeat'); ?></dt>
				<dd>
					<?php echo h(ucwords($contact['Contact']['autoinvoicing_repeat'])); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Init Date'); ?></dt>
				<dd>
					<?php echo !empty($contact['Contact']['init_date']) ?  $contact['Contact']['init_date'] : "<i>No defined</i>"; ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Currency'); ?></dt>
				<dd>
					<?php echo $this->Html->link($contact['Currency']['name'], array('controller'=>'currencies', 'action'=>'view', $contact['Currency']['id'],'?'=> array('modal'=>1)), array('data-toggle'=> 'modal','data-target'=>'#myModal')); //h($contact['Currency']['name']); ?>
					&nbsp;
				</dd>
			</dl>

			<div class="row"> <!-- ROW -->
		        <div class="col-md-6"> <!-- COL6 -->
		          <h4><?php echo __("Expenses", true)?></h4>
		          <table id="contact_expenses" class="table table-responsive table-bordered" data-toggle="tooltip" title="<?php echo __("Enter the Expense Accounts here")?>" data-placement="top">
		            <thead>
		              <tr>
		                <th><?php echo __("Expense");?></th>
		                <th class="numeric"><?php echo __("Price");?></th>
		              </tr>
		            </thead>
		            <tbody class="items">
		              <?php $i=0; foreach ($contact['ContactsExpense'] as $key => $contact_expense):?>
		              <tr class="item">
		                <td><?php echo $contact_expense['Expense']['name']?></td>
		                <td>
		                    <?php echo $contact_expense['amount']?>
		                </td>
		              </tr>
		              <?php $i++; endforeach;?>
		            </tbody>
		          </table>
		        </div><!-- COL6 -->
		      </div> <!-- ROW -->
		</div>
		<div class="panel panel-default" role="audit-data">
			<dl>
				<dt><?php echo __('User'); ?></dt>
				<dd>
					<?php echo h($contact['CreatedUser']['name']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Created'); ?></dt>
				<dd>
					<?php echo h($contact['Contact']['created']); ?>
					&nbsp;
				</dd>
				<dt><?php echo __('Modified'); ?></dt>
				<dd>
					<?php echo h($contact['Contact']['modified']); ?>
					&nbsp;
				</dd>
				
				
			</dl>
		</div>

	</div>
</div>
	