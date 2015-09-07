<?php //print_r($this->data); die();?>
<?php 
  $langs = array(
    'eng' => 'English',
    'esp' => 'Español',
    'ita' => "Italiano"
  );
?>

<style type="text/css">

</style>

<?php 
echo $form->create('User', array('url'=>$this->passedArgs + array("?"=>$_GET)));
?>

<div class="view">
<!-- <div class="page-header">
  <h1><?php __("My Account")?> <small><?php __("Settings")?></small></h1>
</div> -->

<ul class="nav nav-tabs">
  <li role="main" class="active"><a href="#"><?php __("Main")?></a></li>
  <li role="login-data"><a href="#"><?php __("Change Password")?></a></li>
</ul>

<div class="panel panel-default" role="main">
  	<div class="row">
      <!-- IMAGEN DEL USUARIO -->
  		<div class="col-md-3 picture_column">
  			<?php 
              $username = $this->Session->read('User.name');
              $username = split(' ', $username);                  
              $image = $this->data['User']['image'];
              if($image != ''){
                $image = $this->Html->url('/')."upload/".$image;
              }else{
                $image = $this->Html->url('/')."img/default.jpg";
              }
        ?>
  			<img id="my_account_image" src="<?php echo $image?>?>" width="150" heigth="150" alt="<?php __("Me")?>" class="img-circle">
        <div class="row">
          <div class="col-md-12 picture_column">
            <div class="form-group">
              <input type="button" class="btn btn-primary file_button" value="<?php echo __("Upload", true);?>">
              <div class="file_input">
               <input style="display:none;" type="file" id="exampleInputFile">
              </div>
            </div>              
          </div>
        </div>
  		</div>
      <!-- OTROS DATOS -->
  		<div class="col-md-9">
  			<div class="row">
  				<?php echo $form->input('id');?>
  				<?php echo $form->input('name' , array('label'=>__("Name", true), 'md-cols'=>12, 'class'=>'not-empty'));?>
  			</div>
  			<div class="row">
  				<?php echo $form->input('document_id', array('label'=>__("Document Id", true),'md-cols'=>6, 'class'=>'not-empty'));?>
          <?php echo $form->input('email', array('label'=>__("E-mail (Username)", true),'md-cols'=>6, 'class'=>'not-empty email'));?>
  			</div>
  			<div class="row">
  				<?php echo $form->input('address', array('md-cols'=>12));?>
  			</div>
  			<div class="row">
  				<?php echo $form->input('phone', array('md-cols'=>6));?>
  				<?php echo $form->input('mobile', array('md-cols'=>6));?>
  			</div>
  			<div class="row">
  				<?php 
  					// echo $form->input('country_id', array('options'=>$countries,'class'=>'selectpicker show-tick', 'data-live-search'=>"true"));
  					echo $form->input('lang', array('label'=>__("Language", true), 'options'=>$langs, 'class'=>'selectpicker show-tick'));
  				?>
          <!-- <?php echo $form->input('autoinvoicing_currency_id', array('label'=>__("Autoinvoicing Currency", true), 'options'=>$currencies, 'class'=>'selectpicker show-tick'));?> -->
  			</div>
  			<div class="row">
  				
  			</div>

        
  		</div>
  	</div>
</div>
<div class="panel panel-default" role="login-data">
  <div class="panel-body">
<!-- PASSWORD -->
        <div class="row">      
          <div class="col-md-6">
            <div class="form-group has-feedback">
              <label for="UserPassword"><?php __("New Password");?></label>
              <input name="data[User][password]" type="password" md-cols="6" class="form-control" id="UserPassword">
              <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
              <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
            </div>
          </div>
        </div>
        <!-- CONFIRM PASSWORD -->
        <div class="row">      
          <div class="col-md-6">
            <div class="form-group has-feedback">
              <label for="UserPassword"><?php __("Confirm New Password");?></label>
              <input type="password" md-cols="6" class="form-control" id="UserConfirmPassword">
              <span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>
              <span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
              <span class="form-control-msg"><?php __("The password doesn't match")?></span>
            </div>
          </div>
        </div> 
  </div>
