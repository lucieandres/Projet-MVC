<?php
namespace mvcCore\Models;

/*
 * @author : Jean-Michel Bruneau
 * @version : 1.0
 */

// Order model
class InfoModel extends Model {
	// Debug mode
	public const DEBUG = false;
	
	// Model name
	public static $_model_name = 'info';
	
	// SQL table name
	public static $_model_table = 'public.informations';
	
	/**
	 * Orders model properties
	 */
	
	// Forms fields
	protected $title = null;
	protected $photoTitle = null;
	protected $content = null;
	protected $email = null;
	protected $public = null;
	protected $date = null;
	
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
		return $data;
	}
	
	// Decrypts the properties that must be
	// To be used in the read() method below
	public function decrypt() {
		if ( self::DEBUG) var_dump( $this->firstname, $this->lastname, $this->email);
	}
	/**
	 * @return string
	 */
	public static function getModelName() {
		return InfoModel::$_model_name;
	}

	/**
	 * @param string $_model_name
	 */
	public static function setModelName( $_model_name) {
		InfoModel::$_model_name = $_model_name;
	}

	/**
	 * @return string
	 */
	public static function getModelTable() {
		return InfoModel::$_model_table;
	}

	/**
	 * @param string $_model_table
	 */
	public static function setModelTable( $_model_table) {
		InfoModel::$_model_table = $_model_table;
	}
	
	/**
	 * @return mixed
	 */
	public function getTitle() {
		return $this->title;
	}
	
	/**
	 * @param mixed $email
	 */
	public function setTitle( $title) {
		$this->title = $title;
	}

	/**
	 * @return mixed
	 */
	public function getPhotoTitle() {
		return $this->photoTitle;
	}
	
	/**
	 * @param mixed $mdp
	 */
	public function setPhotoTitle( $photoTitle) {
		$this->photoTitle = $photoTitle;
	}

	/**
	 * @return mixed
	 */
	public function getContent() {
		return $this->content;
	}
	
	/**
	 * @param mixed $lastname
	 */
	public function setContent( $content) {
		$this->content = $content;
	}

	/**
	 * @return mixed
	 */
	public function getEmail() {
		return $this->email;
	}
	
	/**
	 * @param mixed $lastname
	 */
	public function setEmail( $email) {
		$this->email = $email;
	}

	/**
	 * @return mixed
	 */
	public function getPublic() {
		return $this->public;
	}
	
	/**
	 * @param mixed $lastname
	 */
	public function setPublic( $public) {
		$this->public = $public;
	}

	/**
	 * @return mixed
	 */
	public function getDate() {
		return $this->date;
	}
	
	/**
	 * @param mixed $lastname
	 */
	public function setDate( $date) {
		$this->date = $date;
	}
}

