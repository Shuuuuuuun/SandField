<?php header('Content-Type: text/css; charset=utf-8'); ?>
@charset "UTF-8";
<?php

/* <link rel="stylesheet" type="text/css" href="css.php" />   use this to your php file */

class CSS
{
	private $html;
	public static $classes;
	private $class_array = array();
	private $propertys = array(
	'm' => 'margin',
	'p' => 'padding',
	'f' => 'font',
	'w' => 'width',
	'h' => 'height',
	'l' => 'left',
	'r' => 'right',
	't' => 'top',
	'b' => 'bottom',
	's' => 'size',
	);
	
	
	
	
	public function __construct()
	{
		$this->html = file_get_contents((empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"]);
	}
	
	
	
	public function createClass()
	{
		preg_match_all('/class=\"(.*?)\"/',$this->html,$rows);
		$classes2 = array();
		foreach($rows[1] as $row){
			$keys = explode(' ',$row);	
				foreach($keys as $key){
				$classes2[] = $key;
				}
			}
		$this->classes = array_unique($classes2);
		 return $this->analyzeClass($this->classes);
	}
	
	
	
	private function analyzeClass($classes)
	{
		//var_dump($classes);		
		foreach($classes as $class){
			
			$this->class_array[] = str_split($class);
		}
		//var_dump( $this->class_array);
		return $this->processCss();

	}
	
	private function processCss()
	{
		$result = null;

		foreach($this->class_array as $class){
		$i = 0;
		$prop = null;
		$name = null;
		$css = null;
		
		
			foreach($class as $prop){
				$name .= $prop;
				if(!is_numeric($prop)){


						
					if($i == 0 && array_key_exists($prop,$this->propertys)){
						$css .= '{'.$this->propertys[$prop];
					}elseif($i == 1 && array_key_exists($prop,$this->propertys)){
						$css .= '-'.$this->propertys[$prop].':';
					}else{
							$css = null;
							$name = null;
							goto b;
					}
					

				}else{
					$css .= $prop;					
				}
			$i++;
			}
			
			
			$result .= '.'.$name.$css;
			$result .= 'px!important;}';
			b:
			$a = null;
			
		}
		var_dump($this->propertys);
		return $result;
	}
}

$css = new CSS;
$tes = $css->createClass();
var_dump($tes);
echo $tes;
