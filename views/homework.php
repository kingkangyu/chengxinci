
	<!-- 网站内容 -->
	<div class="container">
		<div class="row information">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<img src="<?php echo base_url("assets/img/".$img); ?>" class="img-thumbnail photo" />
			</div>
			<div class="col-lg-offset-1 col-lg-8 col-md-offset-1 col-md-8 col-sm-offset-1 col-sm-8 col-xs-12">
				<table class="table table-striped">
					<tbody>
						<tr>
							<td>姓名</td>
							<td><?php echo $name; ?></td>
						</tr>
						<tr>
							<td>姓别</td>
							<td><?php echo $sex; ?></td>
						</tr>
						<tr>
							<td>年龄</td>
							<td><?php echo $age; ?></td>
						</tr>
						<tr>
							<td>年级</td>
							<td><?php echo $grade; ?></td>
						</tr>
						<tr>
							<td>班级</td>
							<td><?php echo $class; ?></td>
						</tr>
						<tr>
							<td>学校</td>
							<td><?php echo $school; ?></td>
						</tr>
						<tr>
							<td>住址</td>
							<td><?php echo $address; ?></td>
						</tr>
						<tr>
							<td>家长</td>
							<td><?php echo $parent; ?></td>
						</tr>
						<tr>
							<td>联系方式</td>
							<td><?php echo $phone; ?></td>
						</tr>
						<tr>
							<td>值班教师</td>
							<td><?php echo $teacher; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="row performance">
			<div class="attendance col-lg-3 col-md-4 col-sm-4 col-xs-12">
				<h3 class="page-header text-primary">出勤</h3>
				<div class="calendar" id="calendar">
					<!-- <iframe src="<?php echo base_url('calendar/index'); ?>"></iframe> -->
				</div>
			</div>
			<div class="workcontent col-lg-offset-1 col-lg-8  col-md-8 col-sm-8 col-xs-12">
				<h3 class="page-header text-primary">作业单</h3>
				<div class="comment">
					<p><?php echo $work; ?></p>
				</div>
				<h3 class="page-header text-primary">辅导内容</h3>
				<div class="comment">
					<p><?php echo $content; ?></p>
				</div>
			</div>
		</div>
	</div>
