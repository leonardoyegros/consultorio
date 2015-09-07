<?php
	if (!empty($navbar)) {
?>
<!-- <div class="col-xs-6 col-sm-6 col-md-6 hidden-xs"> -->
	<ol class="breadcrumb">
		<?php
			foreach ($navbar as $title => $url) {
				// echo '<li>'.$html->link(__($title, true), $url) . '  ›' . '</li>';
				echo '<li>'.$this->Html->link(__($title, true), $url) . '  ' . '</li>';
			}
		?>
	</ol>
<!-- </div> -->
<?php
	}
?>