<?php

namespace mvcCore\Helpers;

/**
* 
* Encrypt & Decrypt Class
* 
* 	@author Jean-Michel Bruneau
*	@copyright Ispace Development
* 	@version	3.2
* 	@date			2013-02-07
* 	@date			2020-12-05
*/ 

class Crypt {
		
	// The cipher method
	// DO NOT MODIFY A POSTERIORI !!
	const CRYPT_ALGO = 'aes-256';

	// Encrypt mode name
	// DO NOT MODIFY A POSTERIORI !!
	const MODE = 'cfb';
	
	// Key definition 
	// DO NOT MODIFY A POSTERIORI !!
	const KEY = '6b6c8e2eaae9203b4a7dd88df85824a6';
	
	// Initialization Vector
	// DO NOT MODIFY A POSTERIORI !!
	const SEPARATOR = '$';
	
	// Cipher method
	private $cipher_method = '';

	// Initialization Vector
	private $iv = '';
	
	/**
  	* Construcror
 	*/ 
	public function __construct() {
		// Set cipher method
		$this->cipher_method = self::CRYPT_ALGO . '-' . self::MODE;
		// Generate an initialization vector
		$cipher_iv_length = openssl_cipher_iv_length( $this->cipher_method);
		$this->iv = openssl_random_pseudo_bytes( $cipher_iv_length);
	}
	
	/**
	 * Encrypt
	 * @param string $data Data to encrypt 
	 * @return string encrypted data
	 */
	public function encrypt( string $data) : string {
		$encrypt_data = openssl_encrypt( $data, $this->cipher_method, self::KEY, 0, $this->iv);
		return base64_encode( $this->iv) . self::SEPARATOR . $encrypt_data;
	}
	
	/**
	 * Decrypt
	 * @param  string $data Data to decrypt 
	 * @return string decrypted data
	 */
	public function decrypt( string $data) : string {
		$decrypt_data = null;
		@list( $iv, $data) = explode( self::SEPARATOR, $data);
		if ( ! empty( $iv)) {
			$decrypt_data = openssl_decrypt( $data, $this->cipher_method, self::KEY, 0, base64_decode( $iv));
		} else {
			throw new \UnexpectedValueException( "Empty initialization vector !");
		}
		return $decrypt_data;
	}

}

