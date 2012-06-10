<?php
class Class_Server
{
	const API_KEY = 'fbewabosbvdu09yb67f868r3bu2btp9hv8sa9vgugqabnuiobUIbbfiepbu43';
	
//	protected static $_serverId = null;
	protected static $_config = null;
	protected static $_enviroment = 'production';
	protected static $_orgCode = null;
	
	public static function config()
	{
		self::$_enviroment = APP_ENV;
	}
	
	protected static function getConfig()
	{
		if(self::$_config == null) {
			self::$_config = new Zend_Config_Ini(BASE_PATH.'/configs/forum/server.ini', self::$_enviroment);
		}
		return self::$_config;
	}
	
	public static function getSUId()
	{
		$config = self::getConfig();
		return $config->server->id;
	}
	
	public static function getEnv()
	{
		return self::$_enviroment;
	}
	
	public static function extUrl()
	{
		if(self::$_enviroment == 'production') {
			$url = "http://st.onlinefu.com/ext";
		} else {
			$url = "http://lib.eo.test/ext";
		}
		return $url;
	}
	
	public static function libUrl()
	{
		if(self::$_enviroment == 'production') {
			$url = "http://st.onlinefu.com/forum";
		} else {
			$url = "http://lib.eo.test/forum";
		}
		return $url;
	}
	
	public static function domain($type)
	{
		$config = self::getConfig();
		switch($type) {
			case 'file':
				return $config->domain->fileService;
				
		}
		return null;
	}
	
	public static function getOrgCode()
	{
		if(is_null(self::$_orgCode)) {
			$pathPieces = explode('/', $_SERVER["REQUEST_URI"]);
			if(strpos($_SERVER["REQUEST_URI"], 'http:') !== false) {
				self::$_orgCode = $pathPieces[3];
			} else {
				self::$_orgCode = $pathPieces[1];
			}
		}
		return self::$_orgCode;
	}
	
	public static function getMongoServer()
	{
		if(self::$_enviroment == 'production') {
			return 'mongodb://craftgavin:whothirstformagic?@127.0.0.1';
		} else {
			return '127.0.0.1';
		}
	}
}