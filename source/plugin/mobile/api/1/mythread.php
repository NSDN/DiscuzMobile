<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: mythread.php 27783 2012-02-14 07:45:05Z monkey $
 */
//note 帖子thread >> mythread(我的帖子) @ Discuz! X2.0

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

$_GET['mod'] = 'space';
$_GET['view'] = 'me';
$_GET['do'] = 'thread';
include_once 'home.php';

class mobile_api {

	//note 程序模块执行前需要运行的代码
	function common() {
	}

	//note 程序模板输出前运行的代码
	function output() {
		global $_G;
		$variable = array(
			'data' => array_values(mobile_core::getvalues($GLOBALS['list'], array('/^.+?$/'),
				array('tid', 'fid', 'author', 'authorid', 'dbdateline', 'dateline', 'replies', 'dblastpost', 'lastpost', 'lastposter', 'subject', 'attachment', 'views'))),
			'perpage' => $GLOBALS['perpage'],
			'hiddennum' => $GLOBALS['hiddennum'],
		);
		mobile_core::result(mobile_core::variable($variable));
	}

}

?>