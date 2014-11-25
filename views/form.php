<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Form</title>
	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
</head>
<body>
	<form method="post" accept-charset="utf-8" action="<?php echo base_url('form1/show'); ?>" />
	<?php echo base_url('form1/show'); ?>
	<?php echo site_url('form1/show'); ?>
		<input type="text" name="text" placeholder="shuru" />
		<input type="submit" />
	
</body>
</html>