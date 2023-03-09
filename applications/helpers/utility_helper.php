<?php
defined('BASEPATH') or exit('No direct script access allowed');

function encryptor($action, $string)
{
    $CI = get_instance();
    $key = hash('sha256', $CI->config->item('SECRET_KEY'));
    $iv = substr(hash('sha256', $CI->config->item('SECRET_IV')), 0, 16);

    if ($action == 'encrypt') {

        $output = openssl_encrypt($string, $CI->config->item('ENCRYPT_CODE'), $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $CI->config->item('ENCRYPT_CODE'), $key, 0, $iv);
    }
    return $output;
}

function encrypt_url($string)
{
    $CI = get_instance();
    $key = ACCESS_KEY; //key to encrypt and decrypts.
    $result = '';
    $test = array();
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keychar));

        $test[$char] = ord($char) + ord($keychar);
        $result .= $char;
    }

    return urlencode(base64_encode($result));
}


function decrypt_url($string)
{
    $CI = get_instance();
    $key = ACCESS_KEY; //key to encrypt and decrypts.
    $result = '';
    $string = base64_decode(urldecode($string));
    for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }
    return $result;
}
?>