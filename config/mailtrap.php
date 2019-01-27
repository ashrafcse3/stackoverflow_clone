<?php
if ($_SERVER['SERVER_NAME'] == 'localhost') {
  $transport = (new Swift_SmtpTransport('smtp.mailtrap.io', 2525))
      ->setUsername('083c9d03744723')
      ->setPassword('cc9b95e20b2dd5');
} else {
  $transport = new Swift_SendmailTransport();
}

$mailer = new Swift_Mailer($transport);