<?php


namespace limb\app\form;

use limb\app\worker as Worker;
use limb\app\base\control as Control;

require "../../autoload.php";

	class FormRoute extends FormBase
	{

		private $result;

		function __construct($name_form, $data)
		{
			parent::__construct($data);

			if(!isset($_SESSION)) session_start();

			if($this -> controlHtml == 2){
				if(isset($data['code']) && isset($_SESSION['csrf'])){
					$csrf = $_SESSION['csrf'];
					$csrf_site = $this -> data['code'];
					if($csrf == $csrf_site)
					{
						$this -> routeF($name_form);
					}
				}
			}
			else
			{
				$this -> routeF($name_form);
			}

			
		}

		private function routeF($name_form)
		{
			if($name_form == "connect")
			{
				
				$this -> result = $this -> tab_newIni();// перезаписывает db.ini возвращает либо true Либо false
				
			}
			elseif($name_form == 'importBD')
			{
				$this -> result = $this -> ImportBD();
			}
			elseif($name_form == 'newFields')
			{
				$this -> newRandomFields();
			}
			elseif($name_form == 'newTable')
			{
				$worker_i = new Worker\LogicTable($this -> data);
				$this -> result .= $worker_i -> CreateTable();//создаем таблицу

				if( $worker_i -> getResult() === true)
				{
					$parametr = $worker_i -> getParametr();//получаем массив данных [table_name, tmplt, replace]
					$masterClass = new Worker\MasterClass($parametr[0], $parametr[1], $parametr[2], $parametr[3], $parametr[4]);
					$this -> result .= $masterClass -> addTablePageCl();#возвращает успех или нет
				}
			}
			elseif($name_form == 'redTable')
			{
				$worker_i = new Worker\LogicTable($this -> data);
				

				Control\Necessary::delete_table($this -> data["name_table"]);
				
				$this -> result .= $worker_i -> CreateTable();//создаем таблицу
				
				if( $worker_i -> getResult() === true)
				{
					$parametr = $worker_i -> getParametr();//получаем массив данных [table_name, tmplt, replace]
					$masterClass = new Worker\MasterClass($parametr[0], $parametr[1], $parametr[2], $parametr[3], $parametr[4]);
					$this -> result .= $masterClass -> addTablePageCl();#возвращает успех или нет
				}
			}
			elseif($name_form == "add_article")
			{
				$this -> result = $this -> addArticle();

			}
			elseif($name_form == "red_menu")
			{
				$this -> result = $this -> redMenu();
			}
			elseif($name_form == "red_article")
			{
				$this -> result = $this -> redArticle();

			}
		}


		public function result()
		{
			return $this -> result;
		}
	}

	
	if(isset($_POST))
	{
		if(count($_FILES) !== 0)
		{
			$ff = new FormFile($_FILES);
			$names = $ff -> getNames();
			$post_files = array_merge($names, $_POST);
		}
		else{
			$post_files = $_POST;
		}
		$fRoute = new FormRoute($_POST["nameForm"], $post_files);//вход данных и их обработка
		session_start();
		$_SESSION["message"] = $fRoute -> result();
		
		header('Location: '.$_SERVER['HTTP_REFERER']);
		exit();
	}

?>