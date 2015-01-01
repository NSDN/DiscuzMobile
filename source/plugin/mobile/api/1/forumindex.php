<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: forumindex.php 27783 2012-02-14 07:45:05Z monkey $
 */
//note ���forum >> forumindex(ȫ�����) @ Discuz! X2.0

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

$_GET['mod'] = 'index';
include_once 'forum.php';

class mobile_api {

	//note ����ģ��ִ��ǰ��Ҫ���еĴ���
	function common() {
	}

	//note ����ģ�����ǰ���еĴ���
	function output() {
		global $_G;
		$variable = array(
			'member_email' => $_G['member']['email'],
			'member_credits' => $_G['member']['credits'],
			'setting_bbclosed' => $_G['setting']['bbclosed'],
			'group' => mobile_core::getvalues($_G['group'], array('groupid', 'grouptitle', '/^allow.+?$/')),
			'catlist' => array_values(mobile_core::getvalues($GLOBALS['catlist'], array('/^\d+$/'), array('fid', 'name', 'forums'))),
			// 'icon' is added by oxyflour to support board icons
			'forumlist' => array_values(mobile_core::getvalues($GLOBALS['forumlist'], array('/^\d+$/'), array('fid', 'name', 'threads', 'posts', 'redirect', 'todayposts', 'description', 'icon'))),
		);
		mobile_core::result(mobile_core::variable($variable));
	}

}

?>