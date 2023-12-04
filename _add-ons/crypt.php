<?php

// KEY:
$customkey = "@D4TA3NKRIP1!";

function encryptString($string, $key)
{
	$iv = random_bytes(16);
	$encrypted = openssl_encrypt($string, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
	$encrypted = base64_encode($iv . $encrypted);
	$encrypted = bin2hex(urlencode(base64_encode(date("Ymd") . "*SIPAPAPMACOREPLIKASI*" . $encrypted)));
	return $encrypted;
}

function decryptString($encryptedString, $key)
{
	$encryptedString = explode('*SIPAPAPMACOREPLIKASI*', base64_decode(urldecode(hex2bin($encryptedString))));
	$encryptedString = $encryptedString[1];
	$data = base64_decode($encryptedString);
	$iv = substr($data, 0, 16);
	$encrypted = substr($data, 16);
	$decrypted = openssl_decrypt($encrypted, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
	return $decrypted;
}
