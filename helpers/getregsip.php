
<?php
 require_once('include/phpagi-asmanager.php');
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
header ("Location: ../index.php");

}else{
	$asm = new AGI_AsteriskManager();
	  if($asm->connect('125.253.117.83','amiws','amiws')){
        	$peer = $asm->command("sip show peers");
	        //print_r($peer);
        	preg_match('/Monitored: (.*)/', $peer['data'], $val);
	        //print_r($val);
        	$online = explode(",",$val[1]);
	        $offline = explode(",",$val[1]);
        	$offline = explode("Unmonitored",$offline[1]);

	        //echo "ONline: ".$online[0];
        	//echo "\noffline: ".$offline[0];

  	  }

    $asm->disconnect();



        $jsondata['regsip'] = $online[0];
        echo json_encode($jsondata);
	
}
?>


