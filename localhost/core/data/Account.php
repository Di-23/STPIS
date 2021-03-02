<?
class Account{
	private $email;
	private $password;
	private $name;
	private $surname;
	
	private static $MYSELF;//Auth current User
	
	public static function isDataCorrect($data)
	{
		if(!isset($data))
			throw new authException('Поле не инициализировано');
		if($data == "")
			throw new authException('Поле не может быть пустым');
		if(strlen($data)<3)
			throw new authException('Должно быть больше символов');
		if(strlen($data)>128)
			throw new authException('Слишком много символов');
		return true;
	}
	
	public static function isPasswordCorrect($login,$password)
	{
            return SQL::exec('SELECT * FROM users WHERE email=? AND password=?', [$login,$password], SQL::FETCH)?true:false;
	}
	
	public static function isIdExist($id)
	{
            return SQL::exec('SELECT * FROM users WHERE id=?', [$id], SQL::FETCH);
	}
	
	public static function isLoginExist($login)
	{
            return SQL::exec('SELECT * FROM users WHERE email=?', [$login], SQL::FETCH);
	}
	
	public static function Register_account($email,$password,$name,$surname)
	{
		
	}
	
	public static function getAccInfo($id)
	{
		if(self::isIdExist($id))
                    return SQL::exec('SELECT * FROM users WHERE id=?',[$id],SQL::FETCH);
		else
			throw new MException('Аккаунт не найден',false);
		return null;
	}
	
	public static function setOnline($id)
	{
	        SQL::exec('UPDATE users SET on_page=?,on_time=? WHERE id=?', [Request::$URL_REQUEST,now(),$id], SQL::NONE);
	}
	
	public static function isOnline($id)
	{
		return (time()-600) < strtotime(SQL::exec('SELECT * FROM users WHERE id=?', [$id], SQL::FETCH)['on_time']);
	}
	
	public static function auth($login,$password){
		if(self::isDataCorrect($login) && self::isDataCorrect($password))
		{
			if(!Account::isLoginExist($login))
				throw new authException('Аккаунт с таким именем не существует');
			else
			if(!Account::isPasswordCorrect($login,$password))
				throw new authException('Неверный пароль');
			SQL::exec('UPDATE sessions SET user_id=? WHERE session=?', [Account::isLoginExist($login)['id'],session::$current_session], SQL::NONE);
		}
	}
	
	public static function logout()
	{
            SQL::exec('UPDATE sessions SET user_id=? WHERE session=?', [0,session::$current_session], SQL::NONE);
	}
}
?>