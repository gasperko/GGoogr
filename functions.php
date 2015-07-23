<?php
//BY 3Turr

function forcein($stage=false)
{
	$out = trim(fgets(STDIN,1024));
	
	if (($out == null || $out == '' ) && $stage == true)
	{
		echo "[ERROR] Wrong input !\n[+]=> ";
		$out = read(1);
	}
	return $out;
}


function ggrap($text,$marqueurDebutLien,$marqueurFinLien,$i=1){
    $ar0=@explode($marqueurDebutLien, $text);
    $ar1=@explode($marqueurFinLien, $ar0[$i]);
    return @trim($ar1[0]);
}
function xflush( )
{
					static $output_handler = null;
					if ( $output_handler === null )
					{
$output_handler = @ini_get( 'output_handler' );
					}
					if ( $output_handler == 'ob_gzhandler' )
					{
return;
					} 
					flush();
					if ( function_exists( 'ob_flush' ) AND function_exists( 'ob_get_length' ) AND ob_get_length() !== false )
					{
@ob_flush();
					} 
					else if ( function_exists( 'ob_end_flush' ) AND function_exists( 'ob_start' ) AND function_exists( 'ob_get_length' ) AND ob_get_length() !== FALSE )
					{
@ob_end_flush();
@ob_start();
					} 
}

function clss()
{
if (eregi(PHP_OS,'nix||Darwin')){
@shell_exec('clear');

}else{
//echo PHP_OS;
@shell_exec('cls');
}
}
function helpm()
{
	startm();
	echo "\r\nUseg : php ggoog.php [options]

  -h,--help            Prints this help menu.

  -d,--dork            Set the searching Dork.

  -feach,--foreach     Run's a spicifec command for each resualt.
                          DOMINE = The resualt url or domine.
                       EX: -feach=\"python exploit.py DOMINE\"
  
  -sd,--sdomine        Output a specifiec domine only.

  -tor,--tor           Connect to the tor network (defualt port is 9150)
                       Most the time Google block's the Tor network IPs.

  -tp,torport          Change the port to connect to the Tor network.

  --proxy              Connect to a proxy server to bypass Google's banning
                       (You will be asked to use it,if google ban you)
                        EX: --proxy=127.0.0.1:8080


  -o,--output          Save the results to a file.
  
  -subd,--subdomins    Search for the subdomins of one domine.
  
  -honly,--hostonly    Get only the host name.
  
  -donly,--domineonly  Get only the domine url.
 
 
 EX:
 
  php ggoog.php --d=\"dork example\" -feach=\"python exploit.py DOMINE\"
  php ggoog.php --sd=example.com --d=\"dork example\" --o=output.txt --donly
  php ggoog.php --subd=example.com --o=examplesubs.txt --proxy=127.0.0.1:80

";
die();
}
function testproxy($proxy)
{
  $splited = explode(':',$proxy); // Separate IP and port
  if (!filter_var($splited[0],FILTER_VALIDATE_IP)){
	  helpe("Wrong proxy input.");
  }else{echo "[*] Testing connecting to proxy $proxy ...\n";}
  if($con = @fsockopen($splited[0], $splited[1], $eroare, $eroare_str, 3)) 
  {
    @fclose($con); // Close the socket handle
	echo "[+] connction succeed.\n";
	return true;
  }else{
	  return false;
  }
}
function is_ipv4($string)
 {
     return (bool) preg_match('/^(?:(?:25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])'.
     '\.){3}(?:25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]?|[0-9])$/', $string);
 }
function testproxyin($proxy)
{
	; // Separate IP and port

	if(($splited = @explode(':',$proxy)) == true && is_ipv4($splited[0])){
		if (!filter_var($splited[0],FILTER_VALIDATE_IP)){
			helpe("Wrong proxy input.");
		}
		if($con = @fsockopen($splited[0], $splited[1], $eroare, $eroare_str, 3)) 
		{
			@fclose($con); // Close the socket handle
			echo "[+] connction succeed.\n";
			return true;
		}else{
			return false;
		}
	}else{
			return false;
	}
}

function startm(){
	echo "                                                                      
 .oOOOo.   .oOOOo.                           
.O     o  .O     o                           
o         o                                  
O         O                                  
O   .oOOo O   .oOOo .oOo. .oOo. .oOoO `ooOo. 
o.      O o.      O O   o O   o o   O  o     
 O.    oO  O.    oO o   O o   O O   o  O     
  `OooO'    `OooO'  `OoO' `OoO' `OoOo  o     
                                    O        
   3Turr : a.x.l[at]outlook.com  OoO'        
............................................

";


}






