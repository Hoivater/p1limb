<?php
	
namespace limb\code\site;
use limb\app\base as Base;

	/**
	 * Сборка неизменяемой части страницы
	 */
	class StaticPage extends StaticTable
	{
		use tPage;

		private $control;
		private $html_static_page;// собранный итого код неизменяемой части страницы
		private $setting;

		function __construct()
		{
			// session_start();
			// if(isset($_SESSION['connect'])) unset($_SESSION['connect']);
			$this -> html = file_get_contents(__DIR__."/../../view/public/layouts/main.tm");

			$this -> control = new Base\control\Control();

			$this -> controlConnectDB();

			$this -> setting = parse_ini_file('setting.ini');

			$connect = $_SESSION['connect'];

			
			$auth = Base\Control\Control::IsRules();
			$this -> html_static_page = $this -> Limb($auth);

		}


		public function controlConnectDB()
		{
			$error_connection = $this -> control -> ConnectDB();//проверка возможности подключения к бд, при незаполненном возвращается текст описания ошибки, при положительном  = true

			// session_start();
			if($error_connection === true)
			{
				$_SESSION['connect'] = "<h5 class='m-3' style='color:green;'>Соединение с бд установлено</h5>";
			}
			else{
				$_SESSION['connect'] = "<h5 class='m-3' >Невозможно подключиться к базе данных:<small style='color:red;'>".$error_connection."<br />Проверьте соответствие пользователя</small></h5>";
			}

			}


		public function getStaticPage()
		{
			return $this -> html_static_page;
		}
	}


?>