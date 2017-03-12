<?php

error_reporting(0);
error_reporting(E_ALL);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('error_reporting', E_ERROR | E_WARNING | E_PARSE);

session_start();

$DateformatPHP="d.m.Y.";
$DateformatJS="dd.mm.yy.";

if($_SERVER["SERVER_NAME"]==="localhost"){
	
	$server="localhost";
	$dbname="page";
	$user="root";
	$pass="";
}else{
	$putanja="/HTML/";
	$server = "sql209.byethost22.com";
	$dbname = "b22_19541978_page1";
	$user = "b22_19541978";
	$pass = "ante123";
};

	
	

	

	



$link = new PDO(
	"mysql:host=" . $server . ";dbname=" . $dbname,
	$user,
	$pass,
	array(
		PDO::ATTR_EMULATE_PREPARES=> false,
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8",
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
	)
);
