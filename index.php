<?php 
require 'classes/tarpit.php';;
$tarpit=new tarpit;
$badbot=$tarpit->isBot();
$valid=$tarpit->targetValid();

$passedcaptcha=$tarpit->process_captcha();
if( $passedcaptcha == true)
{
	header('Location: '. 'http://' . $tarpit->settings['returnurl']);
}else{

if (isset($badbot)) { 
	require 'views/'.$tarpit->settings['jail'].'.php';
	}else{
		$tarpit->addBot();
		if($tarpit->settings['sendemail'] == true){
		$tarpit->sendEmail();
		}
		
if(isset($valid))
	{
	if($tarpit->settings['displaywhois'] == true){
	$arin=$tarpit->arin();
	}
	}
		require 'views/index.php';	
	}
}
?>
