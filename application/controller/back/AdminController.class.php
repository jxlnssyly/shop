<?php
/**
 * 管理员管理控制器类
 */
class AdminController extends PlatformController {

	/**
	 * 登录表单的展示
	 */
	public function login() {
		//不需要数据

		//展示登录表单模板即可
		include CURRENT_VIEW_PATH . 'login.html';
	}

	/**
	 * 验证管理员信息是否正确
	 */
	public function signin() {
		header('Content-Type: text/html; charset=utf-8');
		//收集表单数据
		$admin_name = $_POST['username'];
		$admin_pass = $_POST['password'];

		//调用模型，完成数据的验证
		$model_admin = new AdminModel;
		if ($admin_info = $model_admin->check($admin_name, $admin_pass)) {
			//合法
			//设置登录凭证
			//$is_login = 'yes';
			new SessionDB;
			// $_SESSION['is_login'] = 'yes';
			$_SESSION['admin'] = $admin_info;

			// setCookie('is_login', 'yes', time()+3600);
//			echo '管理员合法';
			$this->_jump('index.php?p=back&c=index&a=index');
		} else {
			echo '2';
			//非法
			$this->_jump('index.php?p=back&c=admin&a=login', '管理员用户名或密码错误', 3);
		}
	}
}
