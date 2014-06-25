<h2>Press Control</h2>

<?php

	$data['plugins'] = get_option('pc_plugins');
	$data['themes'] = get_option('pc_themes');

	echo '<pre>';

	print_r($data);


?>