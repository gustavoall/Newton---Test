<?php

namespace App;

require_once("../vendor/autoload.php");
header('Content-type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.hostinger.com';
$mail->Port = 587;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPAuth = true;
$mail->setLanguage("br");
$mail->Username = 'sender@estilodev.com.br';
$mail->Password = 'Sender@1234';
$mail->setFrom('sender@estilodev.com.br', ' Staging Sender Mail for Newton');
$mail->addAddress('gustavo@estilodev.com.br','Gustavo Alves');

$mail->Subject = $_POST['subject'];
$mail->AltBody = "Novo Lead Registrado";
$mail->CharSet = 'UTF-8';
$mail->isHTML(true);

$messageSuccess = "E-mail enviado com sucesso!";
$messageFail = "Erro ao enviar e-mail!";

if (isset($_POST)) {

    $mail->msgHTML("
        <h1>Novo Lead registrado</h1>
        <p><strong>Nome</strong>: " . $_POST['name'] . "</p>
        <p><strong>E-mail</strong>: " . $_POST['email'] . "</p>
        <p><strong>Assunto</strong>: " . $_POST['subject'] . "</p>
        <p><strong>Mensagem</strong>: " . $_POST['message'] . "</p>
        <p><strong>Horário</strong>: " . date('D/M/Y h:i') . "</p>
        <br/>
    ");       
    
    try {
        if ($mail->send()) {
            echo json_encode([
                "status"=>200,
                "message"=>$messageSuccess
            ]);
        } else {
            echo json_encode([
                "status"=>400,
                "message"=>$messageFail
            ]);
        }
    } catch(\Exception $error) {
        echo "Error: " . $error;
    }
}

?>