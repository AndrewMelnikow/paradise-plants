<?php    
if (!empty($_REQUEST['submit'])) {
    require_once "model_mail.php";
    /* From Email, To Email, Subject, Message, File */
    $mail = new Mail\MailFromAdmin('"Paradise Plants" <info@paradiseplants.lv>', $_POST['to_email'], $_POST['subject'], $_POST['message'], $_FILES['from_file']);
    /* Filters */
    $mail->filterEmailAdmin();
    $mail->filterSubject();
    $mail->filterMessage();
    /* Check the length */
    $mail->checkEmailLength(3, 254);
    $mail->checkSubjectLength(3, 32);
    $mail->checkMessageLength(3, 256);        
    /* Mail creating & sending */        
    $mail->createMailAdmin();
    $mail->sendMailAdmin('adminmail.php');
}