<html>
<head>
<title>Upload Form</title>
<meta charset="utf-8" />
</head>
<body>

<h3>Your file was successfully uploaded!</h3>

<ul>
<?php echo $filename; ?>
</ul>

<p><?php echo anchor('upload', 'Upload Another File!'); ?></p>
<p><?php echo $userfile; ?></p>
</body>
</html>