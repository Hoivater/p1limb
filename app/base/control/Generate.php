<?php
namespace limb\app\base\control;
use limb\app\base as Base;

	// Класс для генерации различных типов значений
	// Набор статических классов

	class Generate
	{
		public static function this_idgenerate()
		{
			return 'NULL';
		}
		public static function this_dategenerate()
		{
			$year = 32140800;
			$clock_start = time()-$year;#год назад
			return rand($clock_start, time());
		}


		#максимальная длина int - 11, генерируется от 3 до 8; в автоматическом режиме
		public static function intgenerate($num = 0)
		{
			if($num == 0)
			{
				$min = 10;
				$count = rand(3, 9);
				$max = pow(10, $count);
			}
			else
			{
				$min = pow(10, $num-2);
				$max = $min + $min*9-1;
			}
			return rand($min, $max);
		}
		#генерируется заданная длинна из слов
		public static function varchargenerate($num)
		{
			$min = $num - 20;
			$max = $num - 10;
			$dictionary = file_get_contents(__DIR__."/../../../datastore/word/russian.tm");
			$dictionary_arr = explode(", ", $dictionary);
			shuffle($dictionary_arr);
			$result = "";
			for($i = 0; $i <= count($dictionary_arr)-1; $i++)
			{
				$result .= " ".$dictionary_arr[$i];
				$length = strlen($result);
				if($length >= $min && $length <= $max)
				{
					break;
				}
				if($length > $num)
				{
					$result = mb_substr($result, 0, $num-4);
					break;
				}
			}

			return  self::mb_ucfirst(trim($result));
		}
		public static function mb_ucfirst($text) {
		    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
		}
		#генерируется текст размером от 200 до 900 символов из слов
		public static function textgenerate()
		{
			$num = rand(200, 900);
			$min = $num - 10;
			$max = $num + 10;
			$dictionary = file_get_contents(__DIR__."/../../../datastore/word/russian.tm");
			$dictionary_arr = explode(", ", $dictionary);
			shuffle($dictionary_arr);
			$result = "";
			for($i = 0; $i <= count($dictionary_arr)-1; $i++)
			{
				if($i % 10 == 0 && $i != 0)
				{
					$result .= '. '.self::mb_ucfirst($dictionary_arr[$i]);

				}
				else
				{
					$result .= " ".$dictionary_arr[$i];
				}
				$length = strlen($result);

				if($length >= $min && $length <= $max)
				{
					break;
				}
				if($length >= $max)
				{
					$result = mb_substr($result, 0, $max-4);
					break;
				}

			}
			return  self::mb_ucfirst(trim($result));
		}
		#генерация числа 32.3243
		public static function floatgenerate()
		{
			$start = 0;
			$end = 9999999;
			$s = rand($start, $end);
			$result = $s / 10000;
			return $result;
		}
		#false || true
		public static function booleangenerate()
		{
			$ar = [1, 0];
			shuffle($ar);
			$result = $ar[0];
			return $result;
		}



		#текст через запятую/ специальное заполнение
		public static function tagsgenerate()
		{

			return $result;
		}
		#11 значная дата от год назад от теперешнего времени
		public static function dategenerate()
		{

			return $result;
		}
		#генерируется ненастоящая ссылка латиницей
		public static function linkgenerate()
		{

			return $result;
		}
		#пароль и оборачивается в md(5) 
		public static function passgenerate()
		{
			$arr = ["11111", "22222", "33333", "44444"];
			shuffle($arr);

			return md5($arr[0]);
		}

	}
?>