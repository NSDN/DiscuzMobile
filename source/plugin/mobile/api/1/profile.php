<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: profile.php 34314 2014-02-20 01:04:24Z nemohou $
 */

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

$_GET['mod'] = 'space';
// @oxyflour
$_GET['do'] = isset($_GET['do']) ? $_GET['do'] : 'profile';
include_once 'home.php';

class mobile_api {

	function common() {
	}

	function output() {
		global $_G;
		$data = $GLOBALS['space'];
		unset($data['password'], $data['email'], $data['regip'], $data['lastip'], $data['regip_loc'], $data['lastip_loc']);
		$variable = array(
			'list' => $GLOBALS['list'],
			'space' => $data,
			'extcredits' => $_G['setting']['extcredits'],
			'prompt_number' => $_G['member']['newprompt_num'],
			'notice_number' => $_G['member']['category_num'],
		);
		mobile_core::result(mobile_core::variable($variable));
	}

}

?>