<?php

class TR_Lang_Portuguese extends TR_Language
{
    protected $stop = array(
        "último"=>1,
        "é"=>1,
        "acerca"=>1,
        "agora"=>1,
        "algmas"=>1,
        "alguns"=>1,
        "ali"=>1,
        "ambos"=>1,
        "antes"=>1,
        "apontar"=>1,
        "aquela"=>1,
        "aquelas"=>1,
        "aquele"=>1,
        "aqueles"=>1,
        "aqui"=>1,
        "atrás"=>1,
        "bem"=>1,
        "bom"=>1,
        "cada"=>1,
        "caminho"=>1,
        "cima"=>1,
        "com"=>1,
        "como"=>1,
        "comprido"=>1,
        "conhecido"=>1,
        "corrente"=>1,
        "das"=>1,
        "debaixo"=>1,
        "dentro"=>1,
        "desde"=>1,
        "desligado"=>1,
        "deve"=>1,
        "devem"=>1,
        "deverá"=>1,
        "direita"=>1,
        "diz"=>1,
        "dizer"=>1,
        "dois"=>1,
        "dos"=>1,
        "e"=>1,
        "ela"=>1,
        "ele"=>1,
        "eles"=>1,
        "em"=>1,
        "enquanto"=>1,
        "então"=>1,
        "está"=>1,
        "estão"=>1,
        "estado"=>1,
        "estarestará"=>1,
        "este"=>1,
        "estes"=>1,
        "esteve"=>1,
        "estive"=>1,
        "estivemos"=>1,
        "estiveram"=>1,
        "eu"=>1,
        "fará"=>1,
        "faz"=>1,
        "fazer"=>1,
        "fazia"=>1,
        "fez"=>1,
        "fim"=>1,
        "foi"=>1,
        "fora"=>1,
        "horas"=>1,
        "iniciar"=>1,
        "inicio"=>1,
        "ir"=>1,
        "irá"=>1,
        "ista"=>1,
        "iste"=>1,
        "isto"=>1,
        "ligado"=>1,
        "maioria"=>1,
        "maiorias"=>1,
        "mais"=>1,
        "mas"=>1,
        "mesmo"=>1,
        "meu"=>1,
        "muito"=>1,
        "muitos"=>1,
        "nós"=>1,
        "não"=>1,
        "nome"=>1,
        "nosso"=>1,
        "novo"=>1,
        "o"=>1,
        "onde"=>1,
        "os"=>1,
        "ou"=>1,
        "outro"=>1,
        "para"=>1,
        "parte"=>1,
        "pegar"=>1,
        "pelo"=>1,
        "pelos"=>1,
        "pela"=>1,
        "pelas"=>1,
        "sendo" => 1,
        "primera" => 1,
        "vez" => 1,
        "todo" => 1,
        "pessoas"=>1,
        "pode"=>1,
        "poderápodia"=>1,
        "por"=>1,
        "porque"=>1,
        "povo"=>1,
        "promeiro"=>1,
        "quê"=>1,
        "que"=>1,
        "qual"=>1,
        "qualquer"=>1,
        "quando"=>1,
        "quem"=>1,
        "quieto"=>1,
        "são"=>1,
        "saber"=>1,
        "sem"=>1,
        "ser"=>1,
        "seu"=>1,
        "somente"=>1,
        "têm"=>1,
        "tal"=>1,
        "também"=>1,
        "tem"=>1,
        "tempo"=>1,
        "tenho"=>1,
        "tentar"=>1,
        "tentaram"=>1,
        "tente"=>1,
        "tentei"=>1,
        "teu"=>1,
        "teve"=>1,
        "tipo"=>1,
        "tive"=>1,
        "todos"=>1,
        "trabalhar"=>1,
        "trabalho"=>1,
        "tu"=>1,
        "um"=>1,
        "uma"=>1,
        "umas"=>1,
        "uns"=>1,
        "usa"=>1,
        "usar"=>1,
        "valor"=>1,
        "veja"=>1,
        "ver"=>1,
        "verdade"=>1,
        "verdadeiro"=>1,
        "você"=>1,
    );

    function isValid($word)
    {
        return strlen($word) > 2 && !isset($this->stop[$word]);
    }
}

?>
