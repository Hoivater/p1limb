<?php
namespace limb\app\web;

use limb\code\limb as Limb;
use limb\code\site as LimbSite;

use limb\app\base\control as Control;

use limb\app\modules as Modules;

class Route
{
	private $html;
	private $route_array;//содержит массив имен пути
	private $get;//содержит массив полученный методом GET
	private $auth;//содержит авторизацию


	function __construct($requestUri)
	{
		$requestUri = strtok($requestUri, '?');
		$this -> auth = Control\Control::IsRules();
		
		if(isset($_GET))
		{
			$this -> get = $_GET;
		}
		$arr = explode('/', $requestUri);
		$new_arr = array_diff($arr, array(''));
		$this -> route_array = array_values($new_arr);
		
		session_start();

		if(isset($_SESSION["numpage"])){
			unset($_SESSION["numpage"]);
			if(isset($this -> get["page"]))
				$_SESSION['numpage'] = $this -> get["page"];
			else{
				$_SESSION['numpage'] = 1;
			}
		}

		else
		{
			if(isset($this -> get["page"]))
				{
					$_SESSION['numpage'] = $this -> get["page"];
				}
			else{
				$_SESSION['numpage'] = 1;
			}
		}
		$this -> routeLimb();#Limb работа с таблицами
		// $this -> routePublicLimb(); #ваш проект

	}

	private function routePublicLimb()
	{
		$route_arr = $this -> route_array;

		if(count($route_arr) >= 1)
		{
				if($route_arr[0] == "article")
				{
					if(isset($route_arr[1])){
						#вывод определенной статьи
					}
					else
					{
						#вывод главной страницы

					}

				}
				
				#модуль регистрации
				elseif($route_arr[0] == "destructauth")
				{
					setcookie("code", '', -1);
					setcookie("email", '', -1);
					header("Location:/");				
				}
				elseif($route_arr[0] == "registration")
				{
					$html = new Modules\Auth\AuthPage(false);
					$html -> Registration();				
				}
				elseif($route_arr[0] == "auth")
				{
					if(isset($route_arr[1])){
						if($route_arr[1] == "newpassword"){
							$html = new Modules\Auth\AuthPage(false);
							$html -> NewPassword();	
						}
						else
						{
							$html = new Modules\Auth\AuthPage(false);
							$html -> Auth();					
						}
					}
					else
					{
						$html = new Modules\Auth\AuthPage(false);
						$html -> Auth();					
					}	
				}
				#модуль регистрации


				else
				{
					$html = new LimbSite\MainPage();				
				}
		}
		else{
			$html = new LimbSite\MainPage();
		}

		$this -> html = $html -> page;
	}
	private function routeLimb()
	{
		$route_arr = $this -> route_array;

		if(count($route_arr) >= 1)
		{
			if($route_arr[0] == "import")
			{
				$html = new Limb\ImportPage();
			}
			elseif($route_arr[0] == "export")
			{
				$html = new Limb\ExportPage();
			}
			elseif($route_arr[0] == "template")
			{
				$html = new Limb\TemplatePage();
			}
			elseif($route_arr[0] == "setting")
			{
				$html = new Limb\SettingPage();
			}
			elseif($route_arr[0] == "table")
			{
				if(isset($route_arr[1])) $html = new Limb\TablePage($route_arr[1]);//открываем заданную
				else $html = new Limb\TablePage(0);//открываем первую статью
			}
			elseif($route_arr[0] == "delete_table")
			{
				if(isset($route_arr[1]))
				{
					Control\Necessary::delete_table($route_arr[1]);
				}
				header('Location: '.$_SERVER['HTTP_REFERER']);//возвращаем наместо
			}
			elseif($route_arr[0] == "faqs")
			{
				if(isset($route_arr[1])) $html = new Limb\FaqsPage($route_arr[1]);//открываем заданную
				else $html = new Limb\FaqsPage(0);//открываем первую статью
			}
			else
			{
				session_start();
				$_SESSION['message'] = "Страница не найдена";
				if(isset($route_arr[0])) $html = new Limb\MainPage($route_arr[0]);//открываем заданную
				else $html = new Limb\MainPage(0);//открываем первую статью
			}
		}
		else
		{
			if(isset($route_arr[1])) $html = new Limb\MainPage($route_arr[1]);//открываем заданную
			else $html = new Limb\MainPage(0);//открываем первую статью
		}
		$this -> html = $html -> page;
	}


	public function getHtml()
	{
		return $this -> html;
	}
	public function getRouteArray()
	{
		return $this -> route_array;
	}
}

?>