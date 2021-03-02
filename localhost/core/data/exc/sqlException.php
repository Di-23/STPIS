<?
class sqlException extends MException {
	function __construct($exception) {
		parent::__construct("SQLEXC: SESSION(".session::$current_session_id.") $exception", true);
	}
}
?>