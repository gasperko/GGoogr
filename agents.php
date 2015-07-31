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
	return "" . rand( 9, 11 ) . "_" . rand( 5, 9 ) . '_' . rand( 0, 9 );
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
		return "Mozilla/5.0 (X11; Linux i586; rv:" . rand( 28, 35 ) . ".0) $ver ";
	case 'lin2':
		return "Mozilla/" . rand( 4, 5 ) . "." . rand( 1, 8 ) . " (X11; Linux i686; rv:" . rand( 29, 35 ) . ".0) $ver ";
	case 'mac':
		$osx = osx_version();
		return "Mozilla/5.0 (Macintosh; Intel Mac OS X $osx) $ver Safari/" . rand( 600, 740 ) . "A" . rand( 112, 199 ) . "A";
	} 
}
/*
Mozilla/5.0 (X11; U; Linux i686; en-GB; rv:1.9.0.9) Gecko/2009042113 Ubuntu/9.04 (jaunty) Firefox/3.0.9
Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.2; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.04506.648; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729)

*/
function randagent(){
	$arrsch = array_random(array('lin','mac','lin2'));
	//echo "$arrsch\n";
	return firefox($arrsch);
}
