<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: login.php 27783 2012-02-14 07:45:05Z monkey $
 */
//note ����more >> login(��¼) @ Discuz! X2.0

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

$_GET['mod'] = 'logging';
$_GET['action'] = 'login';
include_once 'member.php';

class mobile_api {

	//note ����ģ��ִ��ǰ��Ҫ���еĴ���
	function common() {
	}

	//note ����ģ�����ǰ���еĴ���
	function output() {
		global $_G;
		$variable = array();
		mobile_core::result(mobile_core::variable($variable));
	}

}

?>