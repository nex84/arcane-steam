
<?php
//require('../class/mail/Class.SMTP.php');

function send_mail($to, $body, $subject, $fromaddress, $fromname, $attachments=false)
{
//$smtp = new SMTP('localhost', '', '');
$smtp = new SMTP('localhost');

$smtp->set_from($fromname, $fromaddress);

$smtp->smtp_mail($to, $subject, $body);// Envoie du mail

	if(!$smtp->erreur){
		true;
	}else{// Affichage des erreurs
	   false;
	}
}


?>
