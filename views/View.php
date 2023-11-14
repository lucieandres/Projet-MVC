<?php
namespace mvcCore\Views;

use mvcCore\Templates\Template;
//
// View Factory
//

abstract class View {
	
	// Model object(s)
	protected $__model = null;
	
	// Is $this->__model is an array of object (list view)
	protected $_array = false;
	
	// Template object
	protected $__template = null;

	// Data array()
	protected $_data = null;
	
	// template suffix
	public static $tpl_filename_suffix = '.tpl.php';
	
	// Constructor
	public function __construct( $model, $template) {
		// Set Model
		$this->__model = $model;
		// Is $model an array of object ?
		if ( is_array( $model)) $this->_array = true;
		// Set Template
		$this->__template = $template;
		// Set view specific's properties
		$this->setProperties();
	}
	
	// Factory
	public static function factory( $model, $action) {
		$model_name =  ( is_array( $model)) ? $model[0]->getModelName() : $model->getModelName() ;
		// "order" -> "Order", "create" -> "Create" => "OrderCreateView"
		$class_prefix =  ucwords( $model_name) . ucwords( $action);
		$class_name = $class_prefix . "View";
		// Class name with namespace
		$class = '\\' . __NAMESPACE__ . '\\' . $class_name;
		if ( class_exists( $class)) {
			// Template instance
			if ( is_array( $model) && empty($GLOBALS['request']['layout'])) { // List layout forced
				$GLOBALS['request']['layout'] = 'list';
			}
			$template = new Template( $model, $action);
			// View instance
			$object = new $class( $model, $template);
			// Object return
			return $object;
		} else {
			throw new \InvalidArgumentException( "Class $class not found !");
		}
	}
	
	// Set properties
	abstract public function setProperties();

	// Get Properties
	public function getProperties( $abstract = null, $null = true) {
		$properties = get_object_vars( $this);
		// Remove the abstract view entries
		if ( $abstract)
			unset( $properties['__model'], $properties['_array'], $properties['_data'], $properties['__template']);
			// Remove null values
			if ( $null)
				foreach ( $properties as $key => $value)
					if ( is_null( $value)) unset( $properties[$key]);
		return $properties;
	}
	
	// Display template content
	public function display() {
		echo self::fetch();
	}
	
	// Fetch template
	public function fetch() {
			// Put model data into $this->data['model']
		if ( ! $this->_array) { // Not a list layout
			// Put model data into $this->_data array()
			$this->_data = $this->__model->getProperties( false, false);
			// Add data view to $this->_data
			$this->_data += $this->getProperties( false, false);
		} else { // With a list layout
			for ( $n = 0; $n < count( $this->__model); $n++) {
				// Put model data into $this->_data array()
				$this->_data[$n] = $this->__model[$n]->getProperties( false, false);
				// Add data view to $this->_data
				$this->_data[$n] += $this->getProperties( false, false);
			}
		}

		// Form action
		$model = $GLOBALS['request']['model'];
		$action = $GLOBALS['request']['action'];
		
		// Define $data[]
		$data = $this->_data;
		
		// Turn on output buffering
		ob_start();

		// Header common template with no service
		if ( empty( $GLOBALS['request']['service'])) {
			if ( ! is_null( $this->__template->getCommonHeader())) require_once $this->__template->getCommonHeader();

			// Header model template
			if ( ! is_null( $this->__template->getHeader())) require_once $this->__template->getHeader();
		}

		// Body model template
		if ( ! is_null( $this->__template->getFilename())) require_once $this->__template->getFilename();

		// Footer template with no service
		if ( empty( $GLOBALS['request']['service'])) {
			if ( ! is_null( $this->__template->getFooter())) require_once $this->__template->getFooter();

			// Footer common template with no service
			if ( ! is_null( $this->__template->getCommonFooter())) require_once $this->__template->getCommonFooter();
		}

		return ob_get_clean();
	}
}

