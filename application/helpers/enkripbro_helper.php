<?php
function enkripbro($string)
{
    $key = 'SecretKey';
    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $result .= $string[$i] ^ $key[$i % strlen($key)];
    }
    return urlencode(base64_encode($result));
}

function dekripbro($string)
{
    $key = 'SecretKey';
    $string = base64_decode(urldecode($string));
    $result = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $result .= $string[$i] ^ $key[$i % strlen($key)];
    }
    return $result;
}
