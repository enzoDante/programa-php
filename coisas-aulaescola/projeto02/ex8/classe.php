<?php
    class tabela{
        private $nome = array();
        private $nota = array();
        private $alunonota;
        private $maiornota;

        public function melhoraluno($n, $no){
            $nota = 0;
            for($x = 0; $x <= 9; $x++){
                if($no[$x] > $this->maiornota){
                    $this->maiornota = $no[$x];
                    $this->alunonota = $n[$x];
                }
                $nota += $no[$x];
            }
            $nota = $nota/10;
            $msg = "Aluno: $this->alunonota Nota: $this->maiornota Média da classe: $nota";
            return $msg;
        }
        public function gerartabela(){
            $n = $this->getnota();
            for($i = 0; $i <= 8; $i++){
                for($x = 0; $x <= 8; $x++){
                    if($n[$x] < $n[$x+1]){
                        $aux = $n[$x];
                        $n[$x] = $n[$x+1];
                        $n[$x+1] = $aux;
                    }
                }
            }
            $tabela = '<table>';
            $tabela .= '<tr><td><p>Maior nota para menor nota</p></td></tr>';
            for($i = 0; $i <= 9; $i++){
                $tabela .= "<tr>";
                $x = $n[$i];
                $tabela .= "<td><p>$x</p></td>";
                $tabela .= "</tr>";
            }
            $tabela .= "</table>";
            return $tabela;

        }

        public function calcular(){
            $nome = $this->getn();
            $nota = $this->getnota();
            $a = $this->melhoraluno($nome, $nota);
            return $a;
        }

        public function setvalores($n1, $n2){
            array_push($this->nome, $n1);
            array_push($this->nota, $n2);
        }
        public function getn(){
            return $this->nome;
        }
        public function getnota(){
            return $this->nota;
        }

    }


?>