<div class="container">
	<form method="post" accept-charset="utf-8" action="<?php echo base_url('admin/newschool'); ?>" class="form-horizontal update" role="form" >
		<div class"form-group">
			<div class="col-sm-offset-3">
				<a href="<?php echo base_url('admin/newstu'); ?>">新建学生</a>
				<a href="<?php echo base_url('admin/newuser'); ?>">新建用户</a>				
				<a href="<?php echo base_url('admin/newteacher'); ?>">新建教师</a>
				<a href="<?php echo base_url('admin/edit'); ?>">编辑作业</a>
				<a href="<?php echo base_url('admin/show'); ?>">返回主页</a>
			</div>
		</div>
		<div class="form-group">
	    	<label for="school" class="col-sm-3 control-label">学校</label>
	    	<div class="col-sm-5">
	      		<input type="text" class="form-control" id="school" name="name"  placeholder="学校" />		      		
	   		</div>
	  	</div>
	  	<div class="form-group">
	    	<div class="col-sm-offset-3 col-sm-9">
	    		<button type="submit" class="btn btn-default" >提交</button>
	    	</div>
	  	</div>
	 </form>
</div>