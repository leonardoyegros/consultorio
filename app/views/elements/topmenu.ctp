<div class="container-fuild">
  <nav id="top-menu" class="navbar navbar-inverse navbar-static">
      <div class="container-fluid">
        <div class="navbar-header">
          <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-example-js-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php echo $this->Html->link('',array('controller'=>'pages', 'action'=>'index'), array('class'=>'navbar-brand', 'icon'=>'dashboard', 'data-toggle'=>'tooltip', 'title'=>__("Dashboard", true)));?>
        </div>
        <div class="collapse navbar-collapse bs-example-js-navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                <?php echo  __("General", true) ?>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                <li role="presentation"><a role="menuitemTitle" tabindex="-1" href="#"><?php echo  __("Documents", true);?></a></li>
                <li role="presentation"><?php echo $this->Html->link(__('Add Document', true),array('controller'=>'documents', 'action'=>'add'), array('icon'=>'plus'));?></li>
                <li role="presentation"><?php echo $this->Html->link(__('List Documents', true),array('controller'=>'documents', 'action'=>'index'), array('icon'=>'list'));?></li>
                <li role="presentation"><?php echo $this->Html->link(__('Templates', true),array('controller'=>'invoice_templates', 'action'=>'index'), array('icon'=>'print'));?></li>
                <li role="presentation" class="divider"></li> 
                <li role="presentation"><a role="menuitemTitle" tabindex="-1" href="#"><?php echo  __("Taxes", true);?></a></li>
                <li role="presentation"><?php echo $this->Html->link(__('Add', true),array('controller'=>'taxes', 'action'=>'add'), array('icon'=>'plus'));?></li>
                <li role="presentation"><?php echo $this->Html->link(__('List', true),array('controller'=>'taxes', 'action'=>'index'), array('icon'=>'list'));?></li>
                <li role="presentation" class="divider"></li> 
                <li role="presentation"><a role="menuitemTitle" tabindex="-1" href="#"><?php echo  __("Expenses", true);?></a></li>
                <li role="presentation"><?php echo $this->Html->link(__('Add Expense', true),array('controller'=>'expenses', 'action'=>'add'), array('icon'=>'plus'));?></li>
                <li role="presentation"><?php echo $this->Html->link(__('List Expenses', true),array('controller'=>'expenses', 'action'=>'index'), array('icon'=>'list'));?></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitemTitle" tabindex="-1" href="#"><?php echo __("Contacts", true);?></a></li>
                <li role="presentation"><?php echo $this->Html->link(__('Add Contact', true),array('controller'=>'contacts', 'action'=>'add'), array('icon'=>'plus'));?></li>
                <li role="presentation"><?php echo $this->Html->link(__('List Contacts', true),array('controller'=>'contacts', 'action'=>'index'), array('icon'=>'list'));?></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitemTitle" tabindex="-1" href="#"><?php echo  __("Files", true);?></a></li>
                <li role="presentation"><?php echo $this->Html->link(__('List Files', true),array('controller'=>'attachments', 'action'=>'index'), array('icon'=>'list'));?></li>                
              </ul>
            </li>
            <li class="dropdown">
              <a id="drop2" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                <?php echo __('Sales');?>
                <!-- <span class="caret"></span> -->
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                <li role="presentation"><a role="menuitemTitle" tabindex="-1" href="#"></span><?php echo __('Sales');?></a></li>
                <li role="presentation"><?php echo $this->Html->link(__('Add Sale',true),array('controller'=>'sales', 'action'=>'add'), array('icon'=>'plus'));?></li>
                <li role="presentation"><?php echo $this->Html->link(__('List Sales', true),array('controller'=>'sales', 'action'=>'index'), array('icon'=>'list'));?></li>
                <li role="presentation"><a role="menuitemTitle" tabindex="-1" href="#">Collections</a></li>
                <li role="presentation"><?php echo $this->Html->link(__('Add Collection', true),array('controller'=>'collections', 'action'=>'add'), array('icon'=>'plus'));?></li>
                <li role="presentation"><?php echo $this->Html->link(__('List Collections', true),array('controller'=>'collections', 'action'=>'index'), array('icon'=>'list'));?></li>
                <li role="presentation"><?php echo $this->Html->link(__('Receivables', true),array('controller'=>'receivables', 'action'=>'index'), array('icon'=>'stats'));?></li>
              </ul>
            </li>

            <li class="dropdown">
              <a id="drop3" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                <?php echo __("Purchases");?>
                <!-- <span class="caret"></span> -->
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                <!-- <li role="presentation" class="divider"></li> -->
                <li role="presentation"><a role="menuitemTitle" tabindex="-1" href="#"><?php echo __("Purchases");?></a></li>
                <li role="presentation"><?php echo $this->Html->link(__('Add Purchase',true),array('controller'=>'purchases', 'action'=>'add'), array('icon'=>'plus'));?></li>
                <li role="presentation"><?php echo $this->Html->link(__('List Purchases',true),array('controller'=>'purchases', 'action'=>'index'), array('icon'=>'list'));?></li>
                <!-- <li role="presentation" class="divider"></li> -->
                <li role="presentation"><a role="menuitemTitle" tabindex="-1" href="#"><?php echo __("Payments");?></a></li>
                <li role="presentation"><?php echo $this->Html->link(__('Add Payment',true),array('controller'=>'payments', 'action'=>'add'), array('icon'=>'plus'));?></li>
                <li role="presentation"><?php echo $this->Html->link(__('List Payments',true),array('controller'=>'payments', 'action'=>'index'), array('icon'=>'list'));?></li>
                <li role="presentation"><?php echo $this->Html->link(__('Payables', true),array('controller'=>'payables', 'action'=>'index'), array('icon'=>'stats'));?></li>
                <!-- <li role="presentation" class="divider"></li> -->
              </ul>
            </li>

            <li class="dropdown">
              <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                <?php echo __("Finance",true)?>
                <!-- <span class="caret"></span> -->
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                <!-- <li role="presentation" class="divider"></li> -->
                <li role="presentation"><a role="menuitemTitle" tabindex="-1" href="#"><?php echo __("Fund Accounts");?></a></li>
                <li role="presentation"><?php echo $this->Html->link(__('Add Fund Account', true),array('controller'=>'fund_accounts', 'action'=>'add'), array('icon'=>'plus'));?></li>             
                <li role="presentation"><?php echo $this->Html->link(__('List Fund Accounts', true),array('controller'=>'fund_accounts', 'action'=>'index'), array('icon'=>'list'));?></li>             
                <!-- <li role="presentation" class="divider"></li> -->
                <li role="presentation"><a role="menuitemTitle" tabindex="-1" href="#"><?php echo __("Currencies", true) ?></a></li>
                <li role="presentation"><?php echo $this->Html->link(__('List Currencies', true),array('controller'=>'currencies', 'action'=>'index'), array('icon'=>'list'));?></li>             
              </ul>
            </li>
            
          </ul>

          <ul id="topmenu-dropdown" class="nav navbar-nav navbar-right">
            <li id="fat-menu" class="dropdown">
              <a id="myAccountMenu" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                <?php 
                  $masters = $this->Session->read('UsersAssignedUser');
                  // print_r($masters); die();
                  $username = $this->Session->read('User.name');
                  $username = split(' ', $username);                  
                  $image = $this->Session->read('User.image');
                  if($image != ''){
                    $image = $this->Html->url('/')."upload/".$image;
                  }else{
                    $image = $this->Html->url('/')."img/default.jpg";
                  }

                ?>

                <?php 
                  $masters = $session->read('MasterUser');
                  $masters_selected = $session->read('MasterUserSelected.User.name');
                  $alter_user = $session->read('alter_user');
                  if(empty($alter_user)){
                    $msg = (!empty($username[0])?  __("Hi", true)." ".$username[0] : "Set your settings here!");
                  }else{
                    $masters_selected = split(' ', $masters_selected);
                    $msg = __("Viewing as ", true).$masters_selected[0];
                  }

                   // print_r($masters); die();

                  // print_r($_SESSION); die();

                ?>
                
                <span id="username"><?php echo $msg;?></span>
                <img src="<?php echo $image?>?>" id="profile-image" width="40" height="40" />
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                <li role="presentation"><a href="<?php echo $this->Html->url('/my_account') ?>" icon="cog"><span class="glyphicon glyphicon-cog"></span><?php echo __("My Account", true)?></a></li>
               
                
                <?php if(!empty($masters)):?> 
                <li role="presentation" class="divider"></li>
                <li role="presentation" class="view-as"><?php echo $this->Html->link(__('View my data ', true) ,array('controller'=>'users', 'action'=>'change_user', '?'=>array('me'=>1)), array('icon'=>'eye'));?></li>
                <?php endif;?>

                <?php foreach ($masters as $key => $master):?>
                <?php 
                  if($master['enabled']):
                ?>
                <li role="presentation"  class="view-as">
                <?php echo $this->Html->link(__('View as ', true) . $master['Master']['name'],array('controller'=>'users', 'action'=>'change_user', $master['Master']['id']), array('icon'=>'eye', 'enabled'=>$master['enabled']));?></li>
                <?php endif;?>
                <?php endforeach;?>
                <li role="presentation" style="  border-top: 1px solid #ccc;
  padding-top: 10px;"><?php echo $this->Html->link(__('Logout', true),array('controller'=>'users', 'action'=>'logout'), array('icon'=>'off', 'id'=>'LogOut'));?></li>
              </ul>
            </li>
          </ul>


        </div><!-- /.nav-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <!-- TOP MENU -->
      
  </div>

  <style type="text/css">
/*    .view-as{
      padding-left: 
    }*/

    .view-as a{
      padding-top: 10px !important; 
      padding-bottom:  10px !important; 
    }
  </style>


  <script type="text/javascript">
  $(document).ready(function(){
    $('#Logout').click(function(){
      Intercom('shutdown');
    });
  });
  </script>