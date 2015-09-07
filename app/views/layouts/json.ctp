<?php
	if(!empty($sencha)){
		//if ($callback) {
			header('Content-Type: text/javascript');
			echo $content_for_layout;
		/*} else {
			header('Content-Type: application/x-json');
			echo json_encode($output);
		}*/
	} else {
		header('Cache-Control: no-cache, must-revalidate');
		header("Content-Type: text/plain");
		echo $content_for_layout;
	}
	// $mt->end_cache($cache);
?>