<?php

/*
 * created by oxyflour
 * 2014.12.13
 */

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

$_GET['mod'] = 'misc';
$_GET['action'] = 'commentmore';
//$_GET['tid'] = '48';
//$_GET['pid'] = '79';
//$_GET['page'] = '2';
$_GET['inajax'] = '1';
//$_GET['ajaxtarget'] = 'comment_79';

include_once 'forum.php';

class mobile_api {

	//note 程序模块执行前需要运行的代码
	function common() {
	}

	//note 程序模板输出前运行的代码
	function output() {
		global $_G;

		$variable = array(
			'comments' => $GLOBALS['comments'],
			'count' => $GLOBALS['count'],
		);
		mobile_core::result(mobile_core::variable($variable));
	}

}
?>
