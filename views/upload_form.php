<html>
<head>
<title>Upload Form</title>
<meta charset="utf-8" />
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('upload/do_upload');?>

<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit"/>

</form>

</body>
</html>