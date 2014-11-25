
<!-- 登陆 -->
<div class="container">
	<form method="post" accept-charset="utf-8" action="<?php echo base_url('admin'); ?>" class="form-horizontal login" role="form" >
		<div class="form-group">
	    	<label for="username" class="col-sm-3 control-label">管理员</label>
	    	<div class="col-sm-9">
	      		<input type="text" class="form-control" id="username" name="username"  placeholder="管理员" />
	      		<?php if(isset($flag)&&$flag==-2) echo "<span class='notice'>*管理员不存在</span>"; ?>
	   		</div>
	  	</div>
	 	<div class="form-group">
	    	<label for="pass" class="col-sm-3 control-label">密码</label>
	    	<div class="col-sm-9">
	      		<input type="password" class="form-control" id="pass" name="pass" placeholder="密码" />
	      		<?php if(isset($flag)&&$flag==-1) echo "<span class='notice'>*密码错误</span>" ; ?>
	   		</div>
	  	</div>
		<div class="form-group">
	    	<div class="col-sm-offset-3 col-sm-9">
	    		<button type="submit" class="btn btn-default" >登陆</button>
	    	</div>
	  	</div>
	</form>
</div>
