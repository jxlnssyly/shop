<?php

/**
 * 后台首页相关控制器类
 */
class IndexController extends PlatformController {

	public function index() {
		include CURRENT_VIEW_PATH . 'index.html';
	}

	public function top() {
		include CURRENT_VIEW_PATH . 'top.html';
	}

	public function menu() {
		include CURRENT_VIEW_PATH . 'menu.html';

	}

	public function main() {
		include CURRENT_VIEW_PATH . 'main.html';

	}

	public function drag() {
		include CURRENT_VIEW_PATH . 'drag.html';

	}
}
