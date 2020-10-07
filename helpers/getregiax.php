
<?php
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
header ("Location: ../index.php");

}else{
require_once('/var/lib/asterisk/agi-bin/phpagi-asmanager.php');

	$asm = new AGI_AsteriskManager();
	  if($asm->connect('localhost','amiws','amiws')){
        	$peer = $asm->command("iax2 show peers");
	        //print_r($peer);
        	preg_match('/\[(.*)/', $peer['data'], $val);
	        //print_r($val);
        	$online = explode(",",$val[1]);
	        $offline = explode(",",$val[1]);
        	$offline = explode("Unmonitored",$offline[1]);

	        //echo "ONline: ".$online[0];
        	//echo "\noffline: ".$offline[0];

  	  }

    $asm->disconnect();



        $jsondata['regiax'] = $online[0];
        echo json_encode($jsondata);
	
}
?>


