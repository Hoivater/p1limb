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
			if($auth !== "noauth"){#если авторизация присутствует
				//сразу меняем заданный %...%
				//далее избавляемся от правил видимости admin, user
				// echo $html;
				//
				#проверяем обычные повторы на самой странице
				if(isset($template["replace_standart"]) && is_array($template["replace_standart"]))
				{
					for($i = 0; $i < count($template["replace_standart"]); $i++)
					{
						$html = $this -> ReplaceStandart($template["replace_standart"][$i], $data["replace_standart"][$i], $html);
					}
				}
				#если есть что для простой замены, то заменяем
				if(isset($template["norepeat"]) && is_array($template["norepeat"]))
				{
					$html = Control\Necessary::asortReplace($template["norepeat"], $data["norepeat"], $html);
				}

			}
		}

		private function ReplaceStandart($str_name, $replace, $html)
		{
			$start = "^start_repeat_".$str_name."^";
			$end = "^end_repeat_".$str_name."^";


			$html_for_repeat = $this -> textInternal([$start, $end], $html);#получаем html для повтора
			$html = $this -> tmpReplace("&&LIMB&&", $html, [$start, $end]);#временная замена повторяющегося участка

			$result_f = Control\Necessary::asortReplace2($html_for_repeat[0], $replace, $html_for_repeat[1]);
			$html_finish = Control\Necessary::standartReplace("&&LIMB&&", $result_f, $html);

			echo $html_finish;
		}

		#заменяем повторяющийся текст на значок шаблонизатора
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