<?
class authException extends MException {
	function __construct($exception) {
		parent::__construct($exception, false);
	}
}
?>