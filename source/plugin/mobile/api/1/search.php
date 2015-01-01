<?php

/*
 * created by oxyflour
 *
 */

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

include_once 'search.php';

class mobile_api {

	//note 程序模块执行前需要运行的代码
	function common() {
	}

	//note 程序模板输出前运行的代码
	function output() {
		global $_G;
		$variable = array(
			'threadlist' => $GLOBALS['threadlist'],
			'count' => $GLOBALS['index']['num'],
		);
		mobile_core::result(mobile_core::variable($variable));
	}

}

?>
