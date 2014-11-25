<!-- 学生信息录入 -->
<div class="container">
	<form method="post" accept-charset="utf-8" action="<?php echo base_url('admin/show'); ?>" class="form-horizontal update" role="form" >
		<div class"form-group">
			<div class="col-sm-offset-3">
				<a href="<?php echo base_url('admin/newstu'); ?>">新建学生</a>
				<a href="<?php echo base_url('admin/newuser'); ?>">新建用户</a>				
				<a href="<?php echo base_url('admin/newschool'); ?>">新建学校</a>
				<a href="<?php echo base_url('admin/newteacher'); ?>">新建教师</a>
				<a href="<?php echo base_url('admin/edit'); ?>">编辑作业</a>
			</div>
		</div>
		<div class="form-group">
	    	<label for="stuid" class="col-sm-3 control-label">姓名</label>
	    	<div class="col-sm-2">
	      		<select class="form-control" id='stuid' name="stuid">
	      			<?php if(isset($stu)) { ?>
	      			<?php foreach ($stu as $key => $value) { ?>
	      			<option value=<?php echo $value['id']?> ><?php echo $value['name'] ?></option>
	      			<?php } ?>
					<?php } ?>
				</select>	      		
	   		</div>
	  	</div>
	  	<div class="form-group">
	    	<label for="teacherid" class="col-sm-3 control-label">教师</label>
	    	<div class="col-sm-2">
	      		<select class="form-control" id='teacherid' name="teacherid">
	      			<?php if(isset($teacher)) { ?>
	      			<?php foreach ($teacher as $key => $value) { ?>
	      			<option value=<?php echo $value['id']?> ><?php echo $value['name'] ?></option>
	      			<?php } ?>
					<?php } ?>
				</select>    		
	   		</div>
	  	</div>
	  	<div class="form-group">	  		
	    	<label for="date" class="col-sm-3 control-label">日期<span class="notice">*</span></label>
	    	<div class="col-sm-6">
	    		<select  id='month' name="month">	      			
	      			<?php for ($i=1;$i<13;$i++) { ?>
	      			<option value=<?php echo $i; 
	      				if($i==$month) echo ' selected="selected"';
	      			?> 
	      			><?php echo $i; ?></option>
	      			<?php } ?>
				</select>
				月
				<select  id='day' name="day">	      			
	      			<?php for ($i=1;$i<32;$i++) { ?>
	      			<option value=<?php echo $i;
	      				if($i==$day) echo ' selected="selected"';
	      			?> 
	      			>
	      			<?php echo $i; ?></option>
	      			<?php } ?>
				</select>
				日
	   		</div>
	  	</div>
	  	<div class="form-group">
	    	<label for="content" class="col-sm-3 control-label">辅导内容<span class="notice">*</span></label>
	   		<!-- <div id="editor" class="col-sm-7" id="content" name="content">哈哈哈哈，我是默认内容</div> -->
	   		<textarea id="editor" class="col-sm-7" name="content" style="height:300px;"></textarea>
	  	</div>
		<div class="form-group">
	    	<div class="col-sm-offset-3 col-sm-9">
	    		<button type="submit" class="btn btn-default" >提交</button>
	    	</div>
	  	</div>
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
</script>