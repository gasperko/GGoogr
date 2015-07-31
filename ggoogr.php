<?php
//BY 3Turr
/*
Copyright {2015} {Ahmed Alarbi}
   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at
       http://www.apache.org/licenses/LICENSE-2.0
   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
Don't delete this, respect the coder who shared it for free.
By: 3Turr
Contact: facebook.com/ahmed.f.alarbi
note: This script is the fastest cracker for CPanels you can run.
*/
include_once('./functions.php');
include_once('./agents.php');
include_once('./csqli.php');
//## Functions
function arguments($argvx) 
{
	$_ARG = array();
	foreach ($argvx as $arg) {
		if (ereg('--([^=]+)=(.*)',$arg,$reg)) {
			$_ARG[$reg[1]] = $reg[2];
		} elseif(ereg('--(.*)',$arg,$reg)) {
			$_ARG[$reg[1]] = 'true';
		} elseif (ereg('\-([^=]+)=(.*)',$arg,$reg)) {
			$_ARG[$reg[1]] = $reg[2];
		}elseif(ereg('\-(.*)',$arg,$reg)) {
			$_ARG[$reg[1]] = 'true';
		}
	}
	return $_ARG;
}
function helpe($m=null)
{
	global $argv;
	die("\r\n[ERROR] $m\r\n\nFor help use : php ".$argv[0]." --help ,or --h\r\n");
}
//## Check

if(empty($argv[1])){
	helpm();	
}else{
	$inargs = arguments($argv);
}

$options1 = 
array(
	1 => 'h',
	2 => 'd',
	3 => 'sd',
	3 => 'o',
	4 => 'subd',
	5 => 'honly',
	6 => 'donly',
	7 => 'tor',
	8 => 'tp',
	9 => 'proxy',
	10 => 'feach',
	11 => 'nor',
	12 => 'csqli',
);
$options2 = 
array(
	1 => 'help',
	2 => 'dork',
	3 => 'sdomine',
	3 => 'output',
	4 => 'subdomins',
	5 => 'hostonly',
	6 => 'domineonly',
	7 => 'tor',
	8 => 'torport',
	9 => 'proxy',
	10 => 'foreach',
	11 => 'norepeat',
	12 => 'checksqli',

);

$option = array();
//var_dump($inargs);
foreach($inargs as $key=>$op){
	
	if (($num = array_search($key,$options1)) == true){
		$numx = $options2[$num];
		$option[$numx] = $op;
	}elseif (($num = array_search($key,$options2)) == true){
		 $option[$key] = $op;
	}else{
		helpe();
	}
}
// $option 
// for all the orggnized arguments
//## check of the arguments
//--h,--help 
//--d,--dork
//--sd,--sdomine
//--o,--output
//--subd,--subdomins
//--honly,--hostonly
//--tor
//--torp,--torport
//--proxy
clss();
startm();
( isset($option['help']) && $option['help'] == true ) ? helpm(): 0 ;
if( isset($option['dork'])){
	if( $option['dork'] == 'true' ){
		helpe("Dork is empty !.");
	}else{
		$dork = $option['dork'] ;
	}
}
if(isset($option['sdomine']) && @filter_var(@gethostbyname($option['sdomine']),FILTER_VALIDATE_IP) == true ){
	if (isset($dork)){
		helpe("You can't use --sdomine with --dork");
	}else{
		$dork = '*\.'.$option['sdomine'];
	}
}

( isset($option['norepeat']) && $option['norepeat'] == 'true' ) ? $norepeat = 1 : $norepeat = 0 ;
//output is down .
( isset($option['subdomins']) && explode('.',$option['subdomins']) == true ) ? $subdomins = $option['subdomins'] :$subdomins = false ;
( isset($option['hostonly'])  && $option['hostonly'] == 'true' ) ? $hostonly = 1 : $hostonly = 0 ;
( isset($option['checksqli'])  && $option['checksqli'] == 'true' ) ? $checksqli = 1 : $checksqli = 0 ;
( isset($option['domineonly']) && $option['domineonly'] == 'true' ) ? $domineonly = 1 : $domineonly = 0 ;
if(isset($option['torport']) && isset($option['tor'])){
	if($option['torport'] != 9150 &&  $option['torport'] != 'true' && is_numeric($option['torport'])){
		$torport = $option['torport'];
	}elseif($option['torport'] == true){
		helpe("Pleas set a valid port for Tor");
	}
}
( !isset($torport) && isset($option['tor']) ) ? $torport = 9150 : 0;

if(isset($option['tor']) && $torport != 0){
	echo "[+] Testing connection to Tor...";
	if(($con = @fsockopen('127.0.0.1', $torport, $eroare, $eroare_str, 3)) == true){
		$proxy = '127.0.0.1'.':'.$torport;
		echo "[+] Connected to Tor.";
	}else{
		helpe("Could not connect to Tor");
	}
}
if( isset($option['proxy']) ){
	if (testproxy($option['proxy'])){
		$proxy = $option['proxy'];
	}else{
		helpe("Proxy connection falied.");
	}
}

if( isset($option['foreach']) ){
	if($option['foreach'] != 'true' && $option['foreach'] != ''){
		$foreach = $option['foreach'];
	}elseif($option['foreach'] != 'true' || $option['foreach'] != ''){
		helpe('Wrong input for option foreach!');
	}
}else{$foreach = 0;}

//print_r($option);
//testproxy($option['proxy']);
//helpm();
//helpe();
$pause = array(300,400,500,600,700,800,900,1000,1100,1200,1300,1400,1500,1800,1900,2000,2200,2100,2300,2500,2700,2800,2900,3000,3200,3100,3300,3500,3700,3800,3900);

