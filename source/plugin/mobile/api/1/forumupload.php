<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: forumupload.php 27783 2012-02-14 07:45:05Z monkey $
 */
//note ���forum >> forumupload(����б�) @ Discuz! X2.0

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

$_GET['mod'] = 'swfupload';
$_GET['action'] = 'swfupload';
$_GET['operation'] = 'upload';
include_once 'misc.php';

class mobile_api {

	//note ����ģ��ִ��ǰ��Ҫ���еĴ���
	function common() {}

	//note ����ģ�����ǰ���еĴ���
	function output() {}

}

?>