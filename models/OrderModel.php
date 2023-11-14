<?php
namespace mvcCore\Models;

/*
 * @author : Jean-Michel Bruneau
 * @version : 1.0
 */

// Order model
class OrderModel extends Model {
	// Debug mode
	public const DEBUG = false;
	
	// Model name
	public static $_model_name = 'order';
	
	// SQL table name
	public static $_model_table = 'public.orders';
	
	/**
	 * Orders model properties
	 */
	
	// Forms fields
	protected $email = null;
	protected $mdp = null;
	protected $lastname = null;
	protected $firstname = null;
	protected $birthdate = null;
	protected $adresse = null;
	protected $telephone = null;
	protected $emailsecours = null;
	
	protected $brand = null;
	protected $model = null;
	protected $gearbox = null;
	protected $color = null;
	
	// JSON of a PHP array()
	protected $options = null;

	protected $return_price = null;
	protected $total_price = null;
	
	// @Column( default='now()')
	protected  $date = null;
	
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
		if ( isset( $data['email']))
			$data['email'] =  self::$__crypt->encrypt( $data['email']);
		if ( isset( $data['mdp']))
			$data['mdp'] =  self::$__crypt->encrypt( $data['mdp']);
		if ( isset( $data['firstname']))
			$data['firstname'] =  self::$__crypt->encrypt( $data['firstname']);
		if ( isset( $data['lastname']))
			$data['lastname'] =  self::$__crypt->encrypt( $data['lastname']);
		if ( isset( $data['birthdate']))
			$data['birthdate'] =  self::$__crypt->encrypt( $data['birthdate']);
		if ( isset( $data['adresse']))
			$data['adresse'] =  self::$__crypt->encrypt( $data['adresse']);
		if ( isset( $data['telephone']))
			$data['telephone'] =  self::$__crypt->encrypt( $data['telephone']);
		if ( isset( $data['emailsecours']))
			$data['emailsecours'] =  self::$__crypt->encrypt( $data['emailsecours']);
		if ( self::DEBUG) var_dump( $data);
		return $data;
	}
	
	// Decrypts the properties that must be
	// To be used in the read() method below
	public function decrypt() {
		$this->email = self::$__crypt->decrypt( $this->email);
		$this->mdp = self::$__crypt->decrypt( $this->mdp);
		$this->firstname = self::$__crypt->decrypt( $this->firstname);
		$this->lastname = self::$__crypt->decrypt( $this->lastname);
		$this->birthdate = self::$__crypt->decrypt( $this->birthdate);
		$this->adresse = self::$__crypt->decrypt( $this->adresse);
		$this->telephone = self::$__crypt->decrypt( $this->telephone);
		$this->emailsecours = self::$__crypt->decrypt( $this->emailsecours);
		// Remove \" from json options field
		$this->options = str_replace( "\\", "", $this->options);
		// Remove " at the beginning and the end of options field
		$this->options = trim( $this->options, '"');
		if ( self::DEBUG) var_dump( $this->firstname, $this->lastname, $this->email);
	}
	
	/**
	 * @return string
	 */
	public static function getModelName() {
		return OrderModel::$_model_name;
	}

	/**
	 * @param string $_model_name
	 */
	public static function setModelName( $_model_name) {
		OrderModel::$_model_name = $_model_name;
	}

	/**
	 * @return string
	 */
	public static function getModelTable() {
		return OrderModel::$_model_table;
	}

	/**
	 * @param string $_model_table
	 */
	public static function setModelTable( $_model_table) {
		OrderModel::$_model_table = $_model_table;
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
	public function getMdp() {
		return $this->mdp;
	}
	
	/**
	 * @param mixed $mdp
	 */
	public function setMdp( $mdp) {
		$this->mdp = $mdp;
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
	public function getAdresse() {
		return $this->adresse;
	}
	
	/**
	 * @param mixed $adresse
	 */
	public function setAdresse( $adresse) {
		$this->adresse = $adresse;
	}

	/**
	 * @return mixed
	 */
	public function getTelephone() {
		return $this->telephone;
	}
	
	/**
	 * @param mixed $telephone
	 */
	public function setTelephone( $telephone) {
		$this->telephone = $telephone;
	}

	/**
	 * @return mixed
	 */
	public function getEmailsecours() {
		return $this->emailsecours;
	}
	
	/**
	 * @param mixed $emailsecours
	 */
	public function setEmailsecours( $emailsecours) {
		$this->emailsecours = $emailsecours;
	}
	
	/**
	 * @return mixed
	 */
	public function getBrand() {
		return $this->brand;
	}
	/**
	 * @param mixed $brend
	 */
	public function setBrand( $brand) {
		$this->brand = $brand;
	}
	
	/**
	 * @return mixed
	 */
	public function getModel() {
		return $this->model;
	}
	
	/**
	 * @param mixed $model
	 */
	public function setModel( $model) {
		$this->model = $model;
	}
	
	/**
	 * @return mixed
	 */
	public function getGearbox() {
		return $this->gearbox;
	}
	
	/**
	 * @param mixed $gearbox
	 */
	public function setGearbox( $gearbox) {
		$this->gearbox = $gearbox;
	}
	
	/**
	 * @return mixed
	 */
	public function getColor() {
		return $this->color;
	}
	
	/**
	 * @param mixed $color
	 */
	public function setColor( $color) {
		$this->color = $color;
	}
	/**
	 * @return multitype:
	 */
	public function getOptions( $decode = true) {
		return ( $decode) ? json_decode( $this->options, true) : $this->options;
	}
	
	/**
	 * @param multitype: $options
	 */
	public function setOptions( $options, $encode = true) {
		$this->options = ( $encode) ? json_encode( $options) : $options;
	}
	
	/**
	 * @return mixed
	 */
	public function getReturnPrice() {
		return $this->return_price;
	}
	
	/**
	 * @param mixed $return_price
	 */
	public function setReturnPrice( $return_price) {
		$this->return_price = $return_price;
	}
	
	/**
	 * @return mixed
	 */
	public function getTotalPrice() {
		return $this->total_price;
	}
	/**
	 * @param mixed $total_price
	 */
	public function setTotalPrice( $total_price) {
		$this->total_price = $total_price;
	}
	
	/**
	 * @return mixed
	 */
	public function getDate() {
		return $this->date;
	}
	
	/**
	 * @param mixed $date
	 */
	public function setDate( $date) {
		$this->date = $date;
	}
	
}

