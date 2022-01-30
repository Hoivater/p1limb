<?php


namespace limb\app\form;

use limb\app\worker as Worker;
use limb\app\base\control as Control;
require "../../autoload.php";

	class FormPublicRoute extends FormBasePublic
	{

		private $result;

		function __construct($name_form, $data)
		{
			parent::__construct($data);
			
			$this -> routeF($name_form);
		}

		private function routeF($name_form)
		{
			if($name_form == "connect")
			{
				
				#ваш код, возможно отсылка к formBasePublic
				#$this -> result = ....;#сообщение о выполнении формы(например: успех или нет)
			}
			elseif($name_form == 'importBD')
			{
				#code
			}

		}


		public function result()
		{
			return $this -> result;
		}
	}

	
	if(isset($_POST))
	{
		$fRoute = new FormRoute($_POST["nameForm"], $_POST);//вход данных и их обработка
		session_start();
		$_SESSION["message"] = $fRoute -> result();
		
		header('Location: '.$_SERVER['HTTP_REFERER']);
	}

?>