<?php

function csqli($url,$proxy=0)
{
	$errors = array(
'syntax error','error in your SQL syntax','mysql_fetch_array', 'execute query', 'mysql_fetch_object', 'mysql_num_rows', 'mysql_fetch_assoc', 'mysql_fetch_row', 'SELECT * FROM', 'supplied argument is not a valid MySQL', 'Syntax error', 'Fatal error', 'You have an error in your SQL syntax', 'Microsoft VBScript runtime error');
$errors = '('.implode('|',$errors).')';
	$action = curl_init();
	if($proxy != 0){
		$proxy = explode(':',$proxy);
		curl_setopt($action, CURLOPT_PROXY, $proxy[0]);
		curl_setopt($action, CURLOPT_PROXYTYPE, CURLPROXY_HTTP );
		curl_setopt($action, CURLOPT_PROXYPORT, $proxy[1]);
		//curl_setopt($action, CURLOPT_HTTPPROXYTUNNEL, 0);
	}
	curl_setopt($action, CURLOPT_URL, $url);
	curl_setopt($action, CURLOPT_USERAGENT, randagent());
	curl_setopt($action, CURLOPT_FAILONERROR, 0); 
	curl_setopt($action, CURLOPT_SSL_VERIFYHOST, false); 
	curl_setopt($action, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($action, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt($action, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($action, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($action, CURLOPT_TIMEOUT, 30);
	$curlout = curl_exec($action);
	if(curl_errno($action))
	{
		if($proxy != 0){
			echo  '[ERROR] Proxy: ' . curl_error($action)."\r\n";
		}else{
			echo  '[ERROR] Curl: ' . curl_error($action)."\r\n";
		}
	}
	curl_close($action);
//echo '('.implode('||',$errors).')';
	if (eregi($errors, $curlout)){
		return "yes";
	}else{
		return 'no';
	}
}




