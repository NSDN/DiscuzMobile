<?php

/*
 * created by oxyflour
 *
 */

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

$_GET['mod'] = 'post';
$_GET['action'] = 'edit';
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
			'typeid' => $GLOBALS['thread']['typeid'],
			'postinfo' => $GLOBALS['postinfo'],
		);
		mobile_core::result(mobile_core::variable($variable));
	}

}

?>