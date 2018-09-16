<?php

/**
 *
 */
class ClassLoader {
	use Creator;
	public static $file;
	/**
	 *
	 */
	private $classMap = [];
	/**
	 *
	 */
	public function resolve()
	{
		static::$file = null;
		//error_reporting(0);
		//ini_set('display_errors', 0);
		register_shutdown_function(array($this, 'shutdownHandler'));
		$this->register();
		$this->classMap = $this->getClassMapper();
	}
	/**
	 *
	 */
	public function load($file)
	{
		static::$file = $file;
        if ($file = $this->findFile($file)) {
            include $file;
            return true;
        }
	}
    /**
     *
     */
    public function findFile($file)
    {
        if (isset($this->classMap[$file])) {
            return $this->classMap[$file];
        }
    }
    /**
     *
     */
    public function register($prepend = false)
    {
        spl_autoload_register(array($this, 'load'), true, $prepend);
    }
    /**
     *
     */
    public function shutdownHandler()
    {
    	$error = error_get_last();
    	if ($this->findFile(static::$file) && preg_match('/class.*not found/', strtolower($error['message']))) {
    		die('<p style=\'color:red\'>The file is found but the class isn\'t set. Did the class has valid name?</p>');
    	}
    }
}
