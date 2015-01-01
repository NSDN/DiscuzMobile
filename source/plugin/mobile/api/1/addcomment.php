<?php

/*
 * created by oxyflour
 * 2014.11.23
 */

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

$_GET['mod'] = 'post';
$_GET['action'] = 'reply';
$_GET['comment'] = 'yes';
//$_GET['tid'] = tid;
//$_GET['pid'] = pid;
//$_GET['extra'] = 'page=1';
//$_GET['page'] = '1';
$_GET['commentsubmit'] = 'yes';
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
