<?php

class TR_Lang_Spanish extends TR_Language
{
    protected $stop = array('él'=>1, 'ésta'=>1, 'éstas'=>1 ,'también' => 1,
            'éste'=>1, 'éstos'=>1, 'última'=>1, 'últimas'=>1, 'último'=>1, 'últimos'=>1, 'a'=>1, 'añadió'=>1, 'aún'=>1, 
            'actualmente'=>1, 'adelante'=>1, 'además'=>1, 'afirmó'=>1, 'agregó'=>1, 'ahí'=>1, 'ahora'=>1, 'al'=>1, 'algún'=>1, 
            'algo'=>1, 'alguna'=>1, 'algunas'=>1, 'alguno'=>1, 'algunos'=>1, 'alrededor'=>1, 'ambos'=>1, 'ante'=>1, 'anterior'=>1, 
            'antes'=>1, 'apenas'=>1, 'aproximadamente'=>1, 'aquí'=>1, 'así'=>1, 'aseguró'=>1, 'aunque'=>1, 'ayer'=>1, 'bajo'=>1, 'bien'=>1, 
            'buen'=>1, 'buena'=>1, 'buenas'=>1, 'bueno'=>1, 'buenos'=>1, 'cómo'=>1, 'cada'=>1, 'casi'=>1, 'cerca'=>1, 'cierto'=>1, 'cinco'=>1, 
            'comentó'=>1, 'como'=>1, 'con'=>1, 'conocer'=>1, 'consideró'=>1, 'considera'=>1, 'contra'=>1, 'cosas'=>1, 'creo'=>1, 'cual'=>1, 'cuales'=>1,
            'cualquier'=>1, 'cuando'=>1, 'cuanto'=>1, 'cuatro'=>1, 'cuenta'=>1, 'da'=>1, 'dado'=>1, 'dan'=>1, 'dar'=>1, 'de'=>1, 'debe'=>1, 'deben'=>1, 'debido'=>1,
            'decir'=>1, 'dejó'=>1, 'del'=>1, 'demás'=>1, 'dentro'=>1, 'desde'=>1, 'después'=>1, 'dice'=>1, 'dicen'=>1, 'dicho'=>1, 'dieron'=>1, 'diferente'=>1,
            'diferentes'=>1, 'dijeron'=>1, 'dijo'=>1, 'dio'=>1, 'donde'=>1, 'dos'=>1, 'durante'=>1, 'e'=>1, 'ejemplo'=>1, 'el'=>1, 'ella'=>1, 'ellas'=>1, 'ello'=>1, 
            'ellos'=>1, 'embargo'=>1, 'en'=>1, 'encuentra'=>1, 'entonces'=>1, 'entre'=>1, 'era'=>1, 'eran'=>1, 'es'=>1, 'esa'=>1, 'esas'=>1, 'ese'=>1, 'eso'=>1, 
            'esos'=>1, 'está'=>1, 'están'=>1, 'esta'=>1, 'estaba'=>1, 'estaban'=>1, 'estamos'=>1, 'estar'=>1, 'estará'=>1, 'estas'=>1, 'este'=>1, 'esto'=>1, 'estos'=>1,
            'estoy'=>1, 'estuvo'=>1, 'ex'=>1, 'existe'=>1, 'existen'=>1, 'explicó'=>1, 'expresó'=>1, 'fin'=>1, 'fue'=>1, 'fuera'=>1, 'fueron'=>1, 'gran'=>1, 'grandes'=>1,
            'ha'=>1, 'había'=>1, 'habían'=>1, 'haber'=>1, 'habrá'=>1, 'hace'=>1, 'hacen'=>1, 'hacer'=>1, 'hacerlo'=>1, 'hacia'=>1, 'haciendo'=>1, 'han'=>1, 'hasta'=>1, 'hay'=>1,
            'haya'=>1, 'he'=>1, 'hecho'=>1, 'hemos'=>1, 'hicieron'=>1, 'hizo'=>1, 'hoy'=>1, 'hubo'=>1, 'igual'=>1, 'incluso'=>1, 'indicó'=>1, 'informó'=>1, 'junto'=>1, 'la'=>1,
            'lado'=>1, 'las'=>1, 'le'=>1, 'les'=>1, 'llegó'=>1, 'lleva'=>1, 'llevar'=>1, 'lo'=>1, 'los'=>1, 'luego'=>1, 'lugar'=>1, 'mas'=>1, 'más'=>1, 'manera'=>1, 'manifestó'=>1, 'mayor'=>1, 
            'me'=>1, 'mediante'=>1, 'mejor'=>1, 'mencionó'=>1, 'menos'=>1, 'mi'=>1, 'mientras'=>1, 'misma'=>1, 'mismas'=>1, 'mismo'=>1, 'mismos'=>1, 'momento'=>1, 'mucha'=>1, 
            'muchas'=>1, 'mucho'=>1, 'muchos'=>1, 'muy'=>1, 'nada'=>1, 'nadie'=>1, 'ni'=>1, 'ningún'=>1, 'ninguna'=>1, 'ningunas'=>1, 'ninguno'=>1, 'ningunos'=>1, 'no'=>1, 
            'nos'=>1, 'nosotras'=>1, 'nosotros'=>1, 'nuestra'=>1, 'nuestras'=>1, 'nuestro'=>1, 'nuestros'=>1, 'nueva'=>1, 'nuevas'=>1, 'nuevo'=>1, 'nuevos'=>1,'vos'=>1, 'nunca'=>1, 
            'o'=>1, 'ocho'=>1, 'otra'=>1, 'otras'=>1, 'otro'=>1, 'otros'=>1, 'para'=>1, 'parece'=>1, 'parte'=>1, 'partir'=>1, 'pasada'=>1, 'pasado'=>1, 'pero'=>1, 'pesar'=>1, 'poca'=>1,
            'pocas'=>1, 'poco'=>1, 'pocos'=>1, 'podemos'=>1, 'podrá'=>1, 'podrán'=>1, 'podría'=>1, 'podrían'=>1, 'poner'=>1, 'por'=>1, 'porque'=>1, 'posible'=>1, 'próximo'=>1,
            'próximos'=>1, 'primer'=>1, 'primera'=>1, 'primero'=>1, 'primeros'=>1, 'principalmente'=>1, 'propia'=>1, 'propias'=>1, 'propio'=>1, 'propios'=>1, 'pudo'=>1,
            'pueda'=>1, 'puede'=>1, 'pueden'=>1, 'pues'=>1, 'qué'=>1, 'que'=>1, 'quedó'=>1, 'queremos'=>1, 'quién'=>1, 'quien'=>1, 'quienes'=>1, 'quiere'=>1, 'realizó'=>1, 
            'realizado'=>1, 'realizar'=>1, 'respecto'=>1, 'sí'=>1, 'sólo'=>1, 'se'=>1, 'señaló'=>1, 'sea'=>1, 'sean'=>1, 'según'=>1, 'segunda'=>1, 'segundo'=>1, 'seis'=>1, 
            'ser'=>1, 'será'=>1, 'serán'=>1, 'sería'=>1, 'si'=>1, 'sido'=>1, 'siempre'=>1, 'siendo'=>1, 'siete'=>1, 'sigue'=>1, 'siguiente'=>1, 'sin'=>1, 'sino'=>1, 'sobre'=>1, 
            'sola'=>1, 'solamente'=>1, 'solas'=>1, 'solo'=>1, 'solos'=>1, 'son'=>1, 'su'=>1, 'sus'=>1, 'tal'=>1, 'también'=>1, 'tampoco'=>1, 'tan'=>1, 'tanto'=>1, 'tenía'=>1, 
            'tendrá'=>1, 'tendrán'=>1, 'tenemos'=>1, 'tener'=>1, 'tenga'=>1, 'tengo'=>1, 'tenido'=>1, 'tercera'=>1, 'tiene'=>1, 'tienen'=>1, 'toda'=>1, 'todas'=>1, 
            'todavía'=>1, 'todo'=>1, 'todos'=>1, 'total'=>1, 'tras'=>1, 'trata'=>1, 'través'=>1, 'tres'=>1, 'tuvo'=>1, 'un'=>1, 'una'=>1, 'unas'=>1, 'uno'=>1, 'unos'=>1, 
            'usted'=>1, 'va'=>1, 'vamos'=>1, 'van'=>1, 'varias'=>1, 'varios'=>1, 'veces'=>1, 'ver'=>1, 'vez'=>1, 'y'=>1, 'ya'=>1, 'yo'=>1,'será'=>1,
        );

    function isValid($word)
    {
        return strlen($word) > 2 && !isset($this->stop[$word]);
    }
}

?>
