<?php
namespace mvcCore\Models;

/*
 * @author : Jean-Michel Bruneau
 * @version : 1.0
 */

// Order model
class FriendModel extends Model {
	// Debug mode
	public const DEBUG = false;
	
	// Model name
	public static $_model_name = 'friend';
	
	// SQL table name
	public static $_model_table = 'public.friends';
	
	/**
	 * Orders model properties
	 */
	
	// Forms fields
	protected $user_tr = null;
	protected $user_re = null;
	protected $state_invite = null;
	
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
	public function getUser_tr() {
		return $this->user_tr;
	}
	
	/**
	 * @param mixed $email
	 */
	public function setUser_tr( $user_tr) {
		$this->user_tr = $user_tr;
	}

	/**
	 * @return mixed
	 */
	public function getUser_re() {
		return $this->user_re;
	}
	
	/**
	 * @param mixed $mdp
	 */
	public function setUser_re( $user_re) {
		$this->user_re = $user_re;
	}

	/**
	 * @return mixed
	 */
	public function getState_invite() {
		return $this->state_invite;
	}
	
	/**
	 * @param mixed $lastname
	 */
	public function setState_invite( $state_invite) {
		$this->state_invite = $state_invite;
	}
}

