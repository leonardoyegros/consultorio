<!-- 
<div class="page-header">
  <h1><?php __("Attachments")?></h1>
</div> -->

<div class="panel panel-default" style="margin-top:-55px">
	<div class="panel-body">
		<div class="row upload_row">
      <div class="col-md-12">
        <div id="my_dropzone">
          <div class="dz-default dz-message"><?php __("Click or Drop your files here to upload")?></div>
        </div>
      </div>
      <!-- <div class="col-md-2">
        <div class="form-group">
          <input type="submit" class="btn btn-primary file_button" value="<?php echo __("Upload", true);?>">
          <div class="file_input">
           <input style="display:none;" type="file" id="exampleInputFile">
          </div>
        </div>              
      </div> -->
    </div>
    <div class="row file_thumbs">
      <?php 
        $i = 0;
        foreach ($attachments as $key => $attachment):?>

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
              <li><a href="<?php echo $this->Html->url(array('controller'=>'sales', 'action'=>'add','?'=>array('attachment'=>$attachment['Attachment']['id']))); ?>"><?php echo __("Add Sale", true)?></a></li>
              <li><a href="<?php echo $this->Html->url(array('controller'=>'collections', 'action'=>'add','?'=>array('attachment'=>$attachment['Attachment']['id']))); ?>"><?php echo __("Add Collection", true)?></a></li>
              <li><a href="<?php echo $this->Html->url(array('controller'=>'purchases', 'action'=>'add','?'=>array('attachment'=>$attachment['Attachment']['id']))); ?>"><?php echo __("Add Purchase", true)?></a></li>
              <li><a href="<?php echo $this->Html->url(array('controller'=>'payments', 'action'=>'add','?'=>array('attachment'=>$attachment['Attachment']['id']))); ?>"><?php echo __("Add Payment", true)?></a></li>
              <li><a attachment_id="<?php echo $attachment['Attachment']['id']?>" class="delete_item" href="#"><?php echo __("Delete", true)?></a></li>
            </ul>
          </div>
        </div>
        <?php $i++;endforeach;?>
    </div>
	</div>
</div>

  <div style="display:none" attachment_id="" id="file_<?php echo $attachment['Attachment']['id']?>" class="col-md-2 file template">

          <div class="file_thumb">
            <span class="glyphicon glyphicon-file"></span>
            <!-- <span class="extension"><?php echo !empty($name[1])?$name[1]:''?></span> -->
          </div>
          <div class="description">
            <h5></h5>

          </div>
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="file_action_<?php echo $i?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Dropdown
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li><a target="_blank" href="<?php echo $this->Html->url('/')."upload/"?>"><?php echo __("Preview", true)?></a></li>
              <li><a attachment_id="" class="delete_item" href="#"><?php echo __("Delete", true)?></a></li>
            </ul>
          </div>
        </div>




<script type="text/javascript">
  // Variable to store your files
  var files;
  var tr = '';
  var searching = false;

	$(document).ready(function(){
		// Add events

    // var myDropzone = new Dropzone("div#my_dropzone", { url: "<?php echo $html->url(array("controller"=>"attachments", "action"=>"ajax_upload")); ?>"});
    // Dropzone.options.myDropzone = {
    //   accept: function(file, done) {
    //     location.reload();
    //   }
    // };
    Dropzone.options.myDropzone = {
      init: function() {
        this.on("addedfile", function(file) { location.reload(); });
      }
    };
    var myDropzone = new Dropzone("div#my_dropzone", { url: "<?php echo $html->url(array("controller"=>"attachments", "action"=>"ajax_upload")); ?>"});
    // $("div#my_dropzone").dropzone({ url: "<?php echo $html->url(array("controller"=>"attachments", "action"=>"ajax_upload")); ?>"});

    // $("div#my_dropzone").dropzone({ 
    //   url: "<?php echo $html->url(array("controller"=>"attachments", "action"=>"ajax_upload")); ?>" ,
    //   options: {
    //     clickable : true,
    //     init: function() {
    //       this.on("addedfile", function(file) { alert("Added file."); });
    //     }
    //   }
    // });

    function reload(){
      console.log("accept");
      location.reload();
    }

    $('input[type=file]').unbind('click');
		$('input[type=file]').on('change', prepareUpload);
    
    $('.file_thumbs a.delete_item').unbind('click');
    $('.file_thumbs a.delete_item').click(function(){
      delete_file($(this).attr('attachment_id'));
      return false;
    });
	});

  function delete_file(id){
    if(!confirm('<?php echo __("Are you sure?", true) ?>')){
      return false;
    }

    console.log("borrando item");
    $('div[attachment_id='+id+']').remove();
    $.ajax({
        url: '<?php echo $html->url(array("controller"=>"attachments", "action"=>"ajax_delete")); ?>',
        type: 'POST',
        data: 'id='+id,
        success: function(msg){
          console.log("item borrado");
          
        } 
  });
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
        url: '<?php echo $html->url(array("controller"=>"attachments", "action"=>"ajax_upload", $this->data['User']['id'])); ?>',
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
          location.reload();
        } 
	});
}

</script>


<?php echo $javascript->link('dropzone');?>