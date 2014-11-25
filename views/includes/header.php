<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>晚托班</title>
	<meta name="description" content="橙心教育是数名海归博士与前世界500强公司管理人员联合创办，旨在整合东北地区最优质的教育资源和前沿的先进信息技术，服务于中国教育领域。">
    <meta name="Keywords" content="橙心教育科技,橙心教育,晚托班,哈尔滨,橙心,教育,chengxin,培训">
    <meta name="author" content="橙心教育科技有限公司 kangyu" />
	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/homework.css'); ?>" rel="stylesheet">
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/js/homework.js'); ?>" type="text/javascript"></script>
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
			    <?php if($this->session->userdata('login')=='ok'){ ?>
	            <ul class="nav navbar-nav navbar-right">
	                <li>
	                    <a><?php echo $this->session->userdata('username'); ?></a>
	                </li>
	                <li>
	                    <a href="<?php echo base_url('index/logout'); ?>" >登出</a>
	                </li>
	            </ul>
	            <?php } ?>
	        </nav>
	    </div>
    </header>