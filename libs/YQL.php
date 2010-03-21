<?php

// Really simple YQL abstraction
class YQL 
{
    public static function query($sql)
    {
        // simple SQL variable binding support
        $params = func_get_args();
        for ($i=0; $i < count($params); $i++) {
            $sql = str_replace(":{$i}", '"'.addslashes($params[$i]).'"', $sql);
        }
        var_dump($sql);

        $sql = urlencode($sql);
        $url = "http://query.yahooapis.com/v1/public/yql?q={$sql}&format=json&diagnostics=false&env=store://datatables.org/alltableswithkeys";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0) ;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1) ;
        curl_setopt($ch, CURLOPT_TIMEOUT, 20); 
        if (defined("GLOBAL_PROXY")) {
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
            curl_setopt($ch, CURLOPT_PROXY, GLOBAL_PROXY); 
            if (defined("GLOBAL_PROXY_AUTH")) {
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, GLOBAL_PROXY_AUTH); 
            }
        }
        $res = curl_exec($ch);
        if (!$res) {
            throw new Exception(curl_error($ch));
        }
        curl_close($ch);
        return json_decode($res, true);
    }
    public static function multiQuery(array $sql) 
    {
        $sql = implode(';', $sql);
        return static::query("SELECT * FROM query.multi where queries=\"$sql\"");
    }
}

