<?php                    
    $stmt = $conn->prepare("SELECT * FROM chat WHERE (enviar=? AND recebido=?) OR (enviar=? AND recebido=?)");
    $stmt->bind_param('ssss', $_SESSION['id_unico'], $_GET['id'], $_GET['id'], $_SESSION['id_unico']);
    $stmt->execute();

    $resultado = $stmt->get_result();
    while($linha = $resultado->fetch_object()){                        
        #===========nome do cara q enviou remetente==================
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE id_unico=?");
        $stmt->bind_param('s', $linha->enviar);
        $stmt->execute();
        $resultado2 = $stmt->get_result();
        while($linha2 = $resultado2->fetch_object()){
            echo "<strong>{$linha2->nome}</strong>";
        }
        #==========mensagem==============
        echo "<p>{$linha->msg}</p><br>";
    }
                
?>