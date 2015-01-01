<?php

/**
 *      [Discuz!] (C)2001-2099 Comsenz Inc.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      $Id: mobile_extends_check.php 31282 2012-08-03 02:30:10Z zhangjie $
 */

class mobile_api {

	var $variable = array();

	//note 程序模块执行前需要运行的代码
	function common() {

		$this->variable = array(
			'extends' => array(
				'extendversion' => '1',
				'extendlist' => array(
					array(
						'identifier' => 'dz_newthread',
						'name' => lang('plugin/mobile', 'mobile_extend_newthread'),
						'icon' => '0',
						'islogin' => '0',
						'iconright' => '0',
						'redirect' => '',
					),
				),
			)
		);
	}
	
	//note 程序模板输出前运行的代码
	function output() {
		mobile_core::result(mobile_core::variable($this->variable));
	}
}
?>