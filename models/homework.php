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
class Homework extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        parent::__construct();     
    }
    /**
     *验证用户是否合法
     * 
     * @param $user_name string 用户名
     * @param $user_pass string 密码
     * @return  false or user表id
     */
    function get_user($user_name,$user_pass='')
    {
        $this->db->where('name', $user_name);
        $this->db->limit(1);
        $query = $this->db->get('user');
        if($query->num_rows()>0){
           $row = $query->row_array();
           if($row['pass']==sha1($user_pass))
           {
                return $row['stu_id'];
           }
           return -1;//密码错误
        }
        return false;//用户名不存在
    }
    function insert_user($user_name,$user_pass='',$stu_id)
    {
        $this->db->where('name', $user_name);
        $this->db->limit(1);
        $query = $this->db->get('user');
        if($query->num_rows()>0){
           return false;
        }
        else
        {
            $user=array(
                'name' => $user_name,
                'stu_id' => $stu_id,
                'pass' => sha1($user_pass),
            );
            $query = $this->db->insert('user',$user);
            return true;
        }      
    }
    /**
     *验证管理员是否合法
     * 
     * @param $admin_name string 管理员
     * @param $admin_pass string 密码
     * @return  false or user表id
     */
    function get_admin($admin_name,$admin_pass='')
    {
        $this->db->where('name', $admin_name);
        $this->db->limit(1);
        $query = $this->db->get('admin');
        if($query->num_rows()>0){
           $row = $query->row_array();
           if($row['pass']==sha1($admin_pass))
           {
                return 1;
           }
           return -1;//密码错误
        }
        return false;//管理员不存在
    }
    /**
     *根据id获取一条学生信息
     * 
     * @param $id int 学生id
     * @return  array 
     */
    function get_stu_row($id='1')
    {
        // $this->load->database();
        $this->db->where('id', $id); 
        $query = $this->db->get('stu');
        $row = $query->row_array();
        if( $row['sex'] == '0')
        {
            $row['sex']="男";
        }
        else {
            $row['sex']="女";
        }
        return $row;
    }
    /**
     *根据姓名获取学生id
     * 
     * @param $name string 学生姓名
     * @return  int of false
     */
    function get_stu_id($name)
    {
        // $this->load->database();
        $this->db->where('name', $name); 
        $query = $this->db->get('stu');        
        if($query->num_rows()>0){
            $row = $query->row_array();
            return $row['id'];
        }
        else
        {
            return false;
        }
        
    }
    function insert_stu($post)
    {
        
        $this->db->insert('stu', $post); 
    }
    /**
     *获取所有学生姓名及相应id
     * 
     *
     * @return  array 学生id name数组
     */
    function get_stu_array()
    {
        // $this->load->database();
        $query = $this->db->get('stu');
        $result = $query->result_array();
        foreach ($result as $key => $value) {
            $stu[$key]['name']=$value['name'];
            $stu[$key]['id']=$value['id'];
        }
        return $stu;
    }
    function get_stu_nouser()
    {
        // $this->load->database();
        $query_user = $this->db->get('user');
        $result_user = $query_user->result_array();
        foreach ($result_user as $key => $value) {
            $user[]=(int)$result_user[$key]['stu_id'];
        }

        foreach ($user as  $value) {
            $this->db->where('id !=',$value);
        }
        $query = $this->db->get('stu');
        $result = $query->result_array();
        foreach ($result as $key => $value) {
            $stu[$key]['name']=$value['name'];
            $stu[$key]['id']=$value['id'];
        }
        return $stu;
    }
    /**
     *获取所有学校及相应id
     * 
     *
     * @return  array 学校id name数组
     */
    function get_school_array()
    {
        // $this->load->database();
        $query = $this->db->get('school');
        $result = $query->result_array();
        foreach ($result as $key => $value) {
            $school[$key]['name']=$value['name'];
            $school[$key]['id']=$value['id'];
        }
        return $school;
    }
    /**
     *获取所有教师及相应id
     * 
     *
     * @return  array 教师id name数组
     */
    function get_teacher_array()
    {
        // $this->load->database();
        $query = $this->db->get('teacher');
        $result = $query->result_array();
        foreach ($result as $key => $value) {
            $teacher[$key]['name']=$value['name'];
            $teacher[$key]['id']=$value['id'];
        }
        return $teacher;
    }
    /**
     *获取辅导信息表
     * 
     * @param $stu_id int 学生id
     * @return  array 
     */
    function get_attend_row($stu_id)
    {
        $this->db->where('id', $stu_id); 
        $query = $this->db->get('attend');
        $row = $query->row_array();
        return $row;
    }
    /**
     *获取最新一条的辅导信息attend记录
     * 
     * @param $stu_id int 学生id
     * @return  array 
     */
    function get_last_attend_row($stu_id){
        $this->db->where('stu_id', $stu_id); 
        $this->db->order_by("work_time", "desc");
        $this->db->limit(1); 
        $query = $this->db->get('attend');
        $row = $query->row_array();
        if($row){
            // echo "attend";
            // print_r($row);
        }
        else
        {
            // echo "attend null";
            // echo "stu_id:".$stu_id;
        }
        return $row;
    }
    /**
     *获取特定日期的辅导信息attend记录
     * 
     * @param $stu_id int 学生表id
     * @param $month int 月份
     * @param $day int 日期
     * @return  array or false
     */
    function get_date_attend_row($stu_id,$month,$day){
        $this->db->where('stu_id', $stu_id); 
        $this->db->order_by("work_time", "desc");
        $query = $this->db->get('attend');
        if($query->num_rows>0)
        {
            $row = $query->result_array();
            foreach ($row as $key => $value) 
            {
                $time=strtotime($value['work_time']);
                $time_day=date('d',$time);
                $time_month=date('n',$time);
                if($month==$time_month&&$day==$time_day)
                {
                    return $value;
                }
            }
        }
        return false;
        
        // if($row){
        //     // echo "attend";
        //     // print_r($row);
        // }
        // else
        // {
        //     echo "attend null";
        //     // echo "stu_id:".$stu_id;
        // }
        return $row;
    }
    function insert_attend($stu_id,$teacher_id,$content,$date)
    {
        $month=$this->string_to_month($date);
        $day=$this->string_to_day($date);
        // echo "month".$month." day".$day;
        $this->db->where('stu_id',$stu_id);
        $query=$this->db->get('attend');
        $result=$query->result_array();
        $flag=0;
        foreach ($result as $key => $value) {
            $work_time=$result[$key]['work_time'];
            // echo $this->string_to_month($date);
            // echo $this->string_to_day($date);
            if($month==$this->string_to_month($work_time)&&$day==$this->string_to_day($work_time))
            {//存在当月当日该学生的记录
                $flag=1;
                $attend_id=$result[$key]['id'];
                // echo "attendid".$attend_id;
                break;
            }
        }
        if($flag==1)
        {
            $this->db->where('stu_id',$stu_id);
            $data = array(
               'teacher_id' => $teacher_id ,
               'content' => $content ,
            );
            $this->db->update('attend', $data); 
        }
        else
        {
          $data = array(
               'stu_id' => $stu_id ,
               'teacher_id' => $teacher_id ,
               'content' => $content ,
               'work_time' => $date
            );
        $this->db->insert('attend', $data);   
        }
        
    }
    /**
     *根据attend中teacher_id返回教师名字
     * 
     * @param $teacher_id int 教师id
     * @return  array
     */
    function get_teacher_row($teacher_id)
    {
        $this->db->where('id', $teacher_id); 
        $query = $this->db->get('teacher');
        $row = $query->row_array();
        if($row){
           // echo "teacher";
           //  print_r($row); 
        }
        else
        {
            // echo "teacher null";
            // echo "teacher_id:".$teacher_id;
        }
        
        return $row;
    }
    /**
     *根据attend中school_id返回教师名字
     * 
     * @param $school_id int 学校id
     * @return  array
     */
    function get_school_row($school_id)
    {
        $this->db->where('id', $school_id); 
        $query = $this->db->get('school');
        $row = $query->row_array();
        if($row){
            // echo "school";
            // print_r($row);
        }
        else
        {
            // echo "shcool null";
            // echo "school_id:".$school_id;
        }
        
        return $row;
    }
    function insert_school($post)
    {
       $this->db->insert('school',$post);
    }
    function insert_teacher($post)
    {
       $this->db->insert('teacher',$post);
    }
    /**
     *获取学生最新的一行辅导信息
     * 
     * @param $id int 学生表id
     * @return  array 学生信息二维数组
     */
    function get_row($id='1'){
        $stu_row = $this->get_stu_row($id);
        $school = $this->get_school_row($stu_row['school_id']);

        $last_attend_row = $this->get_last_attend_row($stu_row['id']);

        $teacher = $this->get_teacher_row($last_attend_row['teacher_id']);
        $row = array_merge($stu_row,$last_attend_row);
        $row['school'] = $school['name'];
        $row['teacher'] = $teacher['name'];
        if($row['img']==NULL){
            if($row['sex']=='女'){
                $row['img']='girl.jpg';
            }
            else
            {
                $row['img']='boy.jpg';
            }
        }
        if($row){
            // echo "row";
            // print_r($row);
        }
        else
        {
            // echo "row null";
        }
        return $row;
    }
    /**
     *获取学生特定日期辅导信息
     * 
     * @param $stu_id int 学生表id
     * @param $month int 月份
     * @param $day int 日期
     * @return  array 学生信息二维数组 or false
     */
    function get_date_row($stu_id,$month,$day)
    {
        $stu_row = $this->get_stu_row($stu_id);
        $school = $this->get_school_row($stu_row['school_id']);

        $attend_row = $this->get_date_attend_row($stu_row['id'],$month,$day);

        $teacher = $this->get_teacher_row($attend_row['teacher_id']);
        $row = array_merge($stu_row,$attend_row);
        $row['school'] = $school['name'];
        if(isset($teacher['name']))
        {
            $row['teacher'] = $teacher['name'];
        }
        else
        {
            $row['teacher'] = '';
        }
        if($row['img']==NULL){
            if($row['sex']=='女'){
                $row['img']='girl.jpg';
            }
            else
            {
                $row['img']='boy.jpg';
            }
        }
        if($row){
            // echo "row";
            // print_r($row);
        }
        else
        {
            // echo "row null";
        }
        return $row;
    }
    /**
     *获取学生出勤日期 日历用
     * 
     * @param $stu_id int 学生id
     * @return  array 依据月份分类的三维数组
     */
    function get_attend_time_list($stu_id) {
        $this->db->where('stu_id', $stu_id);
        $this->db->select('work_time'); 
        $this->db->order_by("work_time","desc");
        $query = $this->db->get('attend');
        $row = $query->result_array();
        // print_r($row);
        foreach ($row as $key => $value) {
            $time=strtotime($row[$key]['work_time']);
            // $date=date('d',$time);
            // $month=date('n',$time);
            $date=date('j',$time);
            $month=date('m',$time);
            // echo "attendtimmonth".$month;
            $list[$month][]=$date;          
            // $row[$key]['work_time']=$date;
        }
        // echo "attendlist";
        // print_r($list);
        return $list;
    }
    /**
     *获取学生出勤日期 编辑用
     * 
     * @param $stu_id int 学生id
     * @return  attend_id为key日期为值二维数组
     */
    function get_attend_list_edit($stu_id='1') {
        $this->db->where('stu_id', $stu_id);
        $this->db->where('work is not null');
        $this->db->order_by("work_time", "desc");
        $query=$this->db->get('attend');
        $row = $query->result_array();
        //print_r($row);
        foreach ($row as $key => $value) {
            $attend_id=$row[$key]['id'];
            $time=strtotime($row[$key]['work_time']);
            // $date=date('d',$time);
            // $month=date('n',$time);
            $day=date('j',$time);
            $month=date('m',$time);
            $date=$month.'月'.$day.'日';
            // echo "attendtimmonth".$month;
            $list[$key]['date']=$date;
            $list[$key]['id']=$attend_id;          
            // $row[$key]['work_time']=$day;
        }
        if(!empty($list))
            return $list;
        else
            return;
    }
