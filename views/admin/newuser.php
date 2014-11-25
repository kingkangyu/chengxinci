<!-- 用户信息录入 -->
<div class="container">
	<form enctype="multipart/form-data" method="post" accept-charset="utf-8" action="<?php echo base_url('admin/newuser'); ?>" class="form-horizontal update" role="form" >
		<div class"form-group">
			<div class="col-sm-offset-3">
				<a href="<?php echo base_url('admin/newstu'); ?>">新建学生</a>			
				<a href="<?php echo base_url('admin/newschool'); ?>">新建学校</a>
				<a href="<?php echo base_url('admin/newteacher'); ?>">新建教师</a>
				<a href="<?php echo base_url('admin/edit'); ?>">编辑作业</a>
				<a href="<?php echo base_url('admin/show'); ?>">返回主页</a>
			</div>
		</div>
		<div class="form-group">
	    	<label for="name" class="col-sm-3 control-label">用户名<span class="notice">*</span></label>
	    	<div class="col-sm-5">
	      		<input type="text" class="form-control" id="name" name="name"  placeholder="用户名" />
	      		<?php if(isset($repeat)) echo "<span class='notice'>*用户名已存在</span>"; ?>    		
	   		</div>
	  	</div>
	  	<div class="form-group">
	    	<label for="pass" class="col-sm-3 control-label">密码<span class="notice">*</span></label>
	    	<div class="col-sm-5">
	      		<input type="password" class="form-control" id="pass" name="pass" placeholder="密码" />	      		
	   		</div>
	  	</div>		
	  	<div class="form-group">
	    	<label for="stuid" class="col-sm-3 control-label">学生</label>
	    	<div class="col-sm-5">
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
	    	<div class="col-sm-offset-3 col-sm-9">
	    		<button type="submit" class="btn btn-default" >提交</button>
	    	</div>
	  	</div>
	</form>
</div>