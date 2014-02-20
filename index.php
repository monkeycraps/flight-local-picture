<?php

header('Content-type: text/html; charset=utf-8');

require 'flight/globals.php';
require 'vendor/autoload.php';
use RedBean_Facade as R;

// do app setting and config
Flight::before('start', function(){

	R::setup('sqlite:db/lanshare.db');
	R::freeze(True);

	require_once('models/User.php');
	Flight::register('user', 'User');
});

// controller 

Flight::route('/a', function(){

    // $a = R::dispense('a');
    // $a->name = 1;
    // R::store($a);

	// $a = R::findOne('a', 'name = ?', array('1') );
	// $a->name1 = 2;
	// R::store($a);

	// R::trash($a);
	
	// $d = R::findOne('directory');
	// var_dump($d->ownObject);



    // R::trash($a);
});

Flight::route('/', function(){

    Flight::render('header', array(), 'header_content');
	Flight::render('index', array(), 'body_content');
	Flight::render('footer', array(), 'footer_content');

	Flight::render('layout', array('title' => 'Home Page'));

});

Flight::route('/image/@path', function($path){

    Flight::render('header', array(), 'header_content');
	Flight::render('image/image', array('path'=>$path), 'body_content');
	Flight::render('footer', array(), 'footer_content');

	Flight::render('layout', array('title' => 'Home Page'));

});

$uriUpdate = '/update/';
Flight::route( $uriUpdate. '.*', function(){

	global $uriUpdate;

	$path = $_SERVER['REQUEST_URI'];
	$path = str_replace($uriUpdate, '', $path);

	require('models/updater.php');
	Flight::register('updater', 'Updater');

	$updater = Flight::updater();

	try{

		if( $updater->update( $path ) ){
			echo 'success';		
			return;
		}

		echo 'fail, refresh to try!';

	}catch( Exception $e ){

		throw $e;
	}

	
});

// start 

Flight::start();

