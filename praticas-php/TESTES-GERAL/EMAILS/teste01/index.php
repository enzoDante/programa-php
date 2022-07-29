<?php
    require_once('src/PHPMailer.php');
    require_once('src/SMTP.php');
    require_once('src/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);
    try{
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'enzo.dante.m@gmail.com';
        $mail->Password = '123';
        $mail->Port = 587;

        $mail->setFrom('enzo.dante.m@gmail.com');
        $mail->addAddress('enzo.dante.m@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'teste de enviar email';
        $mail->Body = 'chegou email teste do <strong>canal ti</strong>';
        $mail->AltBody = 'chegou email teste do a canal ti';

        if($mail->send()){
            echo 'email enviado com sucesso';
        }else{
            echo 'email n enviado :(';
        }

    }catch(Exception $e){
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }

?>