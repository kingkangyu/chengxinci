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
define("TOKEN", "chengxin");
define("DOMAIN", "http://homework.chengxin10000.com");
class Weixin extends CI_Controller {
	function __construct()
	{
		parent::__construct();

	}
	public function index(){

		if(true){
			//get post data, May be due to the different environments
			$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

	      	//extract post data
			if (!empty($postStr)){
	                
	              	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
	                $open_id = $postObj->FromUserName;
	                $me = $postObj->ToUserName;
	                $type = $postObj->MsgType;
	                $keyword = trim($postObj->Content);
	                $time = time();
	                $text_tpl = "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[%s]]></MsgType>
								<Content><![CDATA[%s]]></Content>
								<FuncFlag>0</FuncFlag>
								</xml>";             
					$msg_type = "text";
					$news_tpl_head="<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[news]]></MsgType>";
					$news_tpl_count="<ArticleCount>%s</ArticleCount>";
					$news_tpl_article="<Articles>";
					$news_tpl_itemhead="<item>
								<Title><![CDATA[%s]]></Title>
								</item>";
					$news_tple_picurl="<item>
								<Title><![CDATA[点击查看图片]]></Title>
								<PicUrl><![CDATA[%s]]></PicUrl>
								<Url><![CDATA[%s]]></Url>
								</item>";
					$news_tpl_end="</Articles>
									</xml>";
					// var_dump($open_id);
					// var_dump($me);
					// var_dump($keyword);
					if(!empty( $keyword ))
					{
						$this->load->model('Homework');
						$tflag=$this->Homework->teacher_oidexist($open_id);//是否为教师
						$sflag=$this->Homework->stu_oidexist($open_id);//是否为学生
						// echo "flag";
						// var_dump($tflag);
						// var_dump($sflag);
						if($tflag||$sflag)
						{
							if($tflag)
							{
								$tok=strtok($keyword," ");
								switch ($tok) {
					   				case '查询':
					   					$name=strtok(" ");
					   					$work=$this->Homework->get_stu_work($name);
					   					if($work)
					   					{
					   						$time=strtotime($work['work_time']);
					   						$work_time=date('m月d日',$time);
					   						$content_str=$work_time."的作业:\n".strip_tags($work['work']);
											$result_str = sprintf($text_tpl, $open_id, $me, $time, $msg_type, $content_str);
											echo $result_str;
					   					}
					   					else
					   					{
					   						$content_str='无内容';
											$result_str = sprintf($text_tpl, $open_id, $me, $time, $msg_type, $content_str);
											echo $result_str;
					   					}
					   					break;				   				
					   				default:
					   					$content_str='教师已注册,输入不正确';
					   					$content_str.="\n              菜单";
					   					$content_str.="\n1-输入 查询(空格)学生姓名 查询当天的作业内容";
										$result_str = sprintf($text_tpl, $open_id, $me, $time, $msg_type, $content_str);
										echo $result_str;
					   					break;
					   			}
							}
							else if($sflag)
							{
								if($type=="text")
								{//家长发送文本信息
									$tok=strtok($keyword," ");
									switch ($tok) {
						   				case '作业':
						   					$work=trim(substr($keyword, 6));
						   					$this->Homework->insert_work($sflag,$work);
						   					$content_str="作业记录成功:\n".$work;
											$result_str = sprintf($text_tpl, $open_id, $me, $time, $msg_type, $content_str);
											echo $result_str;
						   					break;
					   					case '查询':
						   					$work=strtok(" ");
						   					// echo "sflag".$sflag."\n";				   					
						   					$work_content=$this->Homework->get_stu_hascontent($sflag);
						   					// print_r($work_content);
						   					if(empty($work_content))
						   					{//没有检测到该学生的辅导信息 时间设置为当前
						   						$time=time();//取当前时间戳
							   					$work_time=date('m月d日',$time);
							   					$title=$work_time."教师的辅导内容";
						   					}
						   					else
						   					{//检测到该学生的辅导信息
						   						$time=strtotime($work_content['work_time']);
							   					$work_time=date('m月d日',$time);
							   					$title=$work_time."教师的辅导内容";
						   					}
						   					
											// $result_str = sprintf($text_tpl, $open_id, $me, $time, $msg_type, $content_str);
											// echo $result_str;

											//news头信息
					   						$news_tpl_head=sprintf($news_tpl_head,$open_id, $me, $time);
					   						//acount信息
					   						$count=substr_count($work_content['content'],"src=");
											$news_tpl_count=sprintf($news_tpl_count,($count+2));
											//itemhead
											$description=strip_tags($work_content['content']);
											$itemhead=sprintf($news_tpl_itemhead,$title);
											if($description!=NULL)
												$itemhead.=sprintf($news_tpl_itemhead,"教师评语:\n".$description);
											else
												$itemhead.=sprintf($news_tpl_itemhead,"教师评语未更新。\n");
											//PicUrl信息
											
											$imgsrc=$this->get_imgsrc_array($work_content['content'],$count);
											$picurl="";
											if(isset($imgsrc))
											{
												foreach ($imgsrc as  $value) {
													$picurl.=sprintf($news_tple_picurl,$value,$value);
												}
											}
											
											// echo "pic".$picurl."\n";
											//输出xml
											echo $news_tpl_head.$news_tpl_count.$news_tpl_article.$itemhead.$picurl.$news_tpl_end;
						   					break;					   				
						   				default:
						   					$content_str='学生已注册,输入错误,请重新输入';
						   					$content_str.="\n              菜单";
						   					$content_str.="\n1-输入 作业(空格)作业内容 增加当天的作业内容";
						   					$content_str.="\n2-输入 查询 查询最新的教师辅导内容";
											$result_str = sprintf($text_tpl, $open_id, $me, $time, $msg_type, $content_str);
											echo $result_str;
						   					break;
						   			}
						   		}
						   		else
						   		{//家长发送图片信息 无接口 没法开发
						   			
						   			$picurl = $postObj->PicUrl;

						   		}
					   			//发送邮件
					   			$stu_row=$this->Homework->get_stu_row($sflag);
					   			$mail=$this->Homework->get_mail_array();
					   			foreach ($mail as $value) {
					   				$to      = $value;
									$subject = $stu_row['name'].'的新消息回复';
									$message = $keyword;
									mail($to, $subject, $message);
									// echo $to;
					   			}
							}
						}
						else
						{
							//既不是教师也不是学生，注册
							$tok=strtok($keyword," ");
							switch ($tok) {
				   				case '姓名':
				   					$name=strtok(" ");
				   					$this->Homework->insert_stuoid($open_id,$name);
				   					$content_str='已注册学生:'.$name;
									$result_str = sprintf($text_tpl, $open_id, $me, $time, $msg_type, $content_str);
									echo $result_str;
				   					break;
			   					case 'chengxin':
				   					$name=strtok(" ");
				   					$this->Homework->insert_teacheroid($open_id,$name);
				   					$content_str='已注册教师:'.$name;
									$result_str = sprintf($text_tpl, $open_id, $me, $time, $msg_type, $content_str);
									echo $result_str;
				   					break;				   				
				   				default:
				   					$content_str='您未注册,输入不正确';
				   					$content_str.="\n              菜单";
				   					$content_str.="\n1-输入 姓名(空格)学生姓名 进行系统注册";
									$result_str = sprintf($text_tpl, $open_id, $me, $time, $msg_type, $content_str);
									echo $result_str;
				   					break;
				   			}
				   			$mail=$this->Homework->get_mail_array();
				   			foreach ($mail as $value) {
				   				$to      = $value;
								$subject = '未注册者的新消息回复';
								$message = $keyword;
								mail($to, $subject, $message);
								// echo $to;
				   			}
							// echo "运行到未注册了";
						}
			   		}
			   		else
			   		{//欢迎语
						$content_str='感谢关注橙心教育';
						// echo $content_str;
						$result_str = sprintf($text_tpl, $open_id, $me, $time, $msg_type, $content_str);
						echo $result_str;
			   		}

	        }else {
	        	echo "";
	        	exit;
	        }
		}
	}
	private function get_imgsrc_array($img,$count)
	{
		$start=0;
		// echo "count".$count."\n";
		// echo "img".$img."\n";
		for($i=0;$i<$count;$i++)
		{
			$imgstart=strpos($img,"src=\"",$start)+5;
			$imgend=strpos($img,"\"",$imgstart);
			$imglen=$imgend-$imgstart;
			$imgname[]=DOMAIN.substr($img,$imgstart,$imglen);
			$start=$imgend;

		}
		if(isset($imgname))
			return $imgname;
		else
			return;
	}
}
/* End of file weixin.php */
/* Location: ./application/controllers/weixin.php */
