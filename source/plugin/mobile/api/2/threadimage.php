<?php
/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
*      This is NOT a freeware, use is subject to license terms
*
*      $Id: forumimage.php 32061 2012-11-06 02:41:00Z zhangjie $
*/
//note ���ɻ�ȡ����ͼ

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

include_once 'forum.php';

class mobile_api {
	function common() {
		global $_G;
		if(!defined('IN_DISCUZ') || empty($_G['gp_aid']) || empty($_G['gp_size']) || empty($_G['gp_key'])) {
			header('location: '.$_G['siteurl'].'static/image/common/none.gif');
			exit;
		}

		$allowsize = array('960x960', '268x380', '360x640', '2000x2000');
		if(!in_array($_G['gp_size'], $allowsize)) {
			header('location: '.$_G['siteurl'].'static/image/common/none.gif');
			exit;
		}

		$nocache = !empty($_G['gp_nocache']) ? 1 : 0;
		$daid = intval($_G['gp_tid']);
		$type = !empty($_G['gp_type']) ? $_G['gp_type'] : 'fixwr';
		list($w, $h) = explode('x', $_G['gp_size']);
		$dw = intval($w);
		$dh = intval($h);
		$thumbfile = 'image/t_'.$daid.'_'.$dw.'_'.$dh.'.jpg';
		$parse = parse_url($_G['setting']['attachurl']);
		$attachurl = !isset($parse['host']) ? $_G['siteurl'].$_G['setting']['attachurl'] : $_G['setting']['attachurl'];
		if(!$nocache) {
			if(file_exists($_G['setting']['attachdir'].$thumbfile)) {
				dheader('location: '.$attachurl.$thumbfile);
			}
		}

		define('NOROBOT', TRUE);

		$id = !empty($_G['gp_atid']) ? $_G['gp_atid'] : $daid;
		if(md5($id.'|'.$dw.'|'.$dh) != $_G['gp_key']) {
			dheader('location: '.$_G['siteurl'].'static/image/common/none.gif');
		}

		if($attach = DB::fetch(DB::query("SELECT * FROM ".DB::table(getattachtablebytid($daid))." WHERE tid='$daid' AND isimage IN ('1', '-1')"))) {
			if(!$dw && !$dh && $attach['tid'] != $daid) {
			       dheader('location: '.$_G['siteurl'].'static/image/common/none.gif');
			}
			dheader('Expires: '.gmdate('D, d M Y H:i:s', TIMESTAMP + 3600).' GMT');
			if($attach['remote']) {
				$filename = $_G['setting']['ftp']['attachurl'].'forum/'.$attach['attachment'];
			} else {
				$filename = $_G['setting']['attachdir'].'forum/'.$attach['attachment'];
			}
			require_once libfile('class/image');
			$img = new image;
			if($img->Thumb($filename, $thumbfile, $w, $h, $type)) {
				if($nocache) {
					dheader('Content-Type: image');
					@readfile($_G['setting']['attachdir'].$thumbfile);
					@unlink($_G['setting']['attachdir'].$thumbfile);
				} else {
					dheader('location: '.$attachurl.$thumbfile);
				}
			} else {
				dheader('Content-Type: image');
				@readfile($filename);
			}
		}
		exit;
	}
}
?>