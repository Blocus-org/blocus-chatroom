<?php
	include_once "config.php";
	define("ENCRYPTION_METHOD", $algorithm);
	define("KEY", $encryption_key);

	function encrypt($data) {
 		$key = KEY;
		$plaintext = $data;
		$ivlen = openssl_cipher_iv_length($cipher = ENCRYPTION_METHOD);
		$iv = openssl_random_pseudo_bytes($ivlen);
		$ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
		$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
		$ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
		return $ciphertext;
	}
		function decrypt($data) {
	    $key = KEY;
	    $c = base64_decode($data);
	    $ivlen = openssl_cipher_iv_length($cipher = ENCRYPTION_METHOD);
	    $iv = substr($c, 0, $ivlen);
	    $hmac = substr($c, $ivlen, $sha2len = 32);
	    $ciphertext_raw = substr($c, $ivlen + $sha2len);
	    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
	    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
	    if (hash_equals($hmac, $calcmac)){
		    return $original_plaintext;
		}
	}
?>
