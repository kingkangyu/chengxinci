<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="橙心教育科技 kangyu" />
	<title>晚托班</title>
	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/homework.css'); ?>" rel="stylesheet">
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/homework.js'); ?>" type="text/javascript"></script>
	<script type="text/javascript" charset="utf-8" src="/assets/js/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/assets/js/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/assets/js/lang/zh-cn/zh-cn.js"></script>
</head>
<body>
	<div class="bg">
	</div>
	<!-- 网站头部导航 -->            
    <header class="navbar navbar-inverse navbar-fixed-top" role="banner">
	    <div class="container">
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-navbar-collapse">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <a href="/" class="navbar-brand">
	            	橙心教育
	            </a>
	        </div>
	        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
	            <ul class="nav navbar-nav">
	                <li>
                        <a href="" target="_self">主页</a>
                    </li>
                    <li>
                        <a href="" target="_self">课程</a>
                    </li>
                    <li>
                        <a href="" target="_self">晚托班</a>
                    </li>
                    <li>
                        <a href="" target="_self">关于橙心</a>
                    </li>
                    <li>
                        <a href="" target="_self">联系我们</a>
                    </li>
                </ul>
	            <?php if($this->session->userdata('login')=='adminok'){ ?>
	            <ul class="nav navbar-nav navbar-right">
	                <li>
	                    <a><?php echo $this->session->userdata('adminname'); ?></a>
	                </li>
	                <li>
	                    <a href="<?php echo base_url('admin/logout'); ?>" >登出</a>
	                </li>
	            </ul>
	            <?php } ?>
	        </nav>
	    </div>
    </header>