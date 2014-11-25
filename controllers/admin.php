<?php
//======================================================================
//
//        Copyright (C) 2014 橙心教育科技
//        All rights reserved
//
//        created by kangyu at 2014/11
//        edit by kangyu
//
//======================================================================
class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();

	}
	//登陆
	public function index()
	{
		if($this->session->userdata('login')=='adminok'){
			redirect('admin/show');
		}
		$post=$this->input->post();
		if($post===false){
			// 没有表单
		}
		else
		{
			// print_r($post);
			$this->load->model("Homework");
			$data=$this->Homework->get_admin($post['username'],$post['pass']);
			if ($data===false) 
			{
				$erro['flag']='-2';
			}
			else if($data==-1)
			{
				$erro['flag']='-1';
			}
			else
			{
				$sion = array(
                   'login'  => 'adminok',
                   'adminname' => $post['username'],
               	);
               	$this->session->set_userdata($sion);
				$this->load->helper('url');
				redirect('admin/show');
			}
		}
		if(isset($erro))
		{
			$this->load->view("includes/headeradmin",$erro);
			$this->load->view("admin/login");
			$this->load->view("includes/footer");
		}
		else
		{
			$this->load->view("includes/headeradmin");
			$this->load->view("admin/login");
			$this->load->view("includes/footer");
		}
		// $this->load->model("Homework");
		// $data=$this->Homework->get_row();
		
		// // print_r($data);
		// $this->load->view("homework",$data);
	}
	// 登入主页面
	public function show()
	{
		// $this->output->enable_profiler(TRUE);
		if($this->session->userdata('login')!='adminok'){
			redirect('admin');
		}
		$time=time();
		$month=date('n',$time);
		$day=date('d',$time);
		$data['month']=(int)$month;
		$data['day']=(int)$day;
		$post=$this->input->post();
		if($post===false)
		{
			// 没有表单
			$this->load->model('Homework');
			$stu=$this->Homework->get_stu_array();
			$school=$this->Homework->get_school_array();
			$teacher=$this->Homework->get_teacher_array();
			$data['stu']=$stu;
			$data['school']=$school;
			$data['teacher']=$teacher;
			$this->load->view("includes/headeradmin",$data);
			$this->load->view("admin/show");
			$this->load->view("includes/footer");
		}
		else
		{
			if($post['month']!=NULL&&$post['day']!=NULL&&$post['content']!=NULL)
			{
				// echo "month".$post['month'];
				$this->load->model("Homework");
				$time = time();
            	$year = date('Y',$time);
				$date=date($year.'-'.$post['month'].'-'.$post['day']);
				$data=$this->Homework->insert_attend($post['stuid'],$post['teacherid'],$post['content'],$date);
				$this->load->view("includes/headeradmin",$data);
				$this->load->view("admin/success");
				$this->load->view("includes/footer");
			}
			else
			{
				$this->load->view("includes/headeradmin");
				$this->load->view("admin/erro");
				$this->load->view("includes/footer");
			}			
		}			
	}
	// 编辑学生作业
	public function edit()
	{
		if($this->session->userdata('login')!='adminok'){
			redirect('admin');
		}
		$post=$this->input->post();
		if($post===false)
		{
			// 没有表单
			$this->load->model('Homework');
			$stu=$this->Homework->get_stu_array();
			$stu_id=$stu[0]['id'];
			$list=$this->Homework->get_attend_list_edit($stu_id);
			if(!empty($list)&&isset($list[0]['id']))
           	{
           		$attend_id=$list[0]['id'];
           	}			
			//session写入
			$sion = array(
               'stuidtoedit'  => $stu_id,
           	);
           	if(isset($attend_id))
           	{
           		$sion['datetoedit']  = $attend_id;
           		$work=$this->Homework->get_work_byattendid($attend_id);//有作业表
           		$data['work']=$work;//赋值$data
           	}
			$this->session->set_userdata($sion);
			// print_r($sion);
			//设置$data数组传值
			$data['stu']=$stu;
			$data['list']=$list;		
			$this->load->view("includes/headeradmin",$data);
			$this->load->view("admin/edit");
			$this->load->view("includes/footer");
		}
		else
		{//有表单
			if($this->session->userdata('stuidtoedit')!=$post['stuid'])
			{//stuid更改 优先级最高
				$stu_id=$post['stuid'];
               	$this->load->model('Homework');
				$stu=$this->Homework->get_stu_array();
				$list=$this->Homework->get_attend_list_edit($stu_id);
				if(!empty($list)&&isset($list[0]['id']))
	           	{
	           		$attend_id=$list[0]['id'];
	           	}
	           	else
	           	{
	           		$this->session->unset_userdata('datetoedit');//没有date列表 清空date session
	           	}
				//session写入
				$sion = array(
                   'stuidtoedit'  => $stu_id,
               	);
               	if(isset($attend_id))
               	{
               		$sion['datetoedit'] =$attend_id;
               		$work=$this->Homework->get_work_byattendid($attend_id);
               		$data['work']=$work;
               		$data['defaultdate']=$attend_id;
               	}
				$this->session->set_userdata($sion);
				// print_r($sion);
				//设置$data数组传值				
				$data['stu']=$stu;
				$data['list']=$list;				
				$data['defaultid']=$stu_id;			
				$this->load->view("includes/headeradmin",$data);
				$this->load->view("admin/edit");
				$this->load->view("includes/footer");
               	
			}
			else if($this->session->userdata('datetoedit')!=$post['date'])
			{//日期更改 优先级其次
				$stu_id=$this->session->userdata('stuidtoedit');
               	$this->load->model('Homework');
				$stu=$this->Homework->get_stu_array();
				$list=$this->Homework->get_attend_list_edit($stu_id);
				$attend_id=$post['date'];				
				//session写入
				$sion = array(
                   'stuidtoedit'  => $stu_id,
               	);
               	if(isset($attend_id))
               	{
               		$sion['datetoedit'] =$attend_id;
               		$work=$this->Homework->get_work_byattendid($attend_id);//有作业表
           			$data['work']=$work;//赋值$data
           			$data['defaultdate']=$attend_id;
               	}
				$this->session->set_userdata($sion);
				// print_r($sion);
				//设置$data数组传值				
				$data['stu']=$stu;
				$data['list']=$list;				
				$data['defaultid']=$stu_id;				
				$this->load->view("includes/headeradmin",$data);
				$this->load->view("admin/edit");
				$this->load->view("includes/footer");
			}
			else// if($this->session->userdata('stuidtoedit')==$post['stuid']&&$this->session->userdata('datetoedit')==$post['date'])
			{//提交 写入数据库 销毁date stuid session
				$attend_id=$post['date'];
				$work=$post['work'];
				if(isset($attend_id))
               	{
               		$this->load->model('Homework');
					$stu=$this->Homework->edit_work_byattendid($attend_id,$work);
					$this->load->view("includes/headeradmin");
					$this->load->view("admin/success");
					$this->load->view("includes/footer");
               	}
               	else
               	{
               		$this->load->view("includes/headeradmin");
					$this->load->view("admin/erro");
					$this->load->view("includes/footer");
               	}
               	$this->session->unset_userdata('stuidtoedit');
               	$this->session->unset_userdata('datetoedit');
			}
			
		}
	}
	// 新建学生信息
	public function newstu()
	{
		// $this->output->enable_profiler(TRUE);
		if($this->session->userdata('login')!='adminok'){
			redirect('admin');
		}
		$post=$this->input->post();
		if($post===false)
		{
			$this->load->model('Homework');
			$school=$this->Homework->get_school_array();
			$data['school']=$school;
			$this->load->view("includes/headeradmin",$data);
			$this->load->view("admin/newstu");
			$this->load->view("includes/footer");
		}
		else
		{
			if($post['name']!=NULL&&$post['sex']!=NULL&&$post['school_id']!=NULL)
			{
				$this->load->model('Homework');
				$config['upload_path'] = './assets/img/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['encrypt_name'] = 'TRUE';
				
				// $config['max_size'] = '100';
				// $config['max_width']  = '1024';
				// $config['max_height']  = '768';
				$this->load->library('upload', $config);
				// $this->upload->do_upload();
				if ( ! $this->upload->do_upload())
				{
					$this->Homework->insert_stu($post);
					$this->load->view("includes/headeradmin");
					$this->load->view("admin/success");
					$this->load->view("includes/footer");
				} 
				else
				{
					$imgname=$this->upload->data();
                    $post['img']=$imgname['file_name'];
					$this->Homework->insert_stu($post);
					$this->load->view("includes/headeradmin");
					$this->load->view("admin/success");
					$this->load->view("includes/footer");
					
				}
				
			}
			else
			{
				$this->load->view("includes/headeradmin");
				$this->load->view("admin/erro");
				$this->load->view("includes/footer");
			}			
		}		
	}
	// 新建登录用户
	public function newuser()
	{
		if($this->session->userdata('login')!='adminok'){
			redirect('admin');
		}
		$post=$this->input->post();
		if($post===false)
		{
			$this->load->model('Homework');
			$stu=$this->Homework->get_stu_nouser();
			$data['stu']=$stu;
			$this->load->view("includes/headeradmin",$data);
			$this->load->view("admin/newuser");
			$this->load->view("includes/footer");
		}
		else
		{
			if($post['name']!=NULL&&$post['pass']!=NULL&&$post['stuid']!=NULL)
			{
				$this->load->model('Homework');
				$flag=$this->Homework->insert_user($post['name'],$post['pass'],$post['stuid']);
				if($flag==false)
				{
					$data['flag']=$flag;
					$this->load->model('Homework');
					$stu=$this->Homework->get_stu_nouser();
					$data['stu']=$stu;
					$this->load->view("includes/headeradmin",$data);
					$this->load->view("admin/newuser");
					$this->load->view("includes/footer");
				}
				else
				{
					$this->load->view("includes/headeradmin");
					$this->load->view("admin/success");
					$this->load->view("includes/footer");
				}
			}
			else
			{
				$this->load->view("includes/headeradmin");
				$this->load->view("admin/erro");
				$this->load->view("includes/footer");
			}
		}
	}
	// 新建学校
	public function newschool()
	{
		// $this->output->enable_profiler(TRUE);
		if($this->session->userdata('login')!='adminok'){
			redirect('admin');
		}
		$post=$this->input->post();
		if($post===false)
		{
			$this->load->model('Homework');
		
			$this->load->view("includes/headeradmin");
			$this->load->view("admin/newschool");
			$this->load->view("includes/footer");
		}
		else
		{
			if($post['name']!=NULL)
			{
				$this->load->model('Homework');
				$this->Homework->insert_school($post);
				$this->load->view("includes/headeradmin");
				$this->load->view("admin/success");
				$this->load->view("includes/footer");
			}
			else
			{
				$this->load->view("includes/headeradmin");
				$this->load->view("admin/erro");
				$this->load->view("includes/footer");
			}			
		}					
	}
	// 新建教师
	public function newteacher()
	{
		// $this->output->enable_profiler(TRUE);
		if($this->session->userdata('login')!='adminok'){
			redirect('admin');
		}
		
		$post=$this->input->post();
		if($post===false)
		{
			$this->load->model('Homework');
		
			$this->load->view("includes/headeradmin");
			$this->load->view("admin/newteacher");
			$this->load->view("includes/footer");
		}
		else
		{
			if($post['name']!=NULL)
			{
				$this->load->model('Homework');
				$this->Homework->insert_teacher($post);
				$this->load->view("includes/headeradmin");
				$this->load->view("admin/success");
				$this->load->view("includes/footer");
			}
			else
			{
				$this->load->view("includes/headeradmin");
				$this->load->view("admin/erro");
				$this->load->view("includes/footer");
			}			
		}		
	}
	// 登出
	public function logout()
	{
		// $this->output->enable_profiler(TRUE);
		$this->session->sess_destroy();		
		redirect('admin');
	}
}
/* End of file admin.php */
/* Location: ./application/controllers/admin.php */