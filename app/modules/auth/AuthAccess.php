<?php 
namespace limb\app\modules\auth;
/**
 * Настройка ролей и разрешений
 */
class AuthAccess
{
	private $roles = ['admin', 'user'];
	private $html;
	private $result;
	private $auth;

	#конструктор получает текущее значение auth, и текст на 'проверку'
	public function __construct($html, $auth)
	{
		$this -> html = $html;
		$this -> auth = $auth;
		$this -> StaticReplace();
	}

	private function StaticReplace()
	{
		$start_arr = [];
		$end_arr = [];
		foreach($this -> roles as $value)
		{
			$start_arr[] = "%start".$value."%";
			$end_arr[] = "%end".$value."%";
		}
		for($i = 0; $i <= count($start_arr)-1; $i++)
		{
			$for_while = true;
			while($for_while)
			{
				$num_start = stripos($this -> html, $start_arr[$i]);
				$num_end = stripos($this -> html, $end_arr[$i]) + strlen($end_arr[$i]);
				if($num_start !== false)
				{
					if($this -> auth == $this -> roles[$i] || $this -> auth == 'admin')
					{
						$inc = substr($this -> html, $num_start+strlen($start_arr[$i]), $num_end-$num_start-strlen($start_arr[$i])-strlen($end_arr[$i])); 
					}
					else
					{
						$inc = "";
					}

					$s = substr($this -> html, 0, $num_start).$inc.substr($this -> html, $num_end);
					$this -> html = $s;
				}
				$for_while = stripos($this -> html, $start_arr[$i]);
			}
		}
		$this -> result = $this -> html;
		return true;
	}

	public function getResult()
	{
		return $this -> result;
	}
}

?>