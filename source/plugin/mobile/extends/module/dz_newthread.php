<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: dz_newthread.php 31282 2012-08-03 02:30:10Z zhangjie $
 */
class dz_newthread extends extends_data {

	function __construct() {
		parent::__construct();
	}

	function common() {
		global $_G;
		$this->page = intval($_GET['page']) ? intval($_GET['page']) : 1;
		loadcache('forum_guide');
		$dateline = 0;
		$maxnum = 50000;
		if($_G['setting']['guide']['newdt']) {
			$dateline = time() - intval($_G['setting']['guide']['newdt']);
		}
		$maxtid = DB::result_first("SELECT MAX(tid) as maxtid FROM ".DB::table('forum_thread'));
		$limittid = max(0,($maxtid - $maxnum));
		$tids = array_slice($_G['cache']['forum_guide']['new']['data'], ($this->page - 1)*$this->perpage ,$this->perpage);
		$tidsql = $addsql = '';
		if($tids) {
			$tidsql = implode(',', $tids);
		} else {
			$tidsql = 'tid>'.intval($limittid);
			if($dateline) {
				$addsql .= ' AND dateline > '.intval($dateline);
			}
			$addsql .= ' AND displayorder>=0 ORDER BY lastpost DESC LIMIT 600';
		}
		$threadlist = array();
		$query = DB::query("SELECT * FROM ".DB::table('forum_thread')." WHERE ".$tidsql.$addsql);
		while($thread = DB::fetch($query)) {
			$threadlist[] = $thread;
		}
		rsort($threadlist);

		foreach($threadlist as $thread) {
			$this->field('author', '0', $thread['author']);
			$this->field('dateline', '0', $thread['dateline']);
			$this->field('replies', '1', $thread['replies']);
			$this->field('views', '2', $thread['views']);
			$this->id = $thread['tid'];
			$this->title = $thread['subject'];
			$this->image = '';
			$this->icon = '1';
			$this->poptype = '0';
			$this->popvalue = '';
			$this->clicktype = 'tid';
			$this->clickvalue = $thread['tid'];

			$this->insertrow();
		}
	}
}
?>