//wechat
    /**
     *教师open_id是否存在
     * 
     * @param $oid 教师open_id
     * @return  id or false
     */
    function teacher_oidexist($oid)
    {
        $this->db->where('open_id', (string)$oid);
        $this->db->limit(1);
        $query = $this->db->get('teacher');
        if($query->num_rows()>0){
            $row = $query->row_array(); 
            return $row['id'];//教师存在
        }
        return false;//教师不存在
    }
    /**
     *学生open_id是否存在
     * 
     * @param $oid 学生open_id
     * @return  id or false
     */
    function stu_oidexist($oid)
    {
        $this->db->where('open_id', (string)$oid);
        $this->db->limit(1);
        $query = $this->db->get('stu');
        if($query->num_rows()>0){
            // echo "exit";
            $row = $query->row_array(); 
            return $row['id'];//学生存在
        }
        else
        {
            // echo "noexit";
        }
        return false;//学生不存在
    }
    /**
     *插入学生open_id
     * 
     * @param $oid  学生open_id
     * @param $name 学生姓名
     * @return  true or false
     */
    function insert_stuoid($oid,$name)
    {
        $this->db->where('open_id', (string)$oid);
        $this->db->limit(1);
        $query = $this->db->get('stu');
        if($query->num_rows()>0){
           return flase;//学生openid存在，不能插入
        }
        else
        {
            //open_id不存在           
            $this->db->where('name', $name);
            $this->db->limit(1);
            $query = $this->db->get('stu');
            if($query->num_rows()>0){//姓名存在，并且open_id未注册
               $stu=array(
                    'open_id' => (string)$oid,
                );
                $this->db->where('name', $name);
                $this->db->update('stu',$stu);
                return true;//姓名存在,更新open_id成功
            }
            else
            {//姓名不存在存在，并且open_id未注册
                $stu=array(
                    'name' => $name,
                    'open_id' => (string)$oid,
                );
                $this->db->insert('stu',$stu);
                return true;//学生不存在,插入成功
            }
            
        }       
    }
    /**
     *插入教师open_id
     * 
     * @param $oid  教师open_id
     * @param $name 教师姓名
     * @return  true or false
     */
    function insert_teacheroid($oid,$name)
    {
        $this->db->where('open_id', (string)$oid);
        $this->db->limit(1);
        $query = $this->db->get('teacher');
        if($query->num_rows()>0){
           return flase;//教师openid存在，不能插入
        }
        else
        {
            //open_id不存在
            $this->db->where('name', $name);
            $this->db->limit(1);
            $query = $this->db->get('teacher');
            if($query->num_rows()>0){//姓名存在，并且open_id未注册
               $stu=array(
                    'open_id' => (string)$oid,
                );
                $this->db->where('name', $name);
                $this->db->update('teacher',$stu);
                return true;//姓名存在,更新open_id成功
            }
            else
            {//姓名不存在存在，并且open_id未注册
                $stu=array(
                    'name' => $name,
                    'open_id' => (string)$oid,
                );
                $this->db->insert('teacher',$stu);
                return true;//教师不存在,插入成功
            }
            
        }       
    }
    /**
     *插入学生作业
     * 
     * @param $stu_id  学生id
     * @param $work 作业内容
     * @return  true or false
     */
    function insert_work($stu_id,$content)
    {
        $month=$this->get_now_month();
        $day=$this->get_now_day();
        // echo "month".$month." day".$day;
        $this->db->where('stu_id',$stu_id);
        $query=$this->db->get('attend');
        $result=$query->result_array();
        $flag=0;
        foreach ($result as $key => $value) {
            $date=$result[$key]['work_time'];
            // echo $this->string_to_month($date);
            // echo $this->string_to_day($date);
            if($month==$this->string_to_month($date)&&$day==$this->string_to_day($date))
            {//存在当月当日该学生的记录
                $flag=1;
                $attend_id=$result[$key]['id'];
                // echo "attendid".$attend_id;
                break;
            }
        }
        if($flag==1)
        {//存在当月当日该学生的记录
            $this->db->where('id',$attend_id);
            $query=$this->db->get('attend');
            $row=$query->row_array();
            $row['work'].=" (添加) ".$content;
            $work=array(
                    'work' => (string)$row['work'],
                );
            $this->db->where('id',$attend_id);
            $query=$this->db->update('attend',$work);
            return true;      
        }
        else
        {//不存在该月改日的学生记录
            $row['work']=$content;
            //只能在2014使用
            $time = time();
            $year = date('Y',$time);
            $date=date($year.'-'.$month.'-'.$day);
            $work=array(
                    'stu_id' => $stu_id,
                    'work' => (string)$row['work'],
                    'work_time' => $date,
                );
            $query=$this->db->insert('attend',$work);
            return true;      
        }
    }
    /**
     *教师查询学生作业
     * 
     * @param $name  学生姓名
     * @return  最新一条内容 or false
     */
    function get_stu_work($name)
    {
        $stu_id=$this->get_stu_id($name);
        // echo "stuid".$stu_id;
        if($stu_id)
        {
            $row=$this->get_last_attend_row($stu_id);
            // var_dump($row);
            return $row;
        }
        else
        {
            return false;
        }
    }
    /**
     *根据stuid查询学生作业辅导信息
     * 
     * @param $stu_id  学生id
     * @return  作业辅导信息 or false
     */
    function get_stu_content($stu_id)
    {
        if($stu_id)
        {
            $row=$this->get_last_attend_row($stu_id);
            // var_dump($row);
            return $row;
        }
        else
        {
            return false;
        }
    }
    /**
     *家长查询学生辅导信息
     * 
     * @param $stu_id  学生id
     * @return  作业辅导信息 or false
     */
    function get_stu_hascontent($stu_id)
    {
        $this->db->where('stu_id', $stu_id);
        $this->db->where('content is not null');
        $this->db->order_by("work_time", "desc");
        $this->db->limit(1);
        $query=$this->db->get('attend');
        // $sql="
        // SELECT *
        // FROM (`attend`)
        // WHERE `stu_id` =  '".$stu_id."'
        // AND `content` is not null 
        // ORDER BY `work_time` desc
        // LIMIT 1";
        // $query = $this->db->query($sql);
        $row = $query->row_array();
        // echo "row\n";
        // print_r($row);
        if(!empty($row))
            return $row;
        else
            return;
    }
    /**
     *教师根据attend查询学生作业信息
     * 
     * @param $attend_id  id
     * @return  作业辅导信息 or false
     */
    function get_work_byattendid($attend_id)
    {
        $this->db->where('id', $attend_id);
        $this->db->limit(1);
        $query=$this->db->get('attend');
        $row = $query->row_array();
        if(!empty($row))
            return $row['work'];
        else
            return;
    }
    /**
     *教师根据attend编辑学生作业信息
     * 
     * @param $attend_id  id
     * @param $work  作业
     * @return  true or false
     */
    function edit_work_byattendid($attend_id,$work)
    {
        $this->db->where('id', $attend_id);
        $this->db->limit(1);
        $data=array(
            'work' => $work,
            );
        $query=$this->db->update('attend',$data);
        $afrow=$this->db->affected_rows();
        if($afrow>0)
            return true;
        else
            return false;

    }
    /**
     *获取mail表内容
     * 
     * @return  array
     */
    function get_mail_array()
    {
        $query=$this->db->get('mail');
        $result=$query->result_array();
        foreach ($result as $key => $value) {
            $mail[]=$result[$key]['mail'];
        }
        return $mail;
    }
//time function
    /**
     *获取当前月份
     * 
     */
    function get_now_month()
    {
        $time = time();
        return date('n',$time);
    }
    /**
     *获取当前第几日
     * 
     */
    function get_now_day()
    {
        $time = time();
        return date('d',$time);
    }
    /**
     *将规范格式转化为月份
     * 
     */
    function string_to_month($date)
    {
        $time=strtotime($date);
        return date('n',$time);
    }
    /**
     *将规范格式转化为第几日
     * 
     */
    function string_to_day($date)
    {
        $time=strtotime($date);
        return date('d',$time);
    }

}
/* End of file homework.php */
/* Location: ./application/models/homework.php */