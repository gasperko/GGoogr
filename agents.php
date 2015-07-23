<?
function gcurl($url,$proxy=0)
{
	$action = curl_init();
	if($proxy != 0){
		$proxy = explode(':',$proxy);
		curl_setopt($action, CURLOPT_PROXY, $proxy[0]);
		curl_setopt($action, CURLOPT_PROXYTYPE, CURLPROXY_HTTP );
		curl_setopt($action, CURLOPT_PROXYPORT, $proxy[1]);
		//curl_setopt($action, CURLOPT_HTTPPROXYTUNNEL, 0);
	}
	curl_setopt($action, CURLOPT_URL, $url);
	curl_setopt($action, CURLOPT_HEADER, 0);
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
			die('[ERROR] Proxy: ' . curl_error($action)."\r\n");
		}else{
			die('[ERROR] Curl: ' . curl_error($action)."\r\n");
		}
	}
	curl_close($action);
	return $curlout;
}
function array_random( array $array )
{
	return $array[ array_rand( $array, 1 ) ];
}

function osx_version( )
{
	return "10_" . rand( 5, 7 ) . '_' . rand( 0, 9 );
}

function firefox( $arch )
{
	$ver = array_random( 
		array(
		'Gecko/' . date( 'Ymd', rand( strtotime( '2011-1-1' ), time() ) ) . ' Firefox/' . rand( 5, 7 ) . '.0',
		'Gecko/' . date( 'Ymd', rand( strtotime( '2011-1-1' ), time() ) ) . ' Firefox/' . rand( 5, 7 ) . '.0.1',
		'Gecko/' . date( 'Ymd', rand( strtotime( '2010-1-1' ), time() ) ) . ' Firefox/3.6.' . rand( 1, 20 ),
		'Gecko/' . date( 'Ymd', rand( strtotime( '2010-1-1' ), time() ) ) . ' Firefox/3.8' 
		) 
	);
	switch ( $arch )
	{
	case 'lin':
		return "Mozilla/5.0 (X11; Linux i586; rv:" . rand( 5, 7 ) . ".0) $ver ";
	case 'mac':
		$osx = osx_version();
		return "Mozilla/5.0 (Macintosh; Intel Mac OS X $osx) rev:$ver Safari/7046A194A";
	} 
}
function randagent(){
	$arrsch = array_random(array('lin','mac'));
	//echo "$arrsch\n";
	return firefox($arrsch);
}
