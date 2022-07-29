<?php
    #$codigo = substr(md5(date("YmdHis")), 1, 7);
    /**
     * https://docs.microsoft.com/en-us/previous-versions/aspnet/8b83ac7t(v=vs.100)?redirectedfrom=MSDN
     * precisa baixar uma parada p poder enviar emails :(
     */



    #$email = $_POST['email'];

    /*$retorno = mail("enzo.dante.m@gmail.com", "Comentário", "Olá testando, \n Ótimo post. Obrigado");

    if($retorno){
        echo "Mensagem enviada com sucesso.";
    }
    else{
        echo "Sua mensagem não pode ser enviada. Tente novamente.";
    }*/
    $nome = 'Eu';
    $email = 'enzo.dante.m@gmail.com';

    $arquivo = "
  <style type='text/css'>
  body {
  margin:0px;
  font-family:Verdane;
  font-size:12px;
  color: #666666;
  }
  a{
  color: #666666;
  text-decoration: none;
  }
  a:hover {
  color: #FF0000;
  text-decoration: none;
  }
  </style>
    <html>
        <table width='510' border='1' cellpadding='1' cellspacing='1' bgcolor='#CCCCCC'>
            <tr>
              <td>
  <tr>
                 <td width='500'>Nome:$nome</td>
                </tr>
                <tr>
                  <td width='320'>E-mail:<b>$email</b></td>
     </tr>
      <tr>
                  <td width='320'>Telefone:<b>$212192192</b></td>
                </tr>
     <tr>
                  <td width='320'>Opções:2</td>
                </tr>
                <tr>
                  <td width='320'>Mensagem:$nome</td>
                </tr>
            </td>
          </tr>
          <tr>
            <td>Este e-mail foi enviado em <b>a</b> às <b>b</b></td>
          </tr>
        </table>
    </html>
  ";
  $emailenviar = "enzo.dante.m@gmail.com";
  $destino = $emailenviar;
  $assunto = "Contato pelo Site";
   // É necessário indicar que o formato do e-mail é html
   $headers  = 'MIME-Version: 1.0' . "\r\n";
   $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $headers .= 'From: $nome <$email>';
    //$headers .= "Bcc: $EmailPadrao\r\n";

    $enviaremail = mail($destino, $assunto, $arquivo, $headers);
    if($enviaremail){
        $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
        echo $mgm;
        #echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
    } else {
        $mgm = "ERRO AO ENVIAR E-MAIL!";
        echo "fudeu";
    }
?>
