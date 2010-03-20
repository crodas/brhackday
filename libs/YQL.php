<?php

// Really simple YQL abstraction
class YQL 
{
    static function query($sql)
    {
        $sql = urlencode($sql);
        $url = "http://query.yahooapis.com/v1/public/yql?q={$sql}&format=json&diagnostics=false";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0) ;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1) ;
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
        return json_decode($res);
    }
}

