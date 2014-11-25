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
class Index extends CI_Controller {

	function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		// $this->output->enable_profiler(TRUE);
		if($this->session->userdata('login')=='ok'){
			redirect('index/show');
		}
		$post=$this->input->post();
		if($post===false){
			// 没有表单
		}
		else
		{
			// print_r($post);
			$this->load->model("Homework");
			$data=$this->Homework->get_user($post['username'],$post['pass']);
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
                   'login'  => 'ok',
                   'username' => $post['username'],
                   'stu_id' => $data
               	);
               	$this->session->set_userdata($sion);
				$this->load->helper('url');
				redirect('index/show');
			}
		}
		if(isset($erro))
		{
			$this->load->view("includes/header",$erro);
			$this->load->view("login");
			$this->load->view("includes/footer");
		}
		else
		{
			$this->load->view("includes/header");
			$this->load->view("login");
			$this->load->view("includes/footer");
		}
		
		// $this->load->model("Homework");
		// $data=$this->Homework->get_row();
		
		// // print_r($data);
		// $this->load->view("homework",$data);
	}
	public function show()
	{
		// $this->output->enable_profiler(TRUE);
		if($this->session->userdata('login')!='ok'){
			redirect();
		}
		$stu_id=$this->session->userdata('stu_id');
		// $this->load->view("login");
		$this->load->model("Homework");
		if($this->uri->segment(3)!=NULL&&$this->uri->segment(4)!=NULL)//如果传入日期参数
		{
			$month=$this->uri->segment(3);
			$day=$this->uri->segment(4);
			$data=$this->Homework->get_date_row($stu_id,$month,$day);		
			// print_r($data);
			// print_r($data);
			$this->load->view("includes/header",$data);
			$this->load->view("homework");
			$this->load->view("includes/footer");
		}
		else//默认进入
		{			
			$data=$this->Homework->get_row($stu_id);		
			// print_r($data);
			$this->load->view("includes/header",$data);
			$this->load->view("homework");
			$this->load->view("includes/footer");
		}
		
	}
	public function logout()
	{
		// $this->output->enable_profiler(TRUE);
		$this->session->sess_destroy();		
		redirect();
	}
}
/* End of file index.php */
/* Location: ./application/controllers/index.php */