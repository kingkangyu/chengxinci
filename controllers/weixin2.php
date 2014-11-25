<?php
define("TOKEN", "chengxin");
class Weixin extends CI_Controller {
	function __construct()
	{
		parent::__construct();

	}
	public function index(){
        if($this->check_signature()){
			$post_str = $GLOBALS["HTTP_RAW_POST_DATA"];
		// if(true){
		// 		$post_str =	"<xml>
		// 				 <ToUserName><![CDATA[toUser]]></ToUserName>
		// 				 <FromUserName><![CDATA[fromUser]]></FromUserName> 
		// 				 <CreateTime>1348831860</CreateTime>
		// 				 <MsgType><![CDATA[text]]></MsgType>
		// 				 <Content><![CDATA[this is a test]]></Content>
		// 				 <MsgId>1234567890123456</MsgId>
		// 				 </xml>";
			if (!empty($post_str)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
              	$post_obj = simplexml_load_string($post_str, 'SimpleXMLElement', LIBXML_NOCDATA);
                $open_id = $post_obj->FromUserName;
                $me = $post_obj->ToUserName;
                $keyword = trim($post_obj->Content);
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
				if(!empty( $keyword ))
				{
					$tflag=teacher_oidexist("open_id");//是否为教师
					$sflag=stu_oidexist("open_id");//是否为学生
					if($tflag||$sflag)
					{
						$content_str='开发测试';
						// echo $content_str;
						$result_str = sprintf($text_tpl, $open_id, $me, $time, $msg_type, $content_str);
						echo $result_str;
					}
					else
					{
						//既不是教师也不是学生，注册
						$this->load->model('Homework');
						$this->Homework->insert_stuoid($open_id,$keyword);
						$content_str='你输入的是作业:'.$keyword;
						// echo $content_str;
						$result_str = sprintf($text_tpl, $open_id, $me, $time, $msg_type, $content_str);
						echo $result_str;
					}
		   		}
		   		else
		   		{
					$content_str='啥也没收到';
					// echo $content_str;
					$result_str = sprintf($text_tpl, $open_id, $me, $time, $msg_type, $content_str);
					echo $result_str;
		   		}
	        }
	        else {
	        	echo "";
	        	exit;
	        }
        }
	}
	private function check_signature()
	{
        $signature = $this->input->get('signature');
        $timestamp = $this->input->get('timestamp');
        $nonce = $this->input->get('nonce');	
        		
		$token = TOKEN ;
		$tmp_arr = array($token, $timestamp, $nonce);
		sort($tmp_arr);
		$tmp_str = implode( $tmp_arr );
		$tmp_str = sha1( $tmp_str );
		
		if( $tmp_str == $signature ){
			return true;
		}else{
			return false;
		}
	}
}
