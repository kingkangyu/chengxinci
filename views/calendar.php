<?php echo $calendar; ?>
<script type="text/javascript">
$(function(){
	$('#previousurl').click(function(){
		var href=$(this).attr("href");
		$('#calendar').load(href);
		return false;
	});
	$('#nexturl').click(function(){
		var href=$(this).attr("href");
		$('#calendar').load(href);
		return false;
	});
});
</script>
