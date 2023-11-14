<?php
namespace mvcCore\Views;

use mvcCore\Etc\Config;
use mvcCore\Data\Cars;

trait OrderView {
	
	// View specifics fields
	protected $checked_gearboxes = array ();
	protected $checked_colors = array ();
	protected $checked_options = array ();
	
	protected $model_price = null;
	protected $gearbox_price =null;
	protected $color_price = null;
	protected $options_price = null;
	
	//
	// Set Properties
	// @Override
	//
	public function setProperties() {
		
		if ( ! $this->_array) { // Just one object
			// Set brand price
			$this->model_price = 0;
			if ( isset( Cars::$brands[$this->__model->getBrand()][$this->__model->getModel()])) {
				$this->model_price = Cars::$brands[$this->__model->getBrand()][$this->__model->getModel()];
			}
			// Selected gearbox (Radio button)
			if ( ! is_null( $this->__model->getGearbox())) {
				$this->gearbox_price = Cars::$gearboxes[$this->__model->getGearbox()]['price'];
			}
			// Checked gearbox
			$empty = true;
			foreach ( Cars::$gearboxes as $key => $value) {
				if ( $key == $this->__model->getGearbox()) {
					$this->checked_gearboxes[$key] = 'checked';
					$empty =false;
				} else
					$this->checked_gearboxes[$key] = '';
			}
			// Default is 'manual'
			if ( $empty) $this->checked_gearboxes['manual'] = 'checked';
			
			// Selected color (Radio button)
			$this->color_price = 0;
			if ( ! is_null( $this->__model->getColor())) {
				$this->color_price = Cars::$colors[$this->__model->getColor()]['price'];
			}
			// Checked color
			$empty = true;
			foreach ( Cars::$colors as $key => $value) {
				if ( $key == $this->__model->getColor()) {
					$this->checked_colors[$key] = 'checked';
					$empty =false;
				} else
					$this->checked_colors[$key] = '';
			}
			// Default is 'standard'
			if ( $empty) $this->checked_colors['standard'] = 'checked';
			
			// Selected options (Checkbox)
			$this->options_price = 0;
			foreach ( Cars::$options as $key => $value) {
				if ( isset( $this->__model->getOptions()[$key])) {
					$this->checked_options[$key] = 'checked';
					$this->options_price += Cars::$options[$key]['price'];
				} else {
					$this->checked_options[$key] = '';
				}
			}
		} else { // An array of object
			for ($n = 0; $n < count( $this->__model); $n++) {
				// Set brand price
				$this->model_price[$n] = 0;
				if ( isset( Cars::$brands[$this->__model[$n]->getBrand()][$this->__model[$n]->getModel()])) {
					$this->model_price[$n] = Cars::$brands[$this->__model[$n]->getBrand()][$this->__model[$n]->getModel()];
				}
				// Selected gearbox (Radio button)
				$this->gearbox_price[$n] = 0;
				if ( ! is_null( $this->__model[$n]->getGearbox())) {
					$this->gearbox_price[$n] = Cars::$gearboxes[$this->__model[$n]->getGearbox()]['price'];
				}
				// Checked gearbox
				$empty = true;
				foreach ( Cars::$gearboxes as $key => $value) {
					if ( $key == $this->__model[$n]->getGearbox()) {
						$this->checked_gearboxes[$n][$key] = 'checked';
						$empty =false;
					} else
						$this->checked_gearboxes[$n][$key] = '';
				}
				// Default is 'manual'
				if ( $empty) $this->checked_gearboxes[$n]['manual'] = 'checked';
				
				// Selected color (Radio button)
				$this->color_price[$n] = 0;
				if ( ! is_null( $this->__model[$n]->getColor())) {
					$this->color_price[$n] = Cars::$colors[$this->__model[$n]->getColor()]['price'];
				}
				// Checked color
				$empty = true;
				foreach ( Cars::$colors as $key => $value) {
					if ( $key == $this->__model[$n]->getColor()) {
						$this->checked_colors[$n][$key] = 'checked';
						$empty =false;
					} else
						$this->checked_colors[$n][$key] = '';
				}
				// Default is 'standard'
				if ( $empty) $this->checked_colors[$n]['standard'] = 'checked';
				
				// Selected options (Checkbox)
				$this->options_price[$n] = 0;
				foreach ( Cars::$options as $key => $value) {
					if ( isset( $this->__model[$n]->getOptions()[$key])) {
						$this->checked_options[$n][$key] = 'checked';
						$this->options_price[$n] += Cars::$options[$key]['price'];
					} else {
						$this->checked_options[$n][$key] = '';
					}
				}
			}
		}
		// Verbose mode
		if ( Config::VERBOSE) var_dump( $this);
	}
	
}
