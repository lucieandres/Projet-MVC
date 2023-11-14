<?php
namespace mvcCore\Controllers;

use mvcCore\Etc\Config;
use mvcCore\Dao\DAO;
use mvcCore\Helpers\Url;
use mvcCore\Views\View;

//
// Controller Factory
//
abstract class Controller {

	// Debug mode
	const DEBUG = false;
	
	// Orders Model object
	protected $__model;
	
	// Database access
	protected $__dao;
	
	public function __construct() {
		// DAO service instance
		$this->__dao = new DAO( Config::DBTYPE,Config::DBHOST, Config::DBPORT, Config::DBNAME, Config::DBUSER, Config::DBPASSWD);
	}

	// Controler's Factory
	public static function factory( $model) {
		// "order" => "Order" => "OrderController"
		$class_name = ucwords( $model->getModelName()) . 'Controller';
		// Class name with namespace
		$class = '\\' . __NAMESPACE__ . '\\' . $class_name;
		if ( class_exists( $class)) {
			$object = new $class( $model);
			return $object;
		} else {
			throw new \InvalidArgumentException( "Class $class not found !");
		}
	}
	
	// Get inputs and set model properties
	// @Override
	public abstract function input( $method = INPUT_POST);
	
	/**
	 * CRUD : Create, Read, Update, Delete, …
	 */
	
	// Create
	// @Override
	public abstract function create( $method = INPUT_POST, $redirect = 'read');
	
	// Read
	// @Override
	public abstract function read( $method = INPUT_POST, $redirect = 'update');
	
	// Update
	// @Override
	public abstract function update( $method = INPUT_POST, $redirect = 'read');
	
	// Delete
	// @Override
	public abstract function delete( $method = INPUT_POST, $redirect = 'create');

	
	//
	// Display action for basic HTML template display
	//
	public function display() {
		$view = View::factory( $this->model, __FUNCTION__);
		// Display the view
		$view->display();
	}
	
	//
	// Redirect URL
	//
	public static function redirect( $params = [], $anchor = '') {
		// Define the protocol
		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		// Define the full current URL
		$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		// Url object instance
		$url = new Url( $url);
		// Add or update the URL parameters
		foreach ( array_keys( $GLOBALS['request']) as $param) {
			if ( isset( $params[$param])) {
				if ( ! empty( $params[$param])) {
					$url->add( $param, $params[$param]);
				} else {
					$url->remove( $param);
				}
			}
		}
		// Set the new anchor and redirect
		$url->setAnchor( $anchor)->redirect();
	}

	/**
	 * ===========================================
	 * Move the following method to the mvcCore\DAO\DAO class
	 * with the object as function parameter
	 * ===========================================
	 */
	
	//
	// find object(s) in de data backend (e.g SQL database)
	//
	public function find( int $id = null) : array {
		
	}
	
	//
	// merge an object in de data backend (e.g SQL database)
	//
	public function merge( int $id) {
		
	}
	
	//
	// Persist an object in de data backend (e.g SQL database)
	//
	public function persist( $redirect = 'read') {
		// Put Input data into the model
		$this->input();
		// Get data (not the null and the default ones)
		$data = $this->__model->getProperties();
		// Display data in debug mode
		if ( self::DEBUG) var_dump( $data);
		// Encrypt data
		$encrypt_data = $this->__model->encrypt( $data);
		// Persist the object and get the new id
		$model_class = get_class( $this->__model);
		$id = $this->__dao->create( $model_class::$_model_table, $encrypt_data);
		if ( empty( $id)) {
			// Display an error !
			die( "An error was occured !");
		} else { // Redirect to "read" action with the new id
			$this->redirect( array( 'action' => $redirect, 'id' => $id));
		}
	}
	
	//
	// Remove an object from the data backend (e.g SQL database)
	//
	public function remove( $redirect = 'create') {
		// Get input id from $GLOBALS['request']
		$id = $GLOBALS['request']['id'];
		// Delete the object with the current id
		$model_class = get_class( $this->__model);
		$result = $this->__dao->delete( $model_class::$_model_table, $id);
		if ( empty( $result)) {
			// Display an error !
			die( 'An error has occured in ' . __FILE__ . ' , for ' . __FUNCTION__ . '() function, at line ' . __LINE__);
		} else { // Redirect to the home page
			$this->redirect( [ 'action' => $redirect, 'id' => '']);
		}
	}
	
}

