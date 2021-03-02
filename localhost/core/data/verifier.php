<?

function check_submit(){
	if(getpost("enter")!=null)
	{
		if(Request::$URL_PARTS[1]=='')
		try{
			Account::auth(getpost("login"),getpost("password"));
			Request::$REDIRECT = "/";
		}catch(Exception $ex)
		{
			Request::$AUTHERROR = $ex->getMessage();
			//$REDIRECT = "/";
		}		
	}
	else
	if((getpost("registration"))!=NULL)
	{
		
	}
}


if(Request::$METHOD == "POST")check_submit();
?>