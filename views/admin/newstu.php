<!-- 学生信息录入 -->
<div class="container">
	<form enctype="multipart/form-data" method="post" accept-charset="utf-8" action="<?php echo base_url('admin/newstu'); ?>" class="form-horizontal update" role="form" >
		<div class"form-group">
			<div class="col-sm-offset-3">			
				<a href="<?php echo base_url('admin/newschool'); ?>">新建学校</a>
				<a href="<?php echo base_url('admin/newteacher'); ?>">新建教师</a>
				<a href="<?php echo base_url('admin/edit'); ?>">编辑作业</a>
				<a href="<?php echo base_url('admin/show'); ?>">返回主页</a>
			</div>
		</div>
		<div class="form-group">
	    	<label for="name" class="col-sm-3 control-label">姓名<span class="notice">*</span></label>
	    	<div class="col-sm-5">
	      		<input type="text" class="form-control" id="name" name="name"  placeholder="姓名" />	      		
	   		</div>
	  	</div>		
	 	<div class="form-group">
	    	<label for="sex" class="col-sm-3 control-label">性别<span class="notice">*</span></label>
	    	<div class="col-sm-5">
	      		<select class="form-control" id='sex' name="sex">	      			
	      			<option value='0' >男</option>
	      			<option value='1' >女</option>
				</select>      		
	   		</div>
	  	</div>
	  	<div class="form-group">
	    	<label for="userfile" class="col-sm-3 control-label">照片</label>
	    	<div class="col-sm-5">
	      		<input type="file" name="userfile" id="userfile" size="20" />  		
	   		</div>
	  	</div>	
	  	<div class="form-group">
	    	<label for="age" class="col-sm-3 control-label">年龄</label>
	    	<div class="col-sm-5">
	      		<input type="text" class="form-control" id="age" name="age"  placeholder="年龄" />	      		
	   		</div>
	  	</div>
	  	<div class="form-group">
	    	<label for="grade" class="col-sm-3 control-label">年级</label>
	    	<div class="col-sm-5">
	      		<input type="text" class="form-control" id="grade" name="grade"  placeholder="年级" />	      		
	   		</div>
	  	</div>
	  	<div class="form-group">
	    	<label for="class" class="col-sm-3 control-label">班级</label>
	    	<div class="col-sm-5">
	      		<input type="text" class="form-control" id="class" name="class"  placeholder="班级" />	      		
	   		</div>
	  	</div>
	  	<div class="form-group">
	    	<label for="school_id" class="col-sm-3 control-label">学校<span class="notice">*</span></label>
	    	<div class="col-sm-5">
	      		<select class="form-control" id='school_id' name="school_id">
	      			<?php if(isset($school)) { ?>
	      			<?php foreach ($school as $key => $value) { ?>
	      			<option value=<?php echo $value['id']?> ><?php echo $value['name'] ?></option>
	      			<?php } ?>
					<?php } ?>
				</select>		      		
	   		</div>
	  	</div>
	  	<div class="form-group">
	    	<label for="address" class="col-sm-3 control-label">住址</label>
	    	<div class="col-sm-5">
	      		<input type="text" class="form-control" id="address" name="address"  placeholder="住址" />	      		
	   		</div>
	  	</div>
	  	<div class="form-group">
	    	<label for="parent" class="col-sm-3 control-label">家长</label>
	    	<div class="col-sm-5">
	      		<input type="text" class="form-control" id="parent" name="parent"  placeholder="家长" />	      		
	   		</div>
	  	</div>
	  	<div class="form-group">
	    	<label for="phone" class="col-sm-3 control-label">联系方式</label>
	    	<div class="col-sm-5">
	      		<input type="text" class="form-control" id="phone" name="phone"  placeholder="联系方式" />	      		
	   		</div>
	  	</div>
		<div class="form-group">
	    	<div class="col-sm-offset-3 col-sm-9">
	    		<button type="submit" class="btn btn-default" >提交</button>
	    	</div>
	  	</div>
	</form>
</div>