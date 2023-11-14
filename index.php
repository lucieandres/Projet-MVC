<?php

// Autoloader
require __DIR__ . '/vendor/autoload.php';

use mvcCore\Etc\Config;
use mvcCore\Models\Model;
use mvcCore\Controllers\Controller;

// Get session name
session_name( Config::SESSION_NAME);

// Start a session
session_start( );

// Set debug mode
if ( Config::DEBUG) {
	error_reporting( E_ALL); // Toutes les erreurs
	ini_set( 'display_errors', '1'); // Affichage des erreurs
}

//
// URL samples :
// -> Default URL : model=order et action=create
//		- index.php
// -> Create an Order
//		- index.php?model=order&action=create
// -> Create an Order with the template layout "mobile" (see templates/Template.php)
//		- index.php?model=order&action=create&layout=mobile
// -> Read (and of course display) the Order with id=1
//		- index.php?model=order&action=read&id=1
// -> Update the Order with id=11
//		- index.php?model=order&action=update&id=11
// -> Delete the Order with id=111
//		-  index.php?model=order&action=delete&id=1
//

// Model name
$model_name = filter_input( INPUT_GET, 'model', FILTER_SANITIZE_STRING, array( 'options' => array( 'default'=>Config::MODEL)));
// Action on this model
$model_action = filter_input( INPUT_GET, 'action', FILTER_SANITIZE_STRING, array( 'options' => array( 'default' => Config::ACTION)));
// Model id
$model_id = filter_input( INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if ( empty ( $model_id)) // Try INPUT_POST…
	$model_id = filter_input( INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
// Template path : get template from "MVCC_PATH/templates/$tpl_path" directory
$tpl_path = filter_input( INPUT_GET, 'path', FILTER_SANITIZE_STRING);
// Template layout
$tpl_layout = filter_input( INPUT_GET, 'layout', FILTER_SANITIZE_STRING);
// Service (if service=1 do not display common and dedicated header and footer)
$flag_service = filter_input( INPUT_GET, 'service', FILTER_SANITIZE_STRING);
// Step for common purpose use
$step_id = filter_input( INPUT_GET, 'step', FILTER_SANITIZE_STRING);

// ====================================================================
// Be careful : 'model', 'action', 'id', 'path', 'layout', 'service' adn 'step' are reserved input parameter names
// ====================================================================

// Set global input value
$GLOBALS['request'] = array(
	'model' => $model_name,
	'action' => $model_action,
	'id' => $model_id,
	'path' => $tpl_path,
	'layout' =>  $tpl_layout,
	'service' =>  $flag_service,
	'step' => $step_id
);

if ( ! empty( $model_name) && ! empty( $model_action)) {
	// New Model
	try {
		$model = Model::factory($model_name);
	} catch ( Exception $e) {
		die( 'Model Factory Exception : ' . $e->getMessage() . "\n");
	}
	// New Controller
	try {
		$controller = Controller::factory( $model);
	} catch ( Exception $e) {
		die( 'Controler Factory Exception : ' . $e->getMessage() . "\n");
	}
	// Action for this controller
	if ( method_exists( $controller, $model_action))
		try {
			$controller->$model_action();
	} catch ( Exception $e) {
		echo 'Controler Action Exception : ',  $e->getMessage(), "\n";
	}
	else
		die( "Action $model_action does not exists !");
} else
	die( "« Eh, what's up, doc ? »");
