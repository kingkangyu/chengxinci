$tok=strtok($keyword," ");
		   			switch ($tok) {
		   				case '作业':
		   					$tok=strtok(" ");
		   					$content_str='你输入的是作业:'.$tok;
							$result_str = sprintf($text_tpl, $from_username, $to_username, $time, $msg_type, $content_str);
							echo $result_str;
		   					break;
		   				
		   				default:
		   					$content_str='输入不正确';
							$result_str = sprintf($text_tpl, $from_username, $to_username, $time, $msg_type, $content_str);
							echo $result_str;
		   					break;
		   			}