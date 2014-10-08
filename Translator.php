<?php
/*
 * Translator.php
 *
 * A PHP git library
 *
 * @package    Translator.php
 * @version    1.0.0
 * @author     Valentin Badiul S.
 */
class Translator
{ 
   /**
   * class property
   * 
   * @var string  
   */
	public $lg;
	
	public function __construct($lg = 'ru')
	{
		$this->lg = $lg;
		return $this;
	}
	
	/**
    * class method
    * 
    * @param string $word
    * @return string
    */
	public function trans($word)
	{
		if (file_exists('translator_' . $this->lg . '_.php' )) {
			include 'translator_' . $this->lg . '_.php';
			return $arrayTranslator[$word] ? $arrayTranslator[$word] : $word;
		} else {
			return $word;
		}    		 
		
	}
}