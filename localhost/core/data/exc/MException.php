<?
class MException extends Exception { 
	public static $CEXCEPTION;
	function __construct($exception,$isFatal = false) {
		parent::__construct($exception);
		file_put_contents(getAbPath('/core/storage/error_wteme'),"\n".(Request::$URL).' '.(Request::$USER_AGENT).' '.(Request::$FROMIP).' '.($exception),FILE_APPEND);
		if($isFatal)
		{
                    config::$config['enabled'] = "false";
                    config::save();
                    self::$CEXCEPTION = self::$CEXCEPTION.$exception;
		}

	}
}

?>