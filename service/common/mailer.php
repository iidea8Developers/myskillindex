<?php
// Include Swiftmail
require_once ('../../lib/swiftmailer/lib/swift_required.php');
// Include and configure log4php
include_once('../../lib/log4php/Logger.php');
Logger::configure('../../config/log_config.xml');
// Include Config.txt to get sending account username & password
include_once('../../config/config.txt');


$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
  ->setUsername(admin_email)
  ->setPassword(admin_pwd);

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance('Test Subject')
  ->setFrom(array('abc@example.com' => 'ABC'))
  ->setTo(array('xyz@test.com'))
  ->setBody('This is a test mail.');

$result = $mailer->send($message);
?>