<?php
namespace mvcCore\Etc;

/**
 * @author jmbruneau
 *
 */
class Config {
	
	// Debug mode
	const  DEBUG = false;
	
	// Verbose mode
	const  VERBOSE = false;
	
	// Session Name
	const SESSION_NAME = 'MVCCORE';

	// XHTML flag
	const XHTML = true;
	
	// Default model
	const MODEL = 'user';
	// Default action
	const ACTION = 'create';
	
	// Database parameters
	const DBTYPE = 'pgsql';
	const DBHOST = 'localhost';
//	const DBPORT = 5432; // sur linserv-info-03
	const DBPORT = 5432; // localhost
	
//	const DBNAME = 'jmbruneau'; // sur linserv-info-03
	const DBNAME = 'lucie.andres@etu.univ-cotedazur.fr'; // localhost
	const DBUSER = 'al002300';
//	const DBPASSWD = '<jmb!25164>'; // sur linserv-info-03
	const DBPASSWD = '22002300'; // localhost

	
	// Form data defintion
	static $REQUIRED = 'required=“required”';
	static $SELECTED = 'selected="selected"';
	static $CHECKED = 'checked=“checked”';
	
	static function init() {
		if ( ! self::XHTML) self::$REQUIRED = 'required';
		if ( ! self::XHTML) self::$SELECTED = 'selected';
		if ( ! self::XHTML) self::$CHECKED = 'checked';
	}

}

// Init call
Config::init();
