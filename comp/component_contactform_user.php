<?php
if (!empty($_REQUEST['submit'])) {
    require_once "model_mail.php";
    /* Name, From Email, Message, Subject, Address */
    $mail = new Mail\MailFromUser($_POST['from_name'], $_POST['from_email'], $_POST['message'], 'Klienta jautājums', 'andreikin123@gmail.com');
    /* Filters */
    $mail->filterName();
    $mail->filterEmailUser();
    $mail->filterMessage();
    /* Check the length */
    $mail->checkNameLength(3, 32);
    $mail->checkEmailLength(3, 254);
    $mail->checkMessageLength(3, 256);
    /* Address, Subject */
    $mail->createMailUser();
    $mail->sendMailUser('contacts.php');
}