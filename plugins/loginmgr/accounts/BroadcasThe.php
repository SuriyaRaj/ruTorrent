<?php

class BroadcasTheAccount extends commonAccount
{
	protected function isOK($client)
	{
		return(strpos($client->results, '<form name="loginform" id="loginform" method="post"')===false);
	}
	protected function login($client,$login,$password,&$url,&$method,&$content_type,&$body)
	{                                                                   
		if($client->fetch( "http://broadcasthe.net/login.php" ))
		{
                        $client->setcookies();
			$client->referer = "http://broadcasthe.net/login.php";

        		if($client->fetch( "http://broadcasthe.net/login.php","POST","application/x-www-form-urlencoded", 
				"username=".rawurlencode($login)."&password=".rawurlencode($password)."&keeplogged=1&login=Log+In%21" ))
			{
				$client->setcookies();
				return(true);
			}
		}
		return(false);
	}
	public function test($url)
	{
		return(preg_match( "/^http:\/\/broadcasthe\.net\//si", $url ));
	}
}

?>