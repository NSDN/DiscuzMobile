<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: hotthread.php 29235 2012-03-30 04:19:18Z monkey $
 */
//note 帖子thread >> hotthread(热门主题) @ Discuz! X2.0

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

include_once 'misc.php';

class mobile_api {

	//note 程序模块执行前需要运行的代码
	function common() {
		global $_G;
		$perpage = 50;
		$start = $perpage * ($_G['page'] - 1);
		list($data, $lastupdate) = loadcache('mobile_hotthread');
		if(!$data || TIMESTAMP - $lastupdate > 43200) {
			$query = DB::query("SELECT tid, fid, author, authorid, dateline AS dbdateline, replies, lastpost AS dblastpost, lastposter, subject, attachment, views
				FROM ".DB::table('forum_thread')." WHERE heats>'0' AND displayorder>='0' ORDER BY lastpost DESC LIMIT 500");
			while($thread = DB::fetch($query)) {
				$thread['dateline'] = dgmdate($thread['dbdateline']);
				$thread['lastpost'] = dgmdate($thread['dblastpost']);
				$data[] = $thread;
			}
			save_syscache('mobile_hotthread', array($data, TIMESTAMP));
		}
		$data = array_slice($data, $start, $perpage, true);
		$variable = array(
			'data' => mobile_core::getvalues($data, array('/^.+?$/'),
				array('tid', 'fid', 'author', 'authorid', 'dbdateline', 'dateline', 'replies', 'dblastpost', 'lastpost', 'lastposter', 'subject', 'attachment', 'views')),
			'perpage' => $perpage,
		);
		mobile_core::result(mobile_core::variable($variable));
	}

	//note 程序模板输出前运行的代码
	function output() {
	}

}

?>