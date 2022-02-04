<?php
	namespace limb\app\worker;
	use limb\app\base\control as Control;
	use limb\app\modules as Modules;#для авторизации

	/**
	 *
	 */
	class Limb
	{

		function __construct()
		{
			// code...
		}

		public function TemplateMaster($template, $data, $auth, $html)#основная функция для сборки страницы
		
		{
			#сразу меняем replace_standart
			#дальше формируем replace_internal
			#далее избавляемся от правил видимости admin, user
			//
			#проверяем обычные повторы на самой странице
			if(isset($template["replace_standart"]) && is_array($template["replace_standart"]))
			{
				if(isset($template["replace_standart"][0]["name"]) && isset($template["replace_standart"][0]["folder"]))
				{
					for($i = 0; $i < count($template["replace_standart"]); $i++)
					{
						$html = $this -> ReplaceStandartInternal($template["replace_standart"][$i]["name"], $data["replace_standart"][$i], $html, $template["replace_standart"][$i]["folder"]);
					}
				}
				else
				{
					for($i = 0; $i < count($template["replace_standart"]); $i++)
					{
						$html = $this -> ReplaceStandart($template["replace_standart"][$i], $data["replace_standart"][$i], $html);
					}
				}
			}
			if(isset($template["replace_internal"]) && is_array($template["replace_internal"]))
			{
				for($i = 0; $i < count($template["replace_internal"]); $i++)
				{
					$modules = $this -> ReplaceInternal($template["replace_internal"][$i], $data["replace_internal"][$i]);
					$html = Control\Necessary::standartReplace("%".$template["replace_internal"][$i]["name"]."%", $modules, $html);
				}
			}
			#если есть что для простой замены, то заменяем
			if(isset($template["norepeat"]) && is_array($template["norepeat"]))
			{
				$html = Control\Necessary::asortReplace($template["norepeat"], $data["norepeat"], $html);
			}

			if($auth !== "noauth")
			{
				#если авторизация присутствует
				$au = new Modules\Auth\AuthAccess($html, $auth);
				$html = $au -> getResult();
			}
			return $html;
		}

		private function ReplaceStandartInternal($name, $replace, $html, $folder){
			$start = "^start_repeat_".$name."^";
			$end = "^end_repeat_".$name."^";

			if(file_exists(__DIR__."/../../view/public/".$folder."/".$name.".tm"))
			{
				$file_tm = file_get_contents(__DIR__."/../../view/public/".$folder."/".$name.".tm");
				$html_for_repeat = $this -> textInternal([$start, $end], $file_tm);#получаем html для повтора
				
				$file_tm = $this -> tmpReplace("&&LIMB&&", $file_tm, [$start, $end]);#временная замена повторяющегося участка

				$result_f = Control\Necessary::asortReplace2($html_for_repeat[0], $replace, $html_for_repeat[1]);

				$result_f2 = Control\Necessary::standartReplace("&&LIMB&&", $result_f, $file_tm);
				$html_finish = Control\Necessary::standartReplace("%".$name."%", $result_f2, $html);
			}
			return $html_finish;
		}
		private function ReplaceInternal($template, $data)
		{
			$name = $template["name"];
			$folder = $template["folder"];
			#ищем tm файл для замены в указанной папке
			if(file_exists(__DIR__."/../../view/public/".$folder."/".$name.".tm"))
			{
				$file_tm = file_get_contents(__DIR__."/../../view/public/".$folder."/".$name.".tm");
				#проверяем на возможность повтора
				$file_tm_arr = explode("\n", $file_tm);
				$replace_real = false;
				if(str_contains($file_tm_arr[0], "^start_repeat_".$name."^"))
				{
					$html_module = $this -> ReplaceStandart($name, $data, $file_tm);
				}
				else
				{
					$tmplt = explode(" ", $file_tm_arr[0]);
					unset($file_tm_arr[0]);
					$file_tm = implode("\n", $file_tm_arr);
					$html_module = $this -> NoReplaceStandart($name, $data, $file_tm, $tmplt);
				}

			}
			return $html_module;

		}
		private function NoReplaceStandart($name, $data, $file_tm, $tmplt)
		{
			$result_f = Control\Necessary::asortReplace2($tmplt, $data, $file_tm);
			return $result_f;
		}
		private function ReplaceStandart($str_name, $replace, $html)
		{
			$start = "^start_repeat_".$str_name."^";
			$end = "^end_repeat_".$str_name."^";

			$html_for_repeat = $this -> textInternal([$start, $end], $html);#получаем html для повтора
			$html = $this -> tmpReplace("&&LIMB&&", $html, [$start, $end]);#временная замена повторяющегося участка

			$result_f = Control\Necessary::asortReplace2($html_for_repeat[0], $replace, $html_for_repeat[1]);
			$html_finish = Control\Necessary::standartReplace("&&LIMB&&", $result_f, $html);

			return $html_finish;
		}

		#заменяем повторяющийся текст на значок шаблонизатора &&LIMB&&
		private function tmpReplace($limb, $html, $arr)
		{
			$num_start = stripos($html, $arr[0]);
			$num_end = stripos($html, $arr[1]) + strlen($arr[0]);
			$s = substr($html, 0, $num_start).$limb.substr($html, $num_end);
			return $s;
		}
		#возвращает текст внутри двух элементов массива
		private function textInternal($arr, $html)
		{
			$num_start = stripos($html, $arr[0]);
			$num_end = stripos($html, $arr[1]) + strlen($arr[0]);
			// echo $num_start." ".$num_end;
			$res = substr($html, $num_start, $num_end-$num_start);
			$res_arr = explode("\n", $res);
			$template = $res_arr[1];
			$template_arr = explode(" ", $template);
			unset($res_arr[1]);
			$html_res = str_replace($arr, ["", ""], implode("\n", $res_arr));
			$res_temp = [];
			for($i = 0; $i < count($template_arr); $i++)
			{
				$res_temp[] = trim($template_arr[$i]);
			}
			return [$res_temp, $html_res];
		}
	}
?>