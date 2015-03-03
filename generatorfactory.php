<?php
	require_once 'definitions.php';
	require_once 'codegenerators.php';
	require_once 'javacodegenerator.php';
	require_once 'phpcodegenerator.php';	

/**
 * Class factory to retrieve objects implementing the IDBTableCodeGenerator interface
 * @author artcarey
 *
 */
class GeneratorFactory {
	/**
	 * Static function to get an object that implements the IDBTableCodeGenerator interface.
	 * @param integer $language The integer code of the requested language.  Example: OUTPUT_PHP
	 * @return IDBTableCodeGenerator  An object that implements the IDBTableCodeGenerator interface 
	 * based on the $language parameter.
	 */
	public static function getCodeGenerator($language) {
		
		switch ($language) {
			case OUTPUT_PHP:
				return new PHPCodeGenerator();
			break;
			
			case OUTPUT_JAVA;
				return new JavaCodeGenerator();
			break;
			
			default:
				return new InvalidOptionsGenerator();
			break;
		}
	}
}
?>