</div>
<div class="panel panel-default" role="users">
  <div class="panel-body">
    <div class="row">

      <div class="container-fluid">

        <div class="row seachGroup">
          <div class="col-md-5 col-md-offset-3">
            <div class="form-group">
              <input type="text" md-cols="10" placeholder="<?php __("Search or Send an Invitation")?>" class=" form-control" id="searchUser">       
              <div class="searchResults"></div>
            </div>
          </div>
          <div class="col-md-1">
            <button type="button" class="btn btn-primary" data-toggle="button" id="addAssignedUser" autocomplete="off">
                <?php __("Add")?>
              </button>

          </div>

        </div>


        <div class="assigned-users col-md-6 col-md-offset-3" >
          <?php foreach ($this->data['AssignedUser'] as $key => $ua) {?>
          <?php 
              $image = $ua['Assigned']['image'];
              if($image != ''){
                $image = $this->Html->url('/')."upload/".$image;
              }else{
                $image = $this->Html->url('/')."img/default.jpg";
              }
          ?>
          <div class="assigned-user row">
            <div class="col-md-2">
              <img src="<?php echo $image;?>" class="img-responsive img-rounded" alt="Responsive image">
            </div>
            <div class="col-md-10">
              <h5><?php echo $ua['Assigned']['name'] ?></h5>
              <p>Email: <?php echo $ua['Assigned']['email'] ?></p>
              <!-- <p>Created: <?php echo $ua['AssignedUser']['created'] ?></p> -->
              <button id="<?php echo $ua['id'] ?>" enabled="<?php echo $ua['enabled'] ?>" type="button" class="btn <?php echo $ua['enabled'] ? 'btn-primary' : '' ?>" data-toggle="button" autocomplete="off">
                <?php echo $ua['enabled'] ? __("Enabled", true) : __("Disabled", false) ?>
              </button>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>


    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12"><div class="form-group"><input type="submit" class="btn btn-primary" value="Save"></div></div>
</div>
</form>
</div>

<style type="text/css">
  .assigned-users div.assigned-user{
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px rgb(229, 229, 229) solid;
  }
  .assigned-users div.assigned-user:last-child{
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: none;
  }

  .seachGroup{
    margin-bottom: 40px;
  }

  .search-result{
    padding: 10px 10px;
    display: block;
    border: 1px rgb(229, 229, 229) solid;
    background-color: aliceblue;
  }
</style>


<script type="text/javascript">
  // Variable to store your files
  var files;
  var tr = '';
  var searching = false;

  $(document).ready(function(){

    $('.file_button').attr('disable', false);

    $('#addAssignedUser').unbind('click');
    $('#addAssignedUser').click(function(){
      $(this).attr('disable', true);
      addAssignedUser();
    });
    // Add events

    // $('#searchUser').keyup(function(){
    //   if($(this).val().length > 6){

    //   }
    // });
    $('.assigned-user button').unbind('click');
    $('.assigned-user button').click(function(){
      var id = $(this).attr('id');
      var disable = $(this).attr('enabled');
      $.ajax({
        type: "GET",
        url: "<?php echo $html->url(array("controller"=>"users", "action"=>"assigned_user_enabled")); ?>",
        data: 'id='+id+'&disable='+disable,
        success: function(msg){
          reply = JSON.parse(msg);
          if(reply['status']=='ok'){
            if(reply['enabled']){
              $('.assigned-user button#'+reply['assigned_user']['UsersAssignedUser']['id']).text('<?php echo __('Enabled', true)?>');
              $('.assigned-user button#'+reply['assigned_user']['UsersAssignedUser']['id']).addClass('btn-primary');
            }else{
              $('.assigned-user button#'+reply['assigned_user']['UsersAssignedUser']['id']).text('<?php echo __('Disabled', true)?>');
              $('.assigned-user button#'+reply['assigned_user']['UsersAssignedUser']['id']).removeClass('btn-primary');
              $('.assigned-user button#'+reply['assigned_user']['UsersAssignedUser']['id']).attr('enabled', false);
            }
            console.log(reply);
          }

        }
      });


    });


    $('input[type=file]').on('change', prepareUpload);

    $('form').submit(function(){
      if(!validateForm()){
        return false;
      }
    });

    
    $('#searchUser').keyup(function(){
      setTimeout(function(){
        q = $('#searchUser').val();
        if(q.length > 6){
          if(!searching){
            findUser(q); 
          } 
        }       
      }, 500);
    });

    $('#searchUser').blur(function(){
      q = $('#searchUser').val();
      findUser(q);  
    });

  });

  function addAssignedUser(){

    $.ajax({
      type: "GET",
      url: "<?php echo $html->url(array("controller"=>"users", "action"=>"add_assigned_user")); ?>",
      data: 'email='+$('#searchUser').val(),
      success: function(msg){
        reply = JSON.parse(msg);
        console.log(reply);
        location.reload();
      }
    });
  }

  function findUser(q){

    searching = true;
    console.log(q);
    searching = false;
    $.ajax({
      type: "GET",
      url: "<?php echo $html->url(array("controller"=>"users", "action"=>"ajax_index")); ?>",
      data: 'q='+q,
      success: function(msg){
        reply = JSON.parse(msg);
        console.log(reply);
        $('.searchResults .search-result').remove(); 
        var tr = '';
        if(reply['status']=='ok'){
          
          // console.log('length:' + reply['data'].length);
          // console.log(reply['data']);
          // console.log(reply['data'][0]);
          // for (var i = reply['data'].length - 1; i >= 0; i--) {
            // tr += '<?php echo $this->Html->link('Create',array('controller'=>'expenses', 'action'=>'add'), array('icon'=>'plus'));?>'
            tr += '<a href="users/assign_user/<?php echo $this->data['User']['id']?>/?user='+reply['data']['User']['id']+'" class="search-result">'+reply['data']['User']['name']+'</a>';
          // };
          $('.searchResults').append(tr);
        }

      }
    });
  }

  function validateForm(){

    if(!$('div[role=login-data]').is(':visible')){
      return true;
    }


    $('#UserPassword').parent().removeClass('has-error');
    $('#UserPassword').parent().removeClass('has-success');
    $('#UserConfirmPassword').parent().removeClass('has-error');
    $('#UserConfirmPassword').parent().removeClass('has-success');
    $('#UserConfirmPassword').parent().find('.form-control-msg').hide();


    if($('#UserPassword').val().length == 0){
      $('#UserPassword').parent().addClass('has-error');
      $('#UserPassword').parent().find('.glyphicon').hide();
      $('#UserPassword').parent().find('.glyphicon-remove').show();
      $('#UserPassword').attr('placeholder', '<?php echo __("Enter the password")?>');
      $('#UserPassword').focus();
      return false;
    }

    if($('#UserPassword').val() != $('#UserConfirmPassword').val()){
      $('#UserConfirmPassword').parent().addClass('has-error');
      $('#UserConfirmPassword').parent().find('.glyphicon').hide();
      $('#UserConfirmPassword').parent().find('.glyphicon-remove').show();
      $('#UserConfirmPassword').parent().find('.form-control-msg').show();
      $('#UserConfirmPassword').attr('placeholder', '<?php echo __("Enter the same password")?>');
      $('#UserConfirmPassword').focus();
      return false;
    }

    $('#UserPassword').parent().addClass('has-success');
    $('#UserPassword').parent().find('.glyphicon').hide();
    $('#UserPassword').parent().find('.glyphicon-ok').show();

    $('#UserConfirmPassword').parent().addClass('has-success');
    $('#UserConfirmPassword').parent().find('.glyphicon').hide();
    $('#UserConfirmPassword').parent().find('.glyphicon-ok').show();

    console.log("Formulario valido");

    return true;
  }

  // Grab the files and set them to our variable
  function prepareUpload(event){
    files = event.target.files;
    uploadFiles(event);
  }

  // Catch the form submit and upload the files
  function uploadFiles(event){

    $('.file_button').val('<?php echo __("Uploading....", true)?>');

    event.stopPropagation(); // Stop stuff happening
    event.preventDefault(); // Totally stop stuff happening

    // START A LOADING SPINNER HERE

    // Create a formdata object and add the files
    var data = new FormData();
    $.each(files, function(key, value){
        data.append(key, value);
    });

    $.ajax({
        url: '<?php echo $html->url(array("controller"=>"users", "action"=>"ajax_upload", $this->data['User']['id'])); ?>',
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, // Don't process the files
        contentType: false, // Set content type to false as jQuery will tell the server its a query string request
        success: function(msg){
          console.log(msg);
          var image = '<?php echo $this->Html->url('/')."upload/"; ?>' + msg['name'];
          $('#my_account_image').attr('src', image);

          $('.file_button').val('<?php echo __("Ok", true)?>');
          $('.file_button').val('<?php echo __("Upload", true)?>');
          // console.log("Archivo agregado");
        } 
    });
}

</script>

<style type="text/css">
  div#content{
    margin-top: -50px !important;
  }
</style>