<?php
    if((isset($_POST['nome_arquivo']))){
        $texto_arquivo = "";
        $texto_arquivo .= "<?php\ninclude('');\n";
        $nome_arquivo = "arquivos_gerados/".$_POST['nome_arquivo'];
        #caminho do arquivo
        $arquivo = fopen($nome_arquivo, "a");

        #$caixas = $_POST['boxs'];
        #$caixas = [''];
        for($i = 0; $i < 5; $i++){
            if(isset($_POST['boxs'.$i])){
                $caixas = $_POST['boxs'.$i];
                echo "{$caixas}<br>";
                
                switch ($caixas) {
                    case 'insert':
                        $cols = $_POST['colunas_inserir'];
                        $colarray = explode(",", $cols);
                        $table = $_POST['tabela_inserir'];
                        $texto_arquivo .= '$stmt = $con->prepare("INSERT INTO '.$table.' ('.$cols.')';
                        /*for($x = 0; $x < count($colarray); $x++){
                            if(($x < count($colarray)) && ($x != 0)){
                                $texto_arquivo .= ",";
                            }
                            $texto_arquivo .= "{$colarray[$x]}";
                        }*/
                        $texto_arquivo .= " VALUES (?,);\n";
                        $texto_arquivo .= '$stmt->bind_param("s", );'."\n";
                        $texto_arquivo .= '$stmt->execute();'."\n\n";
                        #echo $texto_arquivo;
                        
                        break;
                    case 'selectw':
                            $cols = $_POST['colunas_selecionar'];
                            $table = $_POST['tabela_selecionar'];
                            $clausula_where = $_POST['where_selecionar'];
    
                            $texto_arquivo .= '$stmt = $con->prepare("SELECT '.$cols.' FROM '.$table.' WHERE '.$clausula_where.');'."\n";
    
                            $texto_arquivo .= '$stmt->bind_param("s", );'."\n";
                            $texto_arquivo .= '$stmt->execute();'."\n";
                            $texto_arquivo .= '$resultado = $stmt->get_result();'."\n";
                            $texto_arquivo .= 'while($linha = $resultado->fetch_object()){'."\n\t\n}\n\n";
    
                        break;
                    case 'remove':
                        $table = $_POST['tabela_remover'];
                        $clausula_where = $_POST['where_remover'];
    
                        $texto_arquivo .= '$stmt = $con->prepare("DELETE FROM '.$table.' WHERE '.$clausula_where.');'."\n";
    
                        $texto_arquivo .= '$stmt->bind_param("s", );'."\n";
                        $texto_arquivo .= '$stmt->execute();'."\n\n";
    
    
                        break;
                    case 'update':
                        $cols = $_POST['colunas_atualizar'];
                        $table = $_POST['tabela_atualizar'];
                        $clausula_where = $_POST['where_atualizar'];
    
                        $texto_arquivo .= '$stmt = $con->prepare("UPDATE '.$table.' SET '.$cols.' WHERE '.$clausula_where.');'."\n";
    
                        $texto_arquivo .= '$stmt->bind_param("s", );'."\n";
                        $texto_arquivo .= '$stmt->execute();'."\n\n";
                        break;
    
                    case 'selectj':
                        #selectj();
                        break;
                    default:
                        echo "nada selecionado";
                        break;
                }

            }
        }
        fprintf($arquivo, $texto_arquivo);
        fclose($arquivo);
        header("Location: index.html");
    }


?>