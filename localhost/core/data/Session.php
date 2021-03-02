<?
//$update_query = "UPDATE db.tablename SET insert_time=now() WHERE username='" .$somename . "'";
Class session{
	public static $current_session;
	public static $current_session_id = 0;
	
	public static function genSession(){
		$charactersLength = 127;
		$randomString = '';
		for ($i = 0; $i < 90; $i++) {
			$randomString .= chr(rand(65, $charactersLength - 1));
		}
		return base64_encode($randomString);
	}
	
	public static function isSessionExist($session)
	{
            return SQL::exec("SELECT * FROM sessions WHERE session=?",[$session],SQL::FETCH);
	}
	
	public static function isAuthorized()
	{
		if(self::$current_session_id!=0)
			account::setOnline(self::$current_session_id);
		return self::$current_session_id;
	}
	
	public static function init()
	{
		if(!isset($_COOKIE["session"]) || !self::isSessionExist(self::$current_session = $_COOKIE["session"]))
		{
			$session = self::$current_session = self::genSession();
			setcookie('session',$session,time() + 365 * 24 * 3600,'/');
                        SQL::exec("INSERT INTO sessions (session,user_id,UA,session_expired,lastip) VALUES (?,?,?,?,?)",
                                   [$session,0,Request::$USER_AGENT,date("Y-m-d H:i:s"),Request::$FROMIP],SQL::NONE);
		}
		else
			self::$current_session = $_COOKIE["session"];
		
		self::$current_session_id = 
                        SQL::exec("SELECT * FROM sessions WHERE session=?",[self::$current_session],SQL::FETCH)['user_id'];
	}
}
session::init();
?>