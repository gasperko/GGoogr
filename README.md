# GGoogr
GGoogr is a google searching tool for pen testers, and hackers. It's a smart tool to safe time and good for massing.

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


Useg : php ggoog.php [options]

  -h,--help            Prints this help menu.

  -d,--dork            Set the searching Dork.

  -feach,--foreach     Run's a spicifec command for each resualt.
                          DOMINE = The resualt url or domine.
                       EX: -feach="python exploit.py DOMINE"

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

  php ggoog.php --d="dork example" -feach="python exploit.py DOMINE"
  php ggoog.php --sd=example.com --d="dork example" --o=output.txt --donly
  php ggoog.php --subd=example.com --o=examplesubs.txt --proxy=127.0.0.1:80
