<?php
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
header ("Location: ../index.php");

}else{
$func=$_GET['func'];

require_once('include/phpagi-asmanager.php');

        $asm = new AGI_AsteriskManager();
          if($asm->connect('localhost','amiws','amiws')){
                $peer = $asm->command("core show function ".$func);
                $test = preg_replace("/Privilege: Command/s",'',$peer['data']);
                $test1 = preg_replace("/\\n/s",'<br>',$test);
                $test2 = preg_replace("/\[/s",'<b>[',$test1);
                $test3 = preg_replace("/\]/s",']</b>',$test2);
		
                echo $test3;
          }


         $asm->disconnect();

}
?>
