<?php

/*
 * created by oxyflour
 */

if(!defined('IN_MOBILE_API')) {
	exit('Access Denied');
}

include_once 'forum.php';

function getAttachmentThumbUrl($aid) {
	global $_G;
	$w = 268;
	$h = 380;
	$k = md5($aid.'|'.$w.'|'.$h);
	return $_G['siteurl'].'api/mobile/index.php?version=2&module=forumimage&'.
		'size='.$w.'x'.$h.'&aid='.$aid.'&key='.$k;
}

function getAttachmentThumbFile($aid) {
	$w = 268;
	$h = 380;
	return 'image/'.$aid.'_'.$w.'_'.$h.'.jpg';
}

function getAttachmentUrl() {
	global $_G;
	$parse = parse_url($_G['setting']['attachurl']);
	return !isset($parse['host']) ? $_G['siteurl'].$_G['setting']['attachurl'] : $_G['setting']['attachurl'];
}

function getFirstAttachmentId($message) {
	if (preg_match("/\[attach\](\d+)\[\/attach\]/", $message, $matches))
		return intval($matches[1]);
	return 0;
}

function getFirstImageSrc($message) {
	if (preg_match("/\[img[^\]]*\]([^\[]+)\[\/img\]/", $message, $matches)) {
		$src = $matches[1];
		$parse = parse_url($src);
		// Note: www.nyasama.com is the image server
		if ($parse['host'] == 'www.nyasama.com')
			return $src.'.thumb.'.pathinfo($src, PATHINFO_EXTENSION);
	}
	return '';
}

class mobile_api {
	function common() {
		global $_G;
		$tid = intval($_G['gp_tid']);

		if ($tid > 0) {
			$query = DB::query("SELECT message FROM ".DB::table('forum_post')." WHERE tid='$tid' ORDER BY pid LIMIT 5");
			while ($post = DB::fetch($query)) {
				$message = $post['message'];

				if (($aid = getFirstAttachmentId($message)) > 0) {
					$thumbfile = getAttachmentThumbFile($aid);
					if(file_exists($_G['setting']['attachdir'].$thumbfile)) {
						dheader('location: '.getAttachmentUrl().$thumbfile);
					}
					else {
						header('location: '.getAttachmentThumbUrl($aid));
					}
					exit;
				}

				if (($src = getFirstImageSrc($message)) != '') {
					header('location: '.$src);
					exit;
				}
			}
		}

		header("HTTP/1.0 404 Not Found");
		exit;
	}
}
?>