if ($subdomins !== false){
	$dork = 'site:*.'.$subdomins.' -site:www.'.$subdomins;
}
if ($dork != ''){
	$dork = urlencode($dork);
}else{
	helpe('Please insert a dork.');
}

if (isset($option['output'])){
	if (!is_file($option['output'])){
		file_put_contents($option['output'], '[+]======== GGoogr ~ By 3Turr ========[+]
Dork:'.urldecode($dork).'
', FILE_APPEND);
	}elseif (is_file($option['output'])){
		file_put_contents($option['output'], '
[+]===================================[+]
Dork:'.urldecode($dork).'
', FILE_APPEND);
	}
	( isset($option['output']) && @fopen($option['output'],'a+') == true) ? $outf = @fopen($option['output'],'a+') : $outf  = 0 ;
}else{$outf  = 0;}




$numofres = 0;
for ($i = 0;$i <= 4000 ; $i+=60){
	
	//$numofres = 0;
	if (in_array($i,$pause)){echo "[!] pusing";for($x=0;$x<=20;$x++){echo".";sleep(1);}echo "\n";}
	if (isset($proxy) && $proxy != 0){
		//echo $proxy;
		$googout =  gcurl('http://www.google.com/search?q='.($dork).'&hl=en&meta=&start='.$i.'&filter=0&biw=1360&bih=643&num=60',$proxy); 
		if ($googout == null){helpe("No Data resived from the Proxy server.");}
		echo "[+] connction succeed.\n";
	}else{
		$googout =  gcurl('https://www.google.com/search?q='.($dork).'&hl=en&meta=&start='.$i.'&filter=0&biw=1360&bih=643&num=60'); 
	}
	if(eregi('302 Moved',$googout)){
		$googout =  gcurl('https://www.google.com/search?q='.($dork).'&hl=en&meta=&start='.$i.'&filter=0&biw=1360&bih=643&num=60');
	}
	//var_dump($googout);
	if(eregi('No results found for ',$googout) || $googout == ''){
		die("[~] No more results found from Google\n");
	}
	if (eregi('type the characters below',$googout)){
		echo "\r\n[ERROR] GOOGLE HAD BAN YOU !\r\n[+] Please enter a proxy. EX: 127.0.0.1:80\r\n[+] Enter anything to wait for 5 minutes.\r\n[*]: ";
		$proxyin=forcein(1);
		$proxy = proxyxin($proxyin);

		
	}
	$resnum = ggrap($googout , 'id="resultStats">About ', " results",1) or 0;
	if ($i == 0){
		echo "[*] Dork: ".urldecode($dork)." \r\n";
		echo "[*] Results: $resnum \r\n\r\n";
	}elseif($subdomins !== false){
		$dork = '*'.$subdomins;
	}
	//###########################HERE
	//sleep(1);
	@preg_match_all("/<li class=\"g\"><h3 class=\"r\"><a href=\"\/url\?q=(.*)&amp;/iU", $googout, $regsw);
	//var_dump($regsw[1]);
	//break;
	if ($norepeat == 1 || $subdomins !== false){
		$allsiteslist = array_unique($regsw[1]);
		unset($regsw);
	}else{
		$allsiteslist = $regsw[1];
		unset($regsw);
	}
	
	
	foreach($allsiteslist as $sitelist){
		$sitelist = urldecode($sitelist);
		//$sitelist = ggrap($googout,'<li class="g"><h3 class="r"><a href="/url?q=', '&amp;',$x); // an old code
		//echo "\r\n $sitelist \r\n";
		
		if ($sitelist != null && $sitelist != ''){
			if($domineonly === 1){
				$sitelist = parse_url($sitelist); // scheme , host
				$sitelist = $sitelist['scheme'].'://'.$sitelist['host'].'/';
			}elseif($hostonly === 1 || $subdomins !== false){
				$sitelist = parse_url($sitelist); // scheme , host
				$sitelist = $sitelist['host'];
			}elseif(isset($subdomins) && $subdomins != 0 && eregi($subdomins,$sitelist)){
				$sitelist = parse_url($sitelist); // scheme , host
				$sitelist = $sitelist['host'];
			}else{
				$sitelist = $sitelist;
			}
			
			if ($checksqli == 1){
				if (csqli($sitelist."\'") == 'yes'){
					echo '[SQLI] '.$sitelist."\n";
				}else{
					echo '[+] '.$sitelist."\n";
				}
			}else{
				echo '[+] '.$sitelist."\n";
			}
			$numofres = $numofres+1;
			
			if($outf){
				fwrite($outf,$sitelist."\n");
			}
			if($foreach){
				echo @shell_exec(@str_replace('DOMINE',$sitelist,$foreach));
			}
		}else{
			continue 1;
		}
		
	}
	
	
	if (isset($option['output']) && is_file($option['output']) && ($norepeat == 1 || $subdomins !== false) ){
		fclose($outf);
		$nore = array_unique(@explode("\n",@file_get_contents($option['output'])));$outnum = count($nore);
		for($f=0;$f<=count($nore);$f++){
			$nore[$f] = trim($nore[$f]);
		}
		file_put_contents($option['output'],'Resualts: '.$outnum."\n".implode("\n",$nore));
		unset($nore);
		$outf = @fopen($option['output'],'a+');
	}
	$pnum = $i/100+1;
	@flush();@ob_clean();@ob_flush();		
	echo "\n[+] Break, Page($pnum) : $numofres\r\n\n";
	
	//In order to show you the most relevant results
	sleep(2);
}	


if($outf){
	@fclose($outf);
}
//var_dump($inargs);


?>
