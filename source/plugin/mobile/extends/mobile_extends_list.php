<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: mobile_extends_list.php 31282 2012-08-03 02:30:10Z zhangjie $
 */

class mobile_api {

	public $extendsclass;
	public $modulelist;

	//note ����ģ��ִ��ǰ��Ҫ���еĴ���
	function common() {

		$this->modulelist = array('dz_newthread');
		if(!in_array($_GET['identifier'], $this->modulelist)) {
			mobile_core::result(array('error' => 'identifier_not_exists'));
		}
		include_once 'source/plugin/mobile/extends/mobile_extends_data.php';
		$extendsfilename = "./source/plugin/mobile/extends/module/".$_GET['identifier'].".php";
		if(empty($_GET['identifier'])) {
			mobile_core::result(array('error' => 'identifier_not_exists'));
		} else if(!file_exists($extendsfilename)) {
			mobile_core::result(array('error' => 'identifier_file_not_exists'));
		} else {
			require_once $extendsfilename;
			if(!class_exists($_GET['identifier'])) {
				mobile_core::result(array('error' => 'identifier_file_not_exists'));
			}
			$this->extendsclass = new $_GET['identifier'];
			if(method_exists($this->extendsclass, 'common')) {
				$this->extendsclass->common();
			}
		}

	}

	//note ����ģ�����ǰ���еĴ���
	function output() {
		$variable = $this->extendsclass->output();
		mobile_core::result(mobile_core::variable($variable));
	}
}

?>