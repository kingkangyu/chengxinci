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
class Calendar extends CI_Controller {

	function __construct()
	{
		parent::__construct();

	}
	public function index()
	{
		$prefs = array (
			 	'show_next_prev'  => TRUE,
               'next_prev_url'   => '/calendar/index',
               'template'        => '

				   {table_open}<table class="table" border="0" cellpadding="0" cellspacing="0">{/table_open}

				   {heading_row_start}<tr>{/heading_row_start}

				   {heading_previous_cell}<th><a href="{previous_url}" id="previousurl">&lt;&lt;</a></th>{/heading_previous_cell}
				   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
				   {heading_next_cell}<th><a href="{next_url}" id="nexturl">&gt;&gt;</a></th>{/heading_next_cell}

				   {heading_row_end}</tr>{/heading_row_end}

				   {week_row_start}<tr>{/week_row_start}
				   {week_day_cell}<td>{week_day}</td>{/week_day_cell}
				   {week_row_end}</tr>{/week_row_end}

				   {cal_row_start}<tr>{/cal_row_start}
				   {cal_cell_start}<td>{/cal_cell_start}

				   {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
				   {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

				   {cal_cell_no_content}{day}{/cal_cell_no_content}
				   {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

				   {cal_cell_blank}&nbsp;{/cal_cell_blank}

				   {cal_cell_end}</td>{/cal_cell_end}
				   {cal_row_end}</tr>{/cal_row_end}

				   {table_close}</table>{/table_close}
				'
             );
		$this->load->library('calendar', $prefs);
		
		// print_r($list);
		
		if( $this->uri->segment(4) == NULL)
		{
			$month=date('n',time());
			$ar=$this->get_date_array($month);
		}
		else
		{
			$month=$this->uri->segment(4);
			// echo "month:".$month;			
			$ar=$this->get_date_array($month);
		}

		if($this->uri->segment(4)!=NULL)
		{
			$this->session->set_userdata('current_month',$month);
		}
		else if($this->session->userdata('current_month')!=NULL)
		{
			$month=$this->session->userdata('current_month');
			$ar=$this->get_date_array($month);
		}
		if($ar!=NULL){
			// print_r($ar);
			$month=$this->session->userdata('current_month')!=NULL?$this->session->userdata('current_month'):$this->uri->segment(4);
			$data['calendar']=$this->calendar->generate($this->uri->segment(3),$month,$ar);
		}
		else
		{
			$data['calendar']=$this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));	
		}
		
		// $data['calendar']=$this->calendar->generate($month,$day,$ar);

		$this->load->view("calendar",$data);
	}
	private function get_date_array($month,$stu_id='1'){
		$this->load->model("Homework");
		$stu_id=$this->session->userdata('stu_id');
		$list=$this->Homework->get_attend_time_list($stu_id);
		if (array_key_exists($month,$list))
		{
			foreach ($list[$month] as $value) 
			{
			// $ar[$value]="base_url('')";
			$url="index/show/".$month."/".$value;
			$ar[$value]=site_url($url);
			}
			return $ar;	
		}
		else
		{
			return NULL;
		}			
	}
}
/* End of file calendar.php */
/* Location: ./application/controllers/calendar.php */