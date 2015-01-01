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
	if (preg_match("/\[img[^\]]*\]([^\[]+)\[\/img\]/", $message, $matches))
		return $matches[1];
	return '';
}

class mobile_api {
	function common() {
		global $_G;
		$tid = intval($_G['gp_tid']);

		if ($tid > 0) {
			$query = DB::query("SELECT message FROM ".DB::table('forum_post')." WHERE tid='$tid' LIMIT 5");
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

				/*
				 * Note: disabled
				 *
				if (!empty($src = getFirstImageSrc($message))) {
					header('location: '.$src);
					exit;
				}
				*/
			}
		}

		header('location: '.$_G['siteurl'].'static/image/common/none.gif');
		exit;

	}
}
?>