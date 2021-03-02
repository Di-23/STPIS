<?
class email{

public static function send($to,$from,$title,$body)
{
/*
	$message = "
	<html>
	<head>
	<title>$title</title>
	</head>
	<body>
	$body
	</body>
	</html>
	";
	
	// Always set content-type when sending HTML email

	// More headers
	$headers .= "From: <$from>" . "\r\n";
	mail($to,$title,$message,$headers);
	*/
	
	$subject = "My subject";
	$txt = "Hello world!";

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers = "From: $from" . "\r\n";
	mail($to,$subject,$txt,$headers);
}
}
?>