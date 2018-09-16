<?php

/**
 *
 */
trait Creator {
	/**
	 *
	 */
	private $classMapperFilename = 'class_map';
	/**
	 *
	 */
	private $callerName = null;
	/**
	 *
	 */
	public function getCaller()
	{
		return $this->callerName;
	}
	/**
	 *
	 */
	public function getClassMapper()
	{
		return include EME_LOADER_PATH . '/' . $this->classMapperFilename . '.php';
	}
	/**
	 *
	 */
	public static function getLoaderClassTemplate($hash)
	{
$template = <<<CLASS_TEMPLATE
<?php

/**
 * Autognerated loader class
 */
class $hash extends ClassLoader {
	
}

CLASS_TEMPLATE;
		return $template;
	}
}
