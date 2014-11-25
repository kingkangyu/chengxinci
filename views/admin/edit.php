<!-- 家长信息更改 -->
<div class="container">
	<form method="post" accept-charset="utf-8" action="<?php echo base_url('admin/edit'); ?>" class="form-horizontal update" role="form" >
		<div class"form-group">
			<div class="col-sm-offset-3">
				<a href="<?php echo base_url('admin/newstu'); ?>">新建学生</a>
				<a href="<?php echo base_url('admin/newuser'); ?>">新建用户</a>				
				<a href="<?php echo base_url('admin/newschool'); ?>">新建学校</a>
				<a href="<?php echo base_url('admin/newteacher'); ?>">新建教师</a>
				<a href="<?php echo base_url('admin/show'); ?>">返回主页</a>
			</div>
		</div>
		<!-- 姓名列表 -->
		<div class="form-group">
	    	<label for="stuid" class="col-sm-3 control-label">姓名</label>
	    	<div class="col-sm-2">
	      		<select class="form-control" id='stuid' name="stuid">
	      			<?php if(isset($stu)) { ?>
	      			<?php foreach ($stu as $key => $value) { ?>
	      			<option value=<?php echo $value['id']; 
	      			if(isset($defaultid)&&$defaultid==$value['id'])
	      				echo ' selected="selected"';
	      			?>  
	      			>
	      			<?php echo $value['name']; ?>
	      			</option>
	      			<?php } ?>
					<?php } ?>
				</select>	      		
	   		</div>
	  	</div>
	  	<?php if(isset($list)) { ?>
	  	<!-- 日期列表 -->
	  	<div class="form-group">
	    	<label for="date" class="col-sm-3 control-label">日期</label>
	    	<div class="col-sm-2">
	      		<select class="form-control" id='date' name="date">	      			
	      			<?php foreach ($list as $key => $value) { ?>
	      			<option value=<?php echo $value['id'];
	      			if(isset($defaultdate)&&$defaultdate==$value['id'])
	      				echo ' selected="selected"';
	      			?>
	      			>
	      			<?php echo $value['date']; ?>
	      		</option>
	      			<?php } ?>					
				</select>	      		
	   		</div>
	  	</div>
	  	<?php } ?>
	  	<?php if (isset($work)):?>
	  	<!-- 作业内容 -->
	  	<div class="form-group">
	    	<label for="editor" class="col-sm-3 control-label">作业内容<span class="notice">*</span></label>
	   		<textarea id="editor" class="col-sm-7" name="work" style="height:300px;"><?php echo $work; ?></textarea>
	  	</div>
		<div class="form-group">
	    	<div class="col-sm-offset-3 col-sm-9">
	    		<button type="submit" class="btn btn-default" >提交</button>
	    	</div>
	  	</div>
	  	<?php endif; ?>
	</form>
</div>
<script type="text/javascript">

    //实例化编辑器
    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
    var ue = UE.getEditor('editor', {
        toolbars: [
            [
                'fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'strikethrough', 'superscript', 'subscript', 'pasteplain', '|',  
                'insertorderedlist', 'insertunorderedlist', 'selectall',  '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
            ],
            [               
                'insertimage', 'imagenone', 'imageleft', 'imageright', 'imagecenter' ,'|',
                'horizontal', 'date', 'time', '|',
                'print', 'preview', 'searchreplace','drafts'
            ]
        ],
        autoHeightEnabled: true,
        elementPathEnabled: false,
        autoFloatEnabled: true,
    });
    $(function(){
    	$('#date,#stuid').change(function(){
    		$('form').submit();
    	});
    	// $('#date').change(function(){
    	// 	var val=$('#date option:selected').val();
    	// 	alert('检测到点击'+val);
    	// });
    });
</script>