

<div class="col-md-4" id="contact-left">
	<div id="contactSearch" class="container">
		<input type="text" id="ContactName" class="form-control" placeholder="<?php echo __("Buscar por Nombre, CI o Telefono", true)?> ">
	</div>

	<div  id="contact-list">
		<?php foreach ($contacts as $key => $contact) {?>
		<div class="container">
			<div class="contact-item">
				<a href="javascript:void(0);" class="glyphicon <?php echo $key == 0 ? ' glyphicon-star' : 'glyphicon-star-empty'?> favorite"></a>
				<?php  echo $contact['Contact']['name'];?>
				<span class="text-right document_id"><?php  echo $contact['Contact']['document_id'];?></span>
			</div>
		</div>
		<?php }?>
	</div>
</div>
<div id="contact-details" class="col-md-8">
	<div class="row">
		<div class="col-md-3 img-container">
			<?php 
              $username = $this->Session->read('User.name');
              $username = split(' ', $username);                  
              $image = $this->data['User']['image'];
              if($image != ''){
                $image = $this->Html->url('/')."upload/".$image;
              }else{
                $image = $this->Html->url('/')."img/leo.jpg";
              }
	        ?>
			<img src="<?php echo $image?>?>" width="80" heigth="80" class="img-circle">
		</div>
		<div class="col-md-8">
			<h3>Leonardo Martinez (2035140)</h3>
			<h5><span class="glyphicon glyphicon-envelope"></span> leoomartinezyegros@gmail.com</h5>
			<h5><span class="glyphicon glyphicon-phone"></span> 0981 497 649</h5>
			<a class="col-md-4 btn-primary btn"><span class="glyphicon glyphicon-envelope"></span> E-mail</a>
			<a class="col-md-4 btn-info btn"><span class="glyphicon glyphicon-pencil"></span> Editar</a>
			<a class="col-md-4 btn-success btn"><span class="glyphicon glyphicon-plus"></span> Mascota</a>
		</div>

		<div class="col-md-12" id="pet-cards">

			<div class="col-md-12">
				<h4>Mascotas</h4>
			</div>
			

			<div class="col-md-4">
				<div class="pet-card">
					<p class="img">
						<img src="<?php echo $this->Html->url('/')."img/beagle.jpg"?>?>" width="80" heigth="80" class="img-circle">
					</p>
					<div class="pet-details">
						<div class="title">Uma</div>
						<div><strong>Especie</strong> : Perro</div>
						<div><strong>Raza</strong> : Beagle</div>
						<div><strong>Edad</strong> : 8 Meses</div>
					</div>		
					<div class="row">
						<div class="col-md-12 centered">
							<a href="" class="btn btn-success">Detalles</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="pet-card">
					<p class="img">
						<img src="<?php echo $this->Html->url('/')."img/beagle.jpg"?>?>" width="80" heigth="80" class="img-circle">
					</p>
					<div class="pet-details">
						<div class="title">Uma</div>
						<div><strong>Especie</strong> : Perro</div>
						<div><strong>Raza</strong> : Beagle</div>
						<div><strong>Edad</strong> : 8 Meses</div>
					</div>		
					<div class="row">
						<div class="col-md-12 centered">
							<a href="" class="btn btn-success">Detalles</a>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="pet-card">
					<p class="img">
						<img src="<?php echo $this->Html->url('/')."img/beagle.jpg"?>?>" width="80" heigth="80" class="img-circle">
					</p>
					<div class="pet-details">
						<div class="title">Uma</div>
						<div><strong>Especie</strong> : Perro</div>
						<div><strong>Raza</strong> : Beagle</div>
						<div><strong>Edad</strong> : 8 Meses</div>
					</div>		
					<div class="row">
						<div class="col-md-12 centered">
							<a href="" class="btn btn-success">Detalles</a>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>	
</div>




<style type="text/css">
	.pet-details strong{
		width: 60px;
		display: inline-block;
	}

	.pet-details{
		margin-bottom: 30px;
		margin-top: 15px;
	}

	#pet-cards{
		margin-top: 30px;
	}

	.pet-card{
		padding: 15px;
		border: 1px solid #e7e7e7;
		border-radius: 10px;
	}

	.pet-card .img{
		text-align: center;
	}

	.pet-card .title{
		text-align: center;
		font-size: 14px;
		font-weight: bold;
	}

	#contact-details h3{
		margin-top: 0px !important;
	}

	.img-container{
	    text-align: right;
	}

	.contact-item > .favorite{
		margin-right: 10px;
	}

	#contact-left{
		padding-left: 0px;
		padding-right: 0px;
	}

	.document_id{
		float:right;
	}

	#contact-list{
		margin-top: 15px;
	}

	#contact-details{
		background: white;
		border: 1px solid #e7e7e7;
		padding-top: 30px;
		padding-bottom: 30px;

	}
	.contact-item{
		padding: 10px;
		background: white;
		border-bottom: 1px solid #e7e7e7;
	}

</style>


<script type="text/javascript">
	$(document).ready(function(){
		bindScroll();
	});

	function bindScroll(){
		
	}

	$(function(){
		$('table').tablesorter({
			// widgets        : ['zebra', 'columns'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});
	});



</script>


<script type="text/javascript">
var page = 1;
var loadLock = 0;
$('document').ready(function(){
	

	$('#contactSearch input').keyup(function(){
		$('tr.item').hide();
		$('table tr.item:Contains('+$(this).val().toUpperCase()+')').show();  

	});

	scroll();


});

function scroll(){
	$('div#col-content').scroll(function() {

		// console.log("Scroll");
		console.log($('div#col-content').scrollTop() + ' + ' + $('div#col-content').height() + ' = ' + $(document).height());
	   if($('div#col-content').scrollTop() + $('div#col-content').height() > $('div.products_index').height() - 800) {
	       console.log($('div#col-content').scrollTop() + ' + ' + $('div#col-content').height() + ' = ' + $(document).height());
	       // loadPage(page+1);
	   }
	});
}

function loadPage(p) {
	if (loadLock == 1) {
		return;
	}

	console.log('loadPage()');
	loadLock = 1;

	$.ajax({
		type: "GET",
		url: "<?php echo $html->url(array("controller"=>"contacts", "action"=>"index")); ?>",
		data: "nolayout=1&page="+p+"&<?php echo http_build_query($args); ?>",
		success: function(msg){
			if (msg.trim() != '') {
				console.log("ASDF");
				loadLock = 0;
				$('table#products tbody').append(msg);
				// $('#products_end').before(msg);
				page = p;
				
			}
		}
	});
}




</script>