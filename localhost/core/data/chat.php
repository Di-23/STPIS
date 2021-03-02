<?
/*
Retrieving data from the database in a clear view for the dialog display module
*
****/

class chat{
	/*
	Retrieving data from a database in a clear view using the user ID
	*
	****/
	public static function getMessagesWith($id)
	{
            return SQL::exec('SELECT * FROM chat WHERE (sender_id=? AND receiver_id=?) OR (sender_id=? AND receiver_id=?)', [session::isAuthorized(),$id,$id,session::isAuthorized()], SQL::FETCHALL);
	}
	
	
	/*
	Retrieving last contacts from chat
	*
	****/
	public static function getChatsWith()
	{
            return SQL::exec('SELECT sender_id,receiver_id FROM chat WHERE sender_id=? OR receiver_id=? ORDER BY id DESC', [session::isAuthorized(),session::isAuthorized()], SQL::FETCHALL);
	}
        
        /*
         * Send message
         */
        public static function sendMessageTo($from,$to,$msg)
        {
            SQL::exec('INSERT INTO chat (sender_id,receiver_id,message,time) VALUES (?,?,?,?)', [$from,$to,$msg,now()], SQL::NONE);
        }
        
	public static function getLastMessageId($from,$to)
	{
            return SQL::exec('SELECT time,message,sender_id,receiver_id FROM chat WHERE sender_id=? AND receiver_id=? ORDER BY id DESC LIMIT 1', [$from,$to], SQL::FETCH);
	}        
}

?>