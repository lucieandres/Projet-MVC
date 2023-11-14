<?php
namespace mvcCore\Models;

/*
 * @author : Jean-Michel Bruneau
 * @version : 1.0
 */

// Order model
class UserModel extends Model {
	// Debug mode
	public const DEBUG = false;
	
	// Model name
	public static $_model_name = 'user';
	
	// SQL table name
	public static $_model_table = 'public.users';
	
	/**
	 * Orders model properties
	 */
	
	// Forms fields
	protected $email = null;
	protected $password = null;
	protected $lastname = null;
	protected $firstname = null;
	protected $birthdate = null;
	protected $address = null;
	protected $phonenumber = null;
	protected $photo = null;
	protected $safetyemail = null;
	protected $session = null;
	
	// Get all properties
	public function getProperties( $empty = true, $default = true) {
		// Get all properties
		$properties =  parent::getProperties( $empty, $default);
		// Unset modelName and modelTable property
		unset( $properties['_model_name'], $properties['_model_table'],);
		if ( $default) { // Remove properties  with a default value
			unset( $properties['date']);
		}
		return $properties;
	}

	// Get all properties names
	// @ Override
	public function getPropertiesNames( $default = true) {
		// Get all properties names
		$properties_names = parent::getPropertiesNames( $default);
		if ( $default) { // Remove properties names with a default value
			unset( $properties_names['date']);
		}
		return $properties_names;
	}

	// Encrypts the properties that must be
	// To be used in getProperties() method below
	public function encrypt( $data = []) {
		if ( isset( $data['password']))
			$data['password'] =  self::$__crypt->encrypt( $data['password']);
		return $data;
	}
	
	// Decrypts the properties that must be
	// To be used in the read() method below
	public function decrypt() {
		$this->password = self::$__crypt->decrypt( $this->password);
		if ( self::DEBUG) var_dump( $this->firstname, $this->lastname, $this->email);
	}

	public function generateSession() {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$length = strlen($characters);
		$session = '';

		for ($i = 0; $i < $length; $i++) 
			$session .= $characters[rand(0, $length - 1)];

		$this->session = $session;
    
	}
	
	/**
	 * @return string
	 */
	public static function getModelName() {
		return UserModel::$_model_name;
	}

	/**
	 * @param string $_model_name
	 */
	public static function setModelName( $_model_name) {
		UserModel::$_model_name = $_model_name;
	}

	/**
	 * @return string
	 */
	public static function getModelTable() {
		return UserModel::$_model_table;
	}

	/**
	 * @param string $_model_table
	 */
	public static function setModelTable( $_model_table) {
		UserModel::$_model_table = $_model_table;
	}
	
	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * @param mixed $email
	 */
	public function setEmail( $email) {
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getPassword() {
		return $this->password;
	}
	
	/**
	 * @param mixed $mdp
	 */
	public function setPassword( $password) {
		$this->password = $password;
	}

	/**
	 * @return mixed
	 */
	public function getLastname() {
		return $this->lastname;
	}
	
	/**
	 * @param mixed $lastname
	 */
	public function setLastname( $lastname) {
		$this->lastname = $lastname;
	}
	
	/**
	 * @return mixed
	 */
	public function getFirstname() {
		return $this->firstname;
	}
	
	/**
	 * @param mixed $firstname
	 */
	public function setFirstname( $firstname) {
		$this->firstname = $firstname;
	}
	
	/**
	 * @return mixed
	 */
	public function getBirthdate() {
		return $this->birthdate;
	}
	
	/**
	 * @param mixed $birthdate
	 */
	public function setBirthdate( $birthdate) {
		$this->birthdate = $birthdate;
	}

	/**
	 * @return mixed
	 */
	public function getAddress() {
		return $this->address;
	}
	
	/**
	 * @param mixed $adresse
	 */
	public function setAddress( $address) {
		$this->address = $address;
	}

	/**
	 * @return mixed
	 */
	public function getPhonenumber() {
		return $this->phonenumber;
	}
	
	/**
	 * @param mixed $telephone
	 */
	public function setPhonenumber( $phonenumber) {
		$this->phonenumber = $phonenumber;
	}

	/**
	 * @return mixed
	 */
	public function getPhoto() {
		return $this->photo;
	}
	
	/**
	 * @param mixed $photo
	 */
	public function setPhoto( $photo) {
		$this->photo = $photo;
	}

	/**
	 * @return mixed
	 */
	public function getSafetyemail() {
		return $this->safetyemail;
	}
	
	/**
	 * @param mixed $emailsecours
	 */
	public function setSafetyemail( $safetyemail) {
		$this->safetyemail = $safetyemail;
	}

	/**
	 * @return mixed
	 */
	public function getSession() {
		return $this->session;
	}
	
	/**
	 * @param mixed $emailsecours
	 */
	public function setSession( $session) {
		$this->session = $session;
	}
}

