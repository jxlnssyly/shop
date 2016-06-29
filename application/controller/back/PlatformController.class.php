<?php

class PlatformController extends Controller {

	public function __construct() {

		$this -> _initSession();

		$this -> _checkSignin();
	}

	/*
	*初始化session
	*/
	protected function _initSession() {
        new SessionDB;
	}

	/**
	*验证后台管理员是否登录
	*/
	protected function _checkSignin() {
		// 特例数组
		$no_check = array(
				'admin' => array('login','signin'),
				// 控制器 => 动作
			);

		if (isset($no_check[CONTROLLER]) && in_array(ACTION, $no_check[CONTROLLER])) {
			return ;
		}

		//判断当前是否登录
		if (!isset($_SESSION['admin'])) {
			//没有登录
			$this->_jump('index.php?p=back&c=admin&a=login');
		}
	}

}
