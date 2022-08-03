<?php
    include "banco.php";
    session_start();

    $stmt = $conn->prepare("SELECT * FROM chat WHERE (id_remetente=? AND id_destinatario=?) OR (id_remetente=? AND id_destinatario=?)");
    #$stmt->bind_param('ssss', $_SESSION['id_unico'], $_GET['id'], $_GET['id'], $_SESSION['id_unico']);
    $stmt->bind_param('ssss', $_SESSION['id_unico'], $_SESSION['id_amigo'], $_SESSION['id_amigo'], $_SESSION['id_unico']);
    $stmt->execute();

    $resultado = $stmt->get_result();
    while($linha = $resultado->fetch_object()){
        #===========nome do cara q enviou remetente==================
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE id_unico=?");
        $stmt->bind_param('s', $linha->id_remetente);
        $stmt->execute();
        $resultado2 = $stmt->get_result();
        while($linha2 = $resultado2->fetch_object()){
            if($_SESSION['id_unico'] != $linha2->id_unico){
                $div = "
                    <div class='amsg'>
                        <p class='msga'>$linha->msg</p>
                    </div>
                ";
            }else{
                $div = "
                    <div class='emsg'>
                        <p class='msge'>$linha->msg
                        <form method='post' action='deletarmsg.php?id={$_SESSION['id_amigo']}' style='margin-left: 90%;'>
                        <input type='hidden' name='idmsg' value='$linha->id'>
                        <button type='submit' style='background-color: transparent; border: none; cursor: pointer;'><img src='imagens/lixo.png'></button></form>
                        </p>
                    </div>
                ";
            }
            echo $div;
            #echo "<strong>{$linha2->nome}</strong>";
        }
        #==========mensagem==============
        #echo "<p>{$linha->msg}</p><br>";
    }


?>