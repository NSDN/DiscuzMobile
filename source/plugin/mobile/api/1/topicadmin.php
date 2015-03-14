<?php

/*
 * created by oxyflour
 *
 */

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

$_GET['mod'] = 'topicadmin';
$_GET['modsubmit'] = 'yes';
//$_GET['action'] = 'moderate';
//$_GET['moderate[]'] = tid;
//$_GET['fid'] = fid;
//$_GET['infloat'] = 'yes';
//$_GET['inajax'] = '1';

include_once 'forum.php';

class mobile_api {

	//note 程序模块执行前需要运行的代码
	function common() {
	}

	function post_mobile_message($message, $url_forward, $values, $extraparam, $custom) {
	}

	//note 程序模板输出前运行的代码
	function output() {
		global $_G;

		$variable = array(
		);
		mobile_core::result(mobile_core::variable($variable));
	}

}

?>
