<?php
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
header ("Location: ../index.php");

}else{
require_once('include/phpagi-asmanager.php');


$id=$_GET['id'];

switch($id){

	case 'dp':
		$asm = new AGI_AsteriskManager();
		if($asm->connect('localhost','amiws','amiws')){
		        $dp = $asm->command("dialplan reload");
		        sleep(1);
		}
		$asm->disconnect();


		header("location:dialplan.php");
		break;
	
	case 'sip';
		$asm = new AGI_AsteriskManager();
                if($asm->connect('localhost','amiws','amiws')){
                        $dp = $asm->command("sip reload");
                        sleep(1);
               	}
                $asm->disconnect();

		header("location:sipf.php");
		break;

	case 'iax';
		$asm = new AGI_AsteriskManager();
                if($asm->connect('localhost','amiws','amiws')){
                        $dp = $asm->command("iax2 reload");
                        sleep(1);
               	}
                $asm->disconnect();

		header("location:iaxf.php");
		break;

	case 'dahdi';
		$asm = new AGI_AsteriskManager();
                if($asm->connect('localhost','amiws','amiws')){
                        $dp = $asm->command("dahdi restart");
                        sleep(1);
               	}
                $asm->disconnect();

		header("location:dahdif.php");
		break;
}
}
?>
