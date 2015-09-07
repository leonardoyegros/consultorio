

<?php 
	// print_r($users); die();

?>

	<table class="table table-responsive table-bordered">
	<thead>
	<tr>
			<th class="pk"></th>
			<th><?php __("Name")?></th>
			<th><?php __("E-mail")?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
	<tr>
		<?php                 
          $image = $user['User']['image'];
          if($image != ''){
            $image = $this->Html->url('/')."upload/".$image;
          }else{
            $image = $this->Html->url('/')."img/default.jpg";
          }
        ?>
		<td class="pk"><img width="30" src="<?php echo $image;?>"></td>
		<td valign="center" ><?php echo $user['User']['name']?></td>
		<td valign="center" ><?php echo $user['User']['email']?></td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>

	<style type="text/css">
		.table>tbody>tr>td{
		    vertical-align: middle !important;
		}

	</